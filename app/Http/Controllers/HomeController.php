<?php

namespace App\Http\Controllers;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Voting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
    )
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        return view('pages.home', [
            'voting' => Voting::latest()->first(),
            'categorySlug' => $this->categoryRepository->getNonSelectedCategorySlug(),
        ]);
    }
}
