<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductCategoryService;
use Illuminate\Support\Facades\Log;

class ProductCategoryController extends Controller
{
    protected  $productCategoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->productCategoryService = $categoryService;
    }

    public function index()
    {
        return $this->productCategoryService->getAllProducts();
    }

    public function store(Request $request)
    {
        Log::info($request->all());
        $data = $request->validate([
            'category_name' => 'required|string',
            'delete_status' => 'nullable|in:1,2'
        ]);

        return $this->productCategoryService->createProduct($data);
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'category_name' => 'sometimes|required|string',
            'delete_status' => 'nullable|in:1,2'
        ]);

        return $this->productCategoryService->updateProduct($id, $data);
    }

    public function delete($id)
    {
        return $this->productCategoryService->deleteProduct($id);
    }
}
