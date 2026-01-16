<?php

namespace App\Http\Controllers;

use App\Http\Requests\LeadRequest;
use App\Models\Lead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lead::where('assigned_to', Auth::id());

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(fn($q) =>
            $q->where('full_name', 'like', "%{$search}%")
                ->orWhere('phone', 'like', "%{$search}%")
            );
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $leads = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('leads.index', compact('leads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('leads.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(LeadRequest $request)
    {
        $data = $request->validated();
        $data['assigned_to'] = Auth::id();
        Lead::create($data);

        return redirect()->route('leads.index')->with('success', 'Lead created.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Lead $lead)
    {
        $this->authorize('view', $lead);
        return view('leads.show', compact('lead'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Lead $lead)
    {
        $this->authorize('update', $lead);
        return view('leads.edit', compact('lead'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(LeadRequest $request, Lead $lead)
    {
        $this->authorize('update', $lead);
        $lead->update($request->validated());

        return redirect()->route('leads.index')->with('success', 'Lead updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lead $lead)
    {
        $this->authorize('delete', $lead);
        $lead->delete();

        return redirect()->route('leads.index')->with('success', 'Lead deleted.');
    }
}
