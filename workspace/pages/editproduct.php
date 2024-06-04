<?php
if (isset($_POST['product_name'])) {
    $result = $db->sql->query("
        update product 
        set
            product_name = '{$_POST["product_name"]}',
            product_description = '{$_POST["product_description"]}',
            product_qty = '{$_POST["product_qty"]}',
            price = '{$_POST["price"]}',
            modified_date = CURRENT_TIMESTAMP()
        where 
        product_id = {$_POST['product_id']}
    ");
    
    // redirect to another page
	echo "<script>
        window.location.href = '?page=addproduct&action_type=addproduct&category_id=2&success_update_product={$_POST['product_id']}';
    </script>";
    die();
}

$product = array();
if(isset($_GET['product_id'])) {
	$product__id = $db->sql->real_escape_string($_GET['product_id']);
	$result = $db->sql->query("
    select * from product 
    where 
        product_id = $product__id
");
$products = $result->fetch_all(MYSQLI_ASSOC);
}
?>

<div class="container">
    <h2>Update Product</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="product_name">Product Name:</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo ($products[0]['product_name']); ?>">
        </div>
        <div class="form-group">
            <label for="product_description">Product Description:</label>
            <input type="text" class="form-control" name="product_description" value="<?php echo ($products[0]['product_description']); ?>">
        </div>
        <div class="form-group">
            <label for="product_qty">Product Quantity:</label>
            <input type="number" class="form-control" name="product_qty" value="<?php echo ($products[0]['product_qty']); ?>">
        </div>
        <div class="form-group">
            <label for="price">Product Price:</label>
            <input type="number" class="form-control" name="price" value="<?php echo ($products[0]['price']); ?>">
        </div>
        <div class="form-group ">
            <input type="hidden" class="form-control" name="product_id" value="<?php echo ($products[0]['product_id']); ?>">
        </div>
        <input type="hidden" name="user_id" value="<?php echo ($_SESSION['user_id']); ?>" />
        <button type="submit" class="btn btn-primary">Update Product</button>
    </form>
</div>
