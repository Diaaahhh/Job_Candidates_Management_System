<?php

namespace App\Http\Controllers;

use App\Models\AllCandidate;
use App\Models\CandidateStatus;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    /**
     * Show hired candidates
     */
    public function hired()
    {
        $candidates = AllCandidate::hired()->orderBy('hired_at', 'desc')->get();
        return view('candidates.hired', compact('candidates'));
    }

    /**
     * Show rejected candidates
     */
    public function rejected()
    {
        $candidates = AllCandidate::rejected()->orderBy('rejected_at', 'desc')->get();
        return view('candidates.rejected', compact('candidates'));
    }

    /**
     * Show passed candidates (eligible for second interview)
     */
    public function passed()
    {
        $candidates = AllCandidate::passed()->get();
        return view('candidates.passed', compact('candidates'));
    }

    /**
     * Update candidate status to passed
     */
    public function markAsPassed(Request $request, $id)
    {
        $candidate = AllCandidate::findOrFail($id);
        $candidate->updateStatus('passed', auth()->id(), $request->notes);
        
        return back()->with('success', 'Candidate marked as passed!');
    }

    /**
     * Update candidate status to rejected
     */
    public function markAsRejected(Request $request, $id)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string'
        ]);

        $candidate = AllCandidate::findOrFail($id);
        $candidate->updateStatus('rejected', auth()->id(), $validated['rejection_reason']);
        
        return back()->with('success', 'Candidate marked as rejected!');
    }

    /**
     * Update candidate status to hired
     */
    public function markAsHired(Request $request, $id)
    {
        $candidate = AllCandidate::findOrFail($id);
        $candidate->updateStatus('hired', auth()->id(), $request->notes);
        
        return back()->with('success', 'Candidate marked as hired!');
    }
}
