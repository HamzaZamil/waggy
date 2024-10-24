<?php
include '../model/product.php';

class ProductController extends Product
{
    public function shop(&$category, &$product)
    {
        $category = $this->getCategories();
        $product = $this->getProducts();
    }
}