<?php

namespace App\View\Composers;

use App\Interfaces\CategoryRepositoryInterface;
use Illuminate\View\View;

class CategoryComposer
{
    private CategoryRepositoryInterface $categoryRepository;

    public function __construct(
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->categoryRepository = $categoryRepository;
    }

    public function compose(View $view): void
    {
        $view->with([
            'categories' => $this->categoryRepository->getAllCategories(),
        ]);
    }
}
