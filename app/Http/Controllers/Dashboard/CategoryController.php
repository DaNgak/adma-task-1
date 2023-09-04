<?php

namespace App\Http\Controllers\Dashboard;

use App\Commons\Traits\BaseApiResponse;
use App\DataTables\CategoriesDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Category\StoreRequest;
use App\Http\Requests\Dashboard\Category\UpdateRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\Dashboard\CategoryService;

class CategoryController extends Controller
{
    use BaseApiResponse;
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(CategoriesDataTable $dataTable)
    {
        return $dataTable->render('pages.dashboard.categories.index');
        // return view('pages.dashboard.categories.index', $this->categoryService->indexData());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $result = $this->categoryService->storeData($request->validated());

        if ($result != null) {
            return $this->apiSuccess(201, 'Created', new CategoryResource($result));
        }

        return $this->apiSuccess(500, 'Internal Server Error', null);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return $this->apiSuccess(200, 'Ok', new CategoryResource($category));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Category $category)
    {
        $result = $this->categoryService->updateData($category, $request->validated());
        
        if ($result != null) {
            return $this->apiSuccess(200, 'Updated', new CategoryResource($result));
        }

        return $this->apiSuccess(500, 'Internal Server Error', null);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $result = $this->categoryService->deleteData($category);

        if ($result) {
            return $this->apiSuccess(204, 'Deleted', null);
        }

        return $this->apiSuccess(500, 'Internal Server Error', null);
    }
}
