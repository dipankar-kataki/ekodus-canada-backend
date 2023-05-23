<?php

namespace App\Http\Controllers\Candidate;

use App\Http\Controllers\Controller;
use App\Models\Candidate;
use Illuminate\Http\Request;

class CandidateController extends Controller
{
    public function allCandidates(){
        try{
            $list_of_candidates = Candidate::orderBy('created_at', 'DESC')->get();
            return view('content.candidate.index')->with(['list_of_candidates' => $list_of_candidates]);
        }catch(\Exception $e){
            return response()->json(['message' => 'Oops! Something Went Wrong.', 'status' => 0]);
        }
    }
}
