<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Project;
use App\Models\Gallery;
use App\Models\Testimonial;
use App\Models\Enquiry;
use App\Models\WebsiteSetting;

class PublicController extends Controller
{
    public function home()
    {
        $services = Service::where('is_featured', true)->orderBy('sort_order')->take(6)->get();
        $projects = Project::where('is_featured', true)->with(['beforeImages', 'afterImages'])->latest()->take(6)->get();
        $beforeAfterProjects = Project::where('show_before_after', true)->with(['beforeImages', 'afterImages'])->latest()->take(4)->get();
        $testimonials = Testimonial::where('is_featured', true)->take(4)->get();
        
        $stats = [
            'experience' => WebsiteSetting::getByKey('experience_years', '22+'),
            'completed' => WebsiteSetting::getByKey('completed_projects_count', '350+'),
            'active' => WebsiteSetting::getByKey('active_projects_count', '4'),
            'happy_clients' => WebsiteSetting::getByKey('happy_clients_count', '500+'),
        ];

        return view('pages.home', compact('services', 'projects', 'beforeAfterProjects', 'testimonials', 'stats'));
    }

    public function about()
    {
        $stats = [
            'experience' => WebsiteSetting::getByKey('experience_years', '22+'),
            'completed' => WebsiteSetting::getByKey('completed_projects_count', '350+'),
            'happy_clients' => WebsiteSetting::getByKey('happy_clients_count', '500+'),
        ];
        return view('pages.about', compact('stats'));
    }

    public function services()
    {
        $services = Service::orderBy('sort_order')->get();
        return view('pages.services', compact('services'));
    }

    public function serviceDetail($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $relatedProjects = Project::where('service_id', $service->id)->take(4)->get();
        return view('pages.service-detail', compact('service', 'relatedProjects'));
    }

    public function projects(Request $request)
    {
        $query = Project::with(['customer', 'beforeImages', 'afterImages']);
        
        if ($request->has('category') && $request->category != 'all') {
            $query->where('property_type', $request->category);
        }
        
        $projects = $query->latest()->paginate(9);
        return view('pages.projects', compact('projects'));
    }

    public function projectDetail($slug)
    {
        $project = Project::where('slug', $slug)
            ->with(['customer', 'images', 'updates', 'quotations'])
            ->firstOrFail();

        return view('pages.project-detail', compact('project'));
    }

    public function beforeAfter()
    {
        $projects = Project::where('show_before_after', true)
            ->with(['beforeImages', 'afterImages'])
            ->latest()
            ->get();

        return view('pages.before-after', compact('projects'));
    }

    public function gallery()
    {
        $gallery = Gallery::orderBy('sort_order')->get();
        return view('pages.gallery', compact('gallery'));
    }

    public function quote()
    {
        $services = Service::all();
        return view('pages.quote', compact('services'));
    }

    public function submitQuote(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'property_type' => 'required|string',
            'location' => 'required|string',
            'painting_type' => 'required|string',
            'approx_area' => 'nullable|string',
            'floors' => 'nullable|string',
            'preferred_start_date' => 'nullable|date',
            'additional_requirements' => 'nullable|string',
            'photos.*' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $photoPaths = [];
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $file) {
                $path = $file->store('enquiries', 'public');
                $photoPaths[] = 'storage/' . $path;
            }
        }

        $enquiry = Enquiry::create([
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'email' => $validated['email'] ?? null,
            'property_type' => $validated['property_type'],
            'location' => $validated['location'],
            'painting_type' => $validated['painting_type'],
            'approx_area' => $validated['approx_area'] ?? null,
            'floors' => $validated['floors'] ?? null,
            'preferred_start_date' => $validated['preferred_start_date'] ?? null,
            'additional_requirements' => $validated['additional_requirements'] ?? null,
            'photos' => $photoPaths,
            'status' => 'New',
        ]);

        $whatsappNum = WebsiteSetting::getByKey('whatsapp', '918925014875');
        $msg = urlencode("Hello GC Painting! I requested a quote on your website:\nName: {$enquiry->name}\nType: {$enquiry->property_type} ({$enquiry->painting_type})\nLocation: {$enquiry->location}");
        $whatsappUrl = "https://wa.me/{$whatsappNum}?text={$msg}";

        return redirect()->back()->with('success', 'Quote request submitted successfully! Our team will contact you within 2 hours.')->with('whatsapp_url', $whatsappUrl);
    }

    public function contact()
    {
        return view('pages.contact');
    }
}
