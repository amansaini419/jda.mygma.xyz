<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\VotingRepositoryInterface;
use App\Models\Nominee;
use App\Models\SelectedCandidate;
use App\Models\User;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NomineeController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;
    private VotingRepositoryInterface $votingRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        VotingRepositoryInterface $votingRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
        $this->votingRepository = $votingRepository;
    }

    public function vote(Nominee $nominee)
    {
        if(!$nominee){
            return abort('404');
        }

        $votingStatus = $this->votingRepository->getVotingStatus();
        if($votingStatus != 'voting active'){
            return back()->with('alert', setAlertDetails('error', 'Voting is not active.', strtoupper($votingStatus)));
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
                ->attach($nominee->id, ['voting_date' => Carbon::now()]);
        //dd($user->nominees);
        $categorySlug = $this->categoryRepository->getNonVotedCategorySlug();
        //dd($categorySlug);
        if($categorySlug){
            return to_route('category', ['slug' => $categorySlug])->with('alert', setAlertDetails('success', 'You have successfully voted for the nominee.', $nominee->name));
        }
        return back()->with('alert', setAlertDetails('success', 'You have successfully voted for the nominee.', $nominee->name));
    }

    public function select(Nominee $nominee, Request $request)
    {
        if(!$nominee){
            return abort('404');
        }
        $categoryId = $request->category_id;
        $votingStatus = $this->votingRepository->getVotingStatus();
        if($votingStatus != 'voting active'){
            return back()->with('alert', setAlertDetails('error', 'Voting is not active.', strtoupper($votingStatus)));
        }

        SelectedCandidate::updateOrCreate(
            ['category_id' => $categoryId, 'user_id' => auth()->id()],
            ['nominee_id' => $nominee->id]
        );

        /* $user = User::find(auth()->id());
        $user->nominees()
                ->attach($nominee->id, ['voting_date' => Carbon::now()]); */
        //dd($user->nominees);
        $categorySlug = $this->categoryRepository->getNonSelectedCategorySlug();
        //dd($categorySlug);
        if($categorySlug){
            return to_route('category', ['slug' => $categorySlug])->with('alert', setAlertDetails('success', 'You have successfully selected the nominee.', $nominee->name));
        }
        // return back()->with('alert', setAlertDetails('success', 'You have successfully selected the nominee.', $nominee->name));
        return to_route('summary');
    }
}
