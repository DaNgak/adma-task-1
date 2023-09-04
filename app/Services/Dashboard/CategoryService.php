<?php
namespace App\Services\Dashboard;

use App\Models\Category;
use App\Repositories\Category\CategoryRepositoryInterface;
use Illuminate\Support\Str;

class CategoryService {
    protected $categoryRepository;
    
    function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    function indexData() : array {
        return [
            'categories' => $this->categoryRepository->getPaginateCategory()
        ];
    }

    function storeData(array $data) : Category {
        $data['slug'] = Str::slug($data['name']);
        return $this->categoryRepository->createDataCategory($data); 
    }

    function updateData(Category $category, array $data) : Category {
        $data['slug'] = Str::slug($data['name']);
        return $this->categoryRepository->updateDataCategory($category, $data); 
    }

    function deleteData(Category $category) : bool {
        return $this->categoryRepository->deleteDataCategory($category); 
    }

}