<?php
include_once '../model/product.php';
include_once '../views/product_search_view.php'; 


class ProductController extends Product
{
    public function shop(&$category, &$product)
    {
        $category = $this->getCategories();
        $product = $this->getProducts();
    }

    public function search() {
        if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['find'])) {
            $searchTerm = trim($_GET['find']);
            $products = $this->searchProducts($searchTerm); 
        } else {
            $products = $this->getProducts(); 
        }

    }
    
    
}