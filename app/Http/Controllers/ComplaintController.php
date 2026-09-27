<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ComplaintController extends Controller
{
    public function index()
    {
        $complaints = Complaint::latest()->get();
        return Inertia::render('Admin/Complaints', [
            'complaints' => $complaints
        ]);
    }

    // Public method for submitting complaint
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string'
        ]);

        Complaint::create($request->all());

        return back()->with('message', 'Complaint submitted successfully. We will get back to you soon.');
    }

    // Admin resolve complaint
    public function update(Complaint $complaint)
    {
        $complaint->update(['status' => 'Resolved']);
        return back();
    }
}
