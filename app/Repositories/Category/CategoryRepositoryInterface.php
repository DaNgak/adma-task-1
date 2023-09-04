<?php

namespace App\Repositories\Category;

use App\Models\Category;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface CategoryRepositoryInterface
{
    function getAllDataCategory() : Collection;

    function getPaginateCategory() : LengthAwarePaginator;

    function createDataCategory(array $data): ?Category;

    function updateDataCategory(Category $category, array $data) : ?Category;

    function deleteDataCategory(Category $category) : bool;
}
