<?php

namespace App\Services\Product;
use App\Repositories\Product\ProductCategoryRepo;

class ProductCategoryService
{
    protected $productCategoryRepo;

    public function __construct(ProductCategoryRepo $category)
    {
        $this->productCategoryRepo = $category;
    }

    public function getAllProducts()
    {
        return $this->productCategoryRepo->getAll();
    }

    public function getProductById($id)
    {
        return $this->productCategoryRepo->getById($id);
    }

    public function createProduct(array $data)
    {
        return $this->productCategoryRepo->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productCategoryRepo->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productCategoryRepo->delete($id);
    }
}
