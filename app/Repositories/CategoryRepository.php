<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAllCategories()
    {
        return Category::all();
    }

    public function getCategoryBySlug(string $slug)
    {
        return Category::where('slug', $slug)
                        ->first();
    }

    public function checkVotedNomineeInCategory($nominees)
    {
        return $nominees->whereIn('id', auth()->user()->nominees->pluck('id'))
                        ->first();
    }
}
