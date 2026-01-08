<?php

namespace App\Http\Controllers;

use App\Models\Interview;
use App\Models\AllCandidate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InterviewController extends Controller
{
    /**
     * Show interview creation form
     */
    public function create()
    {
        $candidates = AllCandidate::whereIn('current_status', ['applied', 'passed'])->get();
        return view('interviews.create', compact('candidates'));
    }

    /**
     * Store a new interview
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'selection_type' => 'required|in:single,multiple,range',
            'candidate_id' => 'required_if:selection_type,single',
            'candidate_ids' => 'required_if:selection_type,multiple|array',
            'range_start' => 'required_if:selection_type,range|integer',
            'range_end' => 'required_if:selection_type,range|integer',
            'interview_date' => 'required|date|after_or_equal:today',
            'interview_time' => 'required',
            'interview_type' => 'required|in:first,second',
            'notes' => 'nullable|string'
        ]);

        DB::beginTransaction();
        try {
            $candidateIds = [];

            // Determine which candidates to schedule
            if ($request->selection_type === 'single') {
                $candidateIds = [$request->candidate_id];
            } elseif ($request->selection_type === 'multiple') {
                $candidateIds = $request->candidate_ids;
            } elseif ($request->selection_type === 'range') {
                $candidateIds = AllCandidate::whereBetween('id', [$request->range_start, $request->range_end])
                    ->pluck('id')
                    ->toArray();
            }

            // Create interviews for selected candidates
            foreach ($candidateIds as $candidateId) {
                Interview::create([
                    'candidate_id' => $candidateId,
                    'interview_date' => $request->interview_date,
                    'interview_time' => $request->interview_time,
                    'interview_type' => $request->interview_type,
                    'notes' => $request->notes,
                    'status' => 'upcoming'
                ]);

                // Update candidate status
                AllCandidate::find($candidateId)->update([
                    'current_status' => 'interview_scheduled'
                ]);
            }

            DB::commit();
            return redirect()->route('interviews.upcoming')->with('success', count($candidateIds) . ' interview(s) scheduled successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to schedule interviews: ' . $e->getMessage());
        }
    }

    /**
     * Show upcoming interviews
     */
    public function upcoming()
    {
        // Auto-move past-due interviews to completed
        Interview::pastDue()->each(function ($interview) {
            $interview->markAsCompleted();
        });

        $interviews = Interview::upcoming()->with('candidate')->get();
        return view('interviews.upcoming', compact('interviews'));
    }

    /**
     * Show completed interviews
     */
    public function completed()
    {
        $interviews = Interview::completed()->with('candidate')->get();
        return view('interviews.completed', compact('interviews'));
    }

    /**
     * Download phone numbers of upcoming interview candidates
     */
    public function downloadPhones()
    {
        $interviews = Interview::upcoming()->with('candidate')->get();
        
        $phoneNumbers = $interviews->map(function ($interview) {
            return $interview->candidate->phone;
        })->implode("\n");

        $filename = 'upcoming_interview_phones_' . now()->format('Y-m-d') . '.txt';
        
        return response($phoneNumbers)
            ->header('Content-Type', 'text/plain')
            ->header('Content-Disposition', 'attachment; filename="' . $filename . '"');
    }

    /**
     * Cancel an interview
     */
    public function cancel($id)
    {
        $interview = Interview::findOrFail($id);
        $interview->update(['status' => 'cancelled']);
        
        return back()->with('success', 'Interview cancelled successfully!');
    }
}
