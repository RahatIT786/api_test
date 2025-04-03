<?php

namespace App\Services\Product;

use App\Repositories\Product\ProductListRepo;

class ProductListService
{
    protected $productListRepo;

    public function __construct(ProductListRepo $productListRepo)
    {
        $this->productListRepo = $productListRepo;
    }

    public function getAllProducts()
    {
        return $this->productListRepo->getAll();
    }

    public function getProductById($id)
    {
        return $this->productListRepo->getById($id);
    }

    public function createProduct(array $data)
    {
        return $this->productListRepo->create($data);
    }

    public function updateProduct($id, array $data)
    {
        return $this->productListRepo->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->productListRepo->delete($id);
    }
}
