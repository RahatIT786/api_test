<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\Product\ProductListService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

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
        Log::info(response()->json($this->productListService->getAllProducts()));
        return response()->json($this->productListService->getAllProducts());
    }

    public function show($id)
    {
        return response()->json($this->productListService->getProductById($id));
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string',
            'category' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'stock' => 'required|integer',
            'product_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'delete_status' => 'nullable|in:1,2',
        ]);

        // if ($request->hasFile('product_image')) {
        //     $path = $request->file('product_image')->store('public/products');
        //     $validated['product_image'] = Storage::url($path);
        // }

        if ($request->hasFile('product_image')) {
            $path = $request->file('product_image')->store('products', 'public');
            $validated['product_image'] = Storage::url($path);
        }

        return response()->json($this->productListService->createProduct($validated), 201);
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
