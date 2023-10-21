<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function view(string $slug)
    {
        $category = $this->categoryRepository->getCategoryBySlug($slug);
        if(!$category){
            return abort('404');
        }

        $category->load('nominees');
        //dd($category->nominees, $this->categoryRepository->checkVotedNomineeInCategory($category->nominees));
        return view('pages.category', [
            'category' => $category,
            'votedNominee' => $this->categoryRepository->checkVotedNomineeInCategory($category->nominees),
        ]);
    }
}
