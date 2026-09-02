<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Enquiry;
use App\Models\Project;
use App\Models\ProjectImage;
use App\Models\ProjectUpdate;
use App\Models\Customer;
use App\Models\Quotation;
use App\Models\QuotationItem;
use App\Models\Service;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\WebsiteSetting;

class AdminController extends Controller
{
    public function dashboard()
    {
        $kpi = [
            'new_enquiries' => Enquiry::where('status', 'New')->count(),
            'active_projects' => Project::where('status', 'In Progress')->count(),
            'completed_projects' => Project::where('status', 'Completed')->count(),
            'pending_quotations' => Quotation::where('status', 'Pending')->count(),
        ];

        $recentEnquiries = Enquiry::latest()->take(5)->get();
        $activeProjects = Project::where('status', 'In Progress')->with('customer')->latest()->take(5)->get();

        return view('admin.dashboard', compact('kpi', 'recentEnquiries', 'activeProjects'));
    }

    // Enquiry Management
    public function enquiries()
    {
        $enquiries = Enquiry::latest()->paginate(15);
        return view('admin.enquiries', compact('enquiries'));
    }

    public function updateEnquiryStatus(Request $request, $id)
    {
        $enquiry = Enquiry::findOrFail($id);
        $enquiry->update([
            'status' => $request->input('status'),
            'admin_notes' => $request->input('admin_notes'),
        ]);

        return redirect()->back()->with('success', 'Enquiry status updated!');
    }

    public function convertEnquiryToProject($id)
    {
        $enquiry = Enquiry::findOrFail($id);
        
        $customer = Customer::firstOrCreate(
            ['phone' => $enquiry->phone],
            [
                'name' => $enquiry->name,
                'email' => $enquiry->email,
                'location' => $enquiry->location,
                'notes' => $enquiry->additional_requirements,
            ]
        );

        $project = Project::create([
            'customer_id' => $customer->id,
            'title' => $enquiry->property_type . ' Painting - ' . $enquiry->location,
            'slug' => Str::slug($enquiry->property_type . '-painting-' . $enquiry->location . '-' . rand(100, 999)),
            'property_type' => $enquiry->property_type,
            'painting_type' => $enquiry->painting_type,
            'location' => $enquiry->location,
            'area_sqft' => $enquiry->approx_area,
            'start_date' => $enquiry->preferred_start_date ?? now(),
            'status' => 'Site Visit',
            'progress_percent' => 10,
            'cover_image' => !empty($enquiry->photos) && is_array($enquiry->photos) ? $enquiry->photos[0] : 'images/project1_after.svg',
        ]);

        $enquiry->update(['status' => 'Converted']);

        return redirect()->route('admin.projects.edit', $project->id)->with('success', 'Enquiry successfully converted to active Project!');
    }

    // Projects Management
    public function projects()
    {
        $projects = Project::with(['customer', 'service'])->latest()->paginate(15);
        return view('admin.projects.index', compact('projects'));
    }

    public function createProject()
    {
        $customers = Customer::all();
        $services = Service::all();
        return view('admin.projects.create', compact('customers', 'services'));
    }

    public function storeProject(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'customer_id' => 'nullable|exists:customers,id',
            'service_id' => 'nullable|exists:services,id',
            'property_type' => 'required|string',
            'painting_type' => 'required|string',
            'location' => 'required|string',
            'area_sqft' => 'nullable|string',
            'start_date' => 'nullable|date',
            'expected_end_date' => 'nullable|date',
            'status' => 'required|string',
            'progress_percent' => 'required|integer|min:0|max:100',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'nullable|numeric',
            'description' => 'nullable|string',
            'work_details' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['title'] . '-' . rand(100, 999));
        $validated['cover_image'] = 'images/project1_after.svg';

