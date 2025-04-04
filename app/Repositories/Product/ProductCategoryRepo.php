<?php

namespace App\Repositories\Product;
use App\Models\ProductCategory;

class ProductCategoryRepo
{
    public function getAll()
    {
        $product_category = ProductCategory::where('delete_status','1')->get();
        return response()->json([
            'message' => 'All Product categories.',
            'product_category' => $product_category,
        ], 200);
    }

    public function create(array $data)
    {
        $data = ProductCategory::create($data);
        return response()->json($data, 200);
    }

    public function update($id, array $datas)
    {
        $category = ProductCategory::findOrFail($id);
        $data = $category->update($datas);
        return response()->json($data, 200);

    }

    public function delete($id)
    {
        $product = ProductCategory::findOrFail($id);
        $product->update(['delete_status' => '2']);
        return response()->json([
            'message' => 'Product Category marked as deleted successfully.',
        ], 200);
    }
}
