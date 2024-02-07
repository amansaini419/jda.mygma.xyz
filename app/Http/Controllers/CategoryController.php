<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\VotingRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
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

    // For voting
    public function view(string $slug)
    {
        //dd($this->votingRepository->getVotingStatus());
        $category = $this->categoryRepository->getCategoryBySlug($slug);
        if(!$category){
            return abort('404');
        }

        $category->load('nominees');
        //dd($category->nominees, $this->categoryRepository->checkVotedNomineeInCategory($category->nominees));
        return view('pages.category', [
            'category' => $category,
            'votedNominee' => $this->categoryRepository->checkVotedNomineeInCategory($category->nominees),
            'votingStatus' => $this->votingRepository->getVotingStatus(),
        ]);
    }

    // For selecting
    public function show(string $slug)
    {
        //dd($this->votingRepository->getVotingStatus());
        $category = $this->categoryRepository->getCategoryBySlug($slug);
        if(!$category){
            return abort('404');
        }

        $category->load('nominees', 'selectedCandidates');
        // dd($category, $category->selectedCandidates->where('user_id', auth()->id())->first());
        // dd($category->nominees, $this->categoryRepository->checkVotedNomineeInCategory($category->nominees));
        return view('pages.category', [
            'category' => $category,
            'selectedCandidate' => $category->selectedCandidates->where('user_id', auth()->id())->first(),
            'votedNominee' => $this->categoryRepository->checkVotedNomineeInCategory($category->nominees),
            'votingStatus' => $this->votingRepository->getVotingStatus(),
        ]);
    }
}
