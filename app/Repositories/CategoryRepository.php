<?php

namespace App\Repositories;

use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;
use App\Models\User;

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
        if(isUserLogin()){
            $user = User::find(auth()->id());
            return $nominees->whereIn('id', $user->nominees->pluck('id'))->first();
        }
        return '';
        //return isUserLogin() ? $nominees->whereIn('id', auth()->user()->nominees->pluck('id'))->first() : '';
    }

    public function getNonVotedCategorySlug()
    {
        $categories = Category::with('nominees')->get();
        //dd($categories);
        //$categories->refresh();
        foreach($categories as $category){
            $votedNominee = $this->checkVotedNomineeInCategory($category->nominees);
            //dd($category, $category->nominees, auth()->user()->nominees, $votedNominee);
            if($votedNominee == '' || !$votedNominee){
                return $category->slug;
            }
        }
        return false;
    }
}
