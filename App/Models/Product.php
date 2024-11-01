<?php

namespace App\Models;
use PDOException;

class Product{

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function getProducsWithCategories(array $get):array{      

        $conditions = [];
        $params = [];

        if (!empty($get['category_id'])) {
            $conditions[] = 'products.category_id = :category_id';
            $params[':category_id'] = $get['category_id'];
        }

        if (!empty($get['sort'])) {
            switch ($get['sort']) {        
                case 'price_asc':
                    $orderBy = 'products.price ASC';
                    break;
                case 'name_asc':
                    $orderBy = 'products.name ASC';
                    break;
                case 'date_desc':
                    $orderBy = 'products.created_at DESC';
                    break;
                default:
                    $orderBy = 'products.id ASC';
            }
        } else {
            $orderBy = 'products.id ASC';
        }

        $query = 'SELECT products.* FROM products';

        if (!empty($conditions)) {
            $query .= ' WHERE ' . implode(' AND ', $conditions);
        }

        $query .= ' ORDER BY ' . $orderBy;

        try {
            $request = $this->pdo->prepare($query);
            foreach ($params as $key => $value) {
                $request->bindValue($key, $value);
            }
            $request->execute();
            $data = $request->fetchAll();
            return ['success' => true, 'data' => $data];
        } catch (PDOException $e) {
            //TODO записати це в логи
            echo 'Помилка підключення до бази даних: ' . $e->getMessage();
            return ['success' => false, 'data' => []]; 
        }
    }


    public function getCategory() {        
        $query = $this->pdo->query('SELECT categories.name AS category_name, 
            categories.id AS category_id,  
            COUNT(products.id) AS product_count
            FROM categories
            LEFT JOIN products ON categories.id = products.category_id
            GROUP BY categories.id, categories.name;'); 

        try {
            $data = $query->fetchAll();
            return ['success' => true, 'data' => $data];
        } catch (PDOException $e) {
            //TODO записати це в логи
            echo 'Помилка підключення до бази даних: ' . $e->getMessage();
            return ['success' => false, 'data' => []]; 
        }

    }
}