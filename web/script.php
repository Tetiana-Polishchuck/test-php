<?php

require_once '../vendor/autoload.php';
require_once '../config/database.php';
use App\Components\TreeBuilder;

$query = $pdo->query('SELECT * FROM categories_test ORDER BY parent_id'); 

$categories = $query->fetchAll();

//$tree = TreeBuilder::buildTree($categories);


$tree = TreeBuilder::buildTreeWithRefs($categories);


echo '<pre>'; print_r(value: $tree); echo '</pre>';


