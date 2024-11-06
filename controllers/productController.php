<?php
include_once '../model/product.php';

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
            return $this->searchProducts($searchTerm); 
        }
    }
}


// echo   "searchTerm";

?>



