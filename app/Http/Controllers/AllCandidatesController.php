<?php

namespace App\Http\Controllers;

use App\Models\AllCandidate;
use Illuminate\Http\Request;

class AllCandidatesController extends Controller
{
    
    public function index()
    {
        return view('all_candidates');
    }

    public function editID($id)
    {
        $candidate = AllCandidate::findOrFail($id);
        return view('edit', compact('candidate'));
    }

    public function show($id)
    {
        $candidate = AllCandidate::findOrFail($id);
        return view('show', compact('candidate'));
    }

    public function updateCandidate(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'experience_years' => 'required|integer|min:0',
            'age' => 'required|integer|min:18|max:100',
        ]);

        $candidate = AllCandidate::findOrFail($id);
        
        // Handle previous experience as array
        $previousExperience = [];
        if ($request->has('companies') && $request->has('roles')) {
            $companies = $request->input('companies');
            $roles = $request->input('roles');
            
            foreach ($companies as $index => $company) {
                if (!empty($company) && !empty($roles[$index])) {
                    $previousExperience[$company] = $roles[$index];
                }
            }
        }
        
        $candidate->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'experience_years' => $validated['experience_years'],
            'previous_experience' => $previousExperience,
            'age' => $validated['age'],
        ]);

        return redirect('/all_candidates')->with('success', 'Candidate updated successfully!');
    }

    public function deleteID($id)
    {
        $candidate= new AllCandidate();
        $candidate= AllCandidate::findOrFail($id);
        $candidate->delete();
        return redirect('/all_candidates');
    }
}
