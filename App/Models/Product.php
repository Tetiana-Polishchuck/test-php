<?php

namespace App\Models;
use PDOException;
use Log;
class Product extends Model{

    public function __construct($pdo) {
        parent::__construct($pdo);
    }

    /**
     * Summary of getProducsWithCategories
     * @param array $get
     * @return array
     */
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
            $logger = new Log();
            $logger->filelog('Помилка підключення до бази даних: ' . $e->getMessage());
            return ['success' => false, 'data' => []]; 
        }
    }

}