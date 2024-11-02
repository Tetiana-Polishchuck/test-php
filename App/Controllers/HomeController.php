<?php

namespace App\Controllers;
use App\Models\Product;
use App\Models\Category;

class HomeController{
    private $productModel;
    private $categoryModel;
    public function __construct($pdo) {
        $this->productModel = new Product($pdo);
        $this->categoryModel = new Category($pdo);

    }
    public function index(array $get){
        $categories_data = $this->categoryModel->getCategory();
        if(!$categories_data['success']){
            echo 'Something went wrong';
            exit();
        }
        $categories = $categories_data['data'];
        $data = $this->productModel->getProducsWithCategories($get);
        if($data['success']){
            $products = $data['data'];
            include __DIR__ . '/../Views/home.php';
        }else{
            echo 'Something went wrong';
        }
    }

    public function getCategory($get){
        $data = $this->productModel->getProducsWithCategories($get);
        return json_encode(['data' => $data['data'], 'success' => $data['success']]);
    }

}