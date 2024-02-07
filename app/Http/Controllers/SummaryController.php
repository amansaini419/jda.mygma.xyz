<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SummaryController extends Controller
{
    public function index()
    {
        // $user = auth()->user();
        $user = User::find(auth()->id());
        $user->load([
                    'selectedCandidates' => [
                        'category',
                        'nominee',
                    ],
                ]);
        // dd($user->nominees);
        return view('pages.summary', [
            'selectedCandidates' => $user->selectedCandidates,
            'isVoted' => VoteController::isVoted(),
        ]);
    }
}
