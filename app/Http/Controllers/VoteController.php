<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VoteController extends Controller
{
    public function index()
    {
        if(VoteController::isVoted()){
            return back()->with('alert', setAlertDetails('warning', 'You have already casted your vote.'));
        }
        $user = User::find(auth()->id());
        foreach($user->selectedCandidates as $selectedCandidate){
            $user->nominees()
                ->attach($selectedCandidate->nominee_id, ['voting_date' => Carbon::now()]);
        }
        return back()->with('alert', setAlertDetails('success', 'You have successfully voted for the selected nominee.', 'Final Vote'));
    }

    public static function isVoted()
    {
        $categories = Category::all();
        $user = User::find(auth()->id());
        return $categories->count() === $user->nominees->count();
    }
}
