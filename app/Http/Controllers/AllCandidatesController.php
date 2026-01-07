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
        return view('edit');
    }

    public function deleteID($id)
    {
        $candidate= new AllCandidate();
        $candidate= AllCandidate::findOrFail($id);
        $candidate->delete();
        return redirect('/all_candidates');
    }
}