        $project = Project::create($validated);

        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully!');
    }

    public function editProject($id)
    {
        $project = Project::with(['customer', 'service', 'images', 'updates'])->findOrFail($id);
        $customers = Customer::all();
        $services = Service::all();

        return view('admin.projects.edit', compact('project', 'customers', 'services'));
    }

    public function updateProject(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|string',
            'progress_percent' => 'required|integer|min:0|max:100',
            'total_amount' => 'required|numeric',
            'paid_amount' => 'nullable|numeric',
            'location' => 'required|string',
            'area_sqft' => 'nullable|string',
            'description' => 'nullable|string',
            'work_details' => 'nullable|string',
            'materials_used' => 'nullable|string',
            'team_supervisor' => 'nullable|string',
        ]);

        $project->update($validated);

        if ($request->filled('update_title')) {
            ProjectUpdate::create([
                'project_id' => $project->id,
                'title' => $request->input('update_title'),
                'description' => $request->input('update_description'),
                'progress_percent' => $project->progress_percent,
            ]);
        }

        return redirect()->back()->with('success', 'Project updated successfully!');
    }

    public function uploadProjectImage(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        
        $request->validate([
            'type' => 'required|in:before,during,after',
            'image' => 'required|image|mimes:jpeg,png,jpg,svg|max:5120',
            'caption' => 'nullable|string',
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('projects', 'public');
            $imagePath = 'storage/' . $path;

            ProjectImage::create([
                'project_id' => $project->id,
                'image_path' => $imagePath,
                'type' => $request->input('type'),
                'caption' => $request->input('caption'),
            ]);

            if ($request->input('type') === 'after' || !$project->cover_image) {
                $project->update(['cover_image' => $imagePath]);
            }
        }

        return redirect()->back()->with('success', 'Project photo uploaded successfully!');
    }

    // Quotation Builder
    public function quotations()
    {
        $quotations = Quotation::with('customer')->latest()->paginate(15);
        return view('admin.quotations.index', compact('quotations'));
    }

    public function createQuotation()
    {
        $customers = Customer::all();
        $projects = Project::all();
        return view('admin.quotations.create', compact('customers', 'projects'));
    }

    public function storeQuotation(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string',
            'customer_phone' => 'required|string',
            'customer_email' => 'nullable|email',
            'property_location' => 'required|string',
            'quote_date' => 'required|date',
            'items' => 'required|array|min:1',
            'items.*.description' => 'required|string',
            'items.*.unit' => 'required|string',
            'items.*.qty' => 'required|numeric',
            'items.*.rate' => 'required|numeric',
        ]);

        $subtotal = 0;
        foreach ($validated['items'] as $item) {
            $subtotal += ($item['qty'] * $item['rate']);
        }
        $tax = $subtotal * 0.05; // 5% GST estimate
        $total = $subtotal + $tax;

        $quotation = Quotation::create([
            'quotation_number' => 'EST-' . date('Y') . '-' . rand(100, 999),
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'property_location' => $validated['property_location'],
            'quote_date' => $validated['quote_date'],
            'subtotal' => $subtotal,
            'tax_amount' => $tax,
            'total_amount' => $total,
            'status' => 'Pending',
            'terms_and_conditions' => "1. 40% Advance upon approval.\n2. 5-Year weather guarantee on exterior coats.\n3. Water, power supply to be provided at site.",
        ]);

        foreach ($validated['items'] as $item) {
            QuotationItem::create([
                'quotation_id' => $quotation->id,
                'item_description' => $item['description'],
                'quantity_unit' => $item['unit'],
                'quantity' => $item['qty'],
                'unit_rate' => $item['rate'],
                'total_price' => $item['qty'] * $item['rate'],
            ]);
        }

        return redirect()->route('admin.quotations.show', $quotation->id)->with('success', 'Quotation created successfully!');
    }

    public function showQuotation($id)
    {
        $quotation = Quotation::with('items')->findOrFail($id);
        return view('admin.quotations.show', compact('quotation'));
    }

    // CMS & Settings
    public function settings()
    {
        $settings = WebsiteSetting::all()->pluck('value', 'key');
        return view('admin.settings', compact('settings'));
    }

    public function updateSettings(Request $request)
    {
        foreach ($request->except('_token') as $key => $val) {
            WebsiteSetting::setKey($key, $val);
        }

        return redirect()->back()->with('success', 'Website settings saved!');
    }
}
