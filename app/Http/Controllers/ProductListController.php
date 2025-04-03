<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductListService;

class ProductListController extends Controller
{
    protected $productListService;

    public function __construct(ProductListService $productListService)
    {
        $this->productListService = $productListService;
    }

    public function index()
    {
        //return 'test';
        return response()->json($this->productListService->getAllProducts());
    }

    public function show($id)
    {
        return response()->json($this->productListService->getProductById($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'product_image' => 'nullable|string',
            'delete_status' => 'nullable|in:1,2'
        ]);

        return response()->json($this->productListService->createProduct($data), 201);
    }


    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'sometimes|required|string',
            'category' => 'sometimes|required|string',
            'price' => 'sometimes|required|numeric',
            'description' => 'nullable|string',
            'stock' => 'sometimes|required|integer',
            'product_image' => 'nullable|string',
            'delete_status' => 'nullable|in:1,2'
        ]);

        return response()->json($this->productListService->updateProduct($id, $data));
    }

    public function delete($id)
    {
        return response()->json($this->productListService->deleteProduct($id));
    }
}
