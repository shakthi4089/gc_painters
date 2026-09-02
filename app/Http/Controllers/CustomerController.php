<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Quotation;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        $customer = $user ? $user->customer : null;

        if ($customer) {
            $projects = Project::where('customer_id', $customer->id)
                ->with(['updates', 'images', 'quotations'])
                ->latest()
                ->get();

            $quotations = Quotation::where('customer_id', $customer->id)
                ->with('items')
                ->latest()
                ->get();
        } else {
            // Fallback for demo customer
            $projects = Project::with(['updates', 'images', 'quotations'])->latest()->take(2)->get();
            $quotations = Quotation::with('items')->latest()->take(2)->get();
        }

        return view('customer.dashboard', compact('projects', 'quotations', 'user'));
    }
}
