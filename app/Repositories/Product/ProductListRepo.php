<?php

namespace App\Repositories\Product;

use App\Models\ProductList;

class ProductListRepo
{
    public function getAll()
    {
        $products = ProductList::where('delete_status','1')->get();

        return response()->json([
            'message' => 'Get all Product successfully.',
            'products' => $products,
        ], 200);
    }

    public function getById($id)
    {
        return ProductList::findOrFail($id);
    }

    public function create(array $data)
    {
        $product = ProductList::create($data);
        return response()->json([
            'message' => 'Product added successfully.',
            'product' => $product,
        ]);

    }

    public function update($id, array $data)
    {
        $product = ProductList::findOrFail($id);
        $products = $product->update($data);
        //return $product;
        return response()->json([
            'message' => 'Product updated successfully.',
            'product' => $products,
        ]);
    }

    public function delete($id)
    {
        $product = ProductList::findOrFail($id);
        $product->update(['delete_status' => '2']);

        return response()->json([
            'message' => 'Product marked as deleted successfully.',
            'product' => $product
        ], 200);
    }

}
