<?php
    $result = $db->sql->query("
    SELECT product_image, product_name, price 
    FROM product
    ORDER BY RAND()
    ");
    $products = $result->fetch_all(MYSQLI_ASSOC);
?>  
<?php
    $result = $db->sql->query("
    select * from category
    ");
    $categories = $result->fetch_all(MYSQLI_ASSOC);
?> 
<style>
    .container {
        display: flex;
    }
    .card-container {
        flex: 1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 2rem;
    }
    .container .card {
        margin: .1rem;
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        min-width: 200px;
    }
    .container .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
    .container .card p {
        margin: 0;
    }
    .container .side-section {
        flex: 0 0 200px;
        order: 0;
        margin-right: 2rem;
    }

    #category-list li {
        border-top: 1px solid #dee2e6;
        border-bottom: 1px solid #dee2e6;
    }

    @media (max-width: 768px) {
        .card-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="main-container container">
    <div class="side-section">
	    <h2>Categories</h2>
            <div class="mb-3">
                <button type="button" class="btn btn-primary" id="filter-button">Filter</button>
            </div>
                <ul class="list-group" id="category-list">
                    <?php foreach($categories as $category): ?>
                        <li class="list-group-item">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="category[]" value="<?php echo $category['category_id']; ?>" id="category-<?php echo $category['category_id']; ?>">
                                <label class="form-check-label" for="category-<?php echo $category['category_id']; ?>">
                                    <?php echo $category["category_name"]; ?>
                                </label>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
    </div>
    <div class="card-container">
        <?php foreach($products as $product): ?>
            <div class="card">
                <img src="<?php echo !empty($product["product_image"]) ? $product["product_image"] : 'workspace/img/default.png'; ?>" class="card-img-top" alt="Product Image">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $product["product_name"]; ?></h5>
                    <p class="card-text">PHP<?php echo !empty($product["price"]) ? $product["price"] : 1; ?></p>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>


