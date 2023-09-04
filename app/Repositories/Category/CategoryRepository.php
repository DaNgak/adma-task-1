<?php

namespace App\Repositories\Category;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected Builder $query;

    function __construct(Category $category)
    {
        $this->query = $category->query();
    }

    function getAllDataCategory(): Collection
    {
        return $this->query->get();
    }

    function getPaginateCategory(): LengthAwarePaginator
    {
        return $this->query->paginate(5);
    }

    function createDataCategory(array $data): ?Category
    {
        try {
            return $this->query->create($data) ;
        } catch (QueryException $e) {
            return null;
        }
    }

    function updateDataCategory(Category $category, array $data) : ?Category
    {
        return $category->update($data) ? $category->refresh() : null;
    }

    function deleteDataCategory(Category $category) : bool
    {
        return $category->delete();
    }
}
