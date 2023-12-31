<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAllCategories();
    public function getCategoryBySlug(string $slug);
    public function checkVotedNomineeInCategory($category);
    public function getNonVotedCategorySlug();
}
