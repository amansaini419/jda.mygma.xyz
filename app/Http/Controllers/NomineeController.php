<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Nominee;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Http\Request;

class NomineeController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function vote(Nominee $nominee)
    {
        if(!$nominee){
            return abort('404');
        }

        $vote = Vote::where([
            'user_id' => auth()->id(),
            'nominee_id' => $nominee->id,
        ])->first();
        if($vote){
            return back()->with('alert', setAlertDetails('warning', 'You had already voted for the nominee.', $nominee->name));
        }

        $votedNominee = $this->categoryRepository->checkVotedNomineeInCategory($nominee->category->nominees);
        //dd($nominee->category->nominees, $votedNominee);
        if($votedNominee){
            return back()->with('alert', setAlertDetails('warning', 'You had already voted for this category.', $nominee->name));
        }

        $user = User::find(auth()->id());
        $user->nominees()
                ->attach($nominee->id);
        return back()->with('alert', setAlertDetails('success', 'You have successfully voted for the nominee.', $nominee->name));
    }
}
