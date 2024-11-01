<?php 
if (!isset($products)) {
    die('Дані не передані');
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Товари</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../web/css/style.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="../../web/js/script.js"></script>
</head>
<body>
<div id="loader" class="loader hidden">Завантаження...</div>
<div class="container flex-column">
    <h1 class="my-4">Товари</h1>
  
    <div class="row mb-3">
        <div class="col-4">
            <select id="sort" onchange="sortProducts()"  class="form-control">
                <option>За замовчуванням</option>
                <option value="price_asc">Спочатку дешевші</option>
                <option value="name_asc">По алфавіту</option>
                <option value="date_desc">Спочатку нові</option>
            </select>
        </div>        
    </div>

    <div class="row">
        <div class="categories col-md-4">
            <h2>Категорії</h2>
            <ul class="list-group">
                <?php
                    foreach ($categories as $category){ ?>
                        <li class="list-group-item category_item" onclick="display_gategory(<?php echo $category['category_id']; ?>)">
                            <?php echo htmlspecialchars($category['category_name']); ?> 
                            (<?php echo htmlspecialchars($category['product_count']); ?>)
                        </li>
                    <?php } 
                ?>
            </ul>
        </div>

        <div class="products col-md-8">
            <h2>Товари</h2>
            <div class="product hidden">
                <div class="">
                    <div class="card-body">
                        <h5></h5>
                        <p>Ціна: <span class="card_price"></span> грн.</p>
                        <button class="btn btn-success" 
                            data-toggle="modal"
                            data-target="#product_modal"
                            data-name=""
                            data-price=""
                            data-quantity=""
                        >Купити</button>
                    </div>
                </div> 
            </div>
            <div class="product_list">
                <?php foreach ($products as $product): ?>
                <div class="product">
                    <div class="">
                        <div class="card-body">
                            <h5><?php echo htmlspecialchars($product['name']); ?></h5>
                            <p>Ціна: <?php echo htmlspecialchars($product['price']); ?> грн.</p>
                            <button class="btn btn-success" 
                                data-toggle="modal"
                                data-target="#product_modal"
                                data-name="<?php echo htmlspecialchars($product['name']); ?>"
                                data-price="<?php echo htmlspecialchars($product['price']); ?>"
                                data-quantity="<?php echo htmlspecialchars($product['quantity']); ?> "
                            >Купити</button>
                        </div>
                    </div>     
                </div>
                <?php endforeach; ?>
            </div> 
        </div>
    </div>

   
</div>

<!-- Модалка -->

<div class="modal fade" id="product_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header modal-custom-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex">
                    <p>Ціна: </p>
                    <p class="product_price"></p>
                </div>
                <div class="d-flex">
                    <p>В наявності: </p>
                    <p class="product_quantity"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрити</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal">Купити</button>
            </div>
        </div>
    </div>
</div>

<script>
        const serverUrl = 'http://localhost:8080';
</script>
</body>
</html>
