<?php

namespace App\Models;
use PDOException;
use Log;

class Category extends Model{
    
    public function __construct($pdo) {
        parent::__construct($pdo);
    }

    /**
     * Summary of getCategory
     * @return array
     */
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
            $logger = new Log();
            $logger->filelog('Помилка підключення до бази даних: ' . $e->getMessage());
            return ['success' => false, 'data' => []]; 
        }

    }
}