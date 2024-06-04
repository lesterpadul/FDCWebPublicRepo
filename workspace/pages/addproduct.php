<?php
// for Get data
$categories = array();
if(isset($_GET['category_id'])) {
	$category__id = $db->sql->real_escape_string($_GET['category_id']);
	$result = $db->sql->query("
    select * from category 
    where 
		category_id = $category__id
");
$categories = $result->fetch_all(MYSQLI_ASSOC);
}

// for insert data
if (isset($_POST["product_name"])) {
    $product_name = $db->sql->real_escape_string($_POST["product_name"]);
    $description = $db->sql->real_escape_string($_POST["description"]);
	$product_qty = $db->sql->real_escape_string($_POST["product_qty"]);
	$price = $db->sql->real_escape_string($_POST["price"]);
	$category_id = $db->sql->real_escape_string($_POST["category_id"]);

	// for image
	$image_url = null;
	if (isset($_FILES["image"]) && $_FILES["image"]["error"] == UPLOAD_ERR_OK) {
		$did_upload = move_uploaded_file($_FILES["image"]["tmp_name"], "public/{$_FILES['image']['name']}");
		if ($did_upload) {
			$image_url = "public/" . basename($_FILES['image']['name']);
		}
	}
	// for insert
    $query = "insert into product
        (
            category_id,
            product_name,
			product_description,
			product_qty,
			price,
			product_image
        )
        values
        (
            ?,
            ?,
            ?,
            ?,
            ?,
            ?
        )";
    $stmt = $db->sql->prepare($query);
    $stmt->bind_param("ississ", $category_id, $product_name, $description, $product_qty, $price, $image_url);
    $did_add_product = $stmt->execute();
	if ($did_add_product) {
        // redirect to another page
        echo "<script>
            window.location.href = '?page=addproduct&action_type=addproduct&category_id=$category__id&success_add_product=$product_name';
        </script>";
        die();
    }
}
?>

<div class="container">
	<h2>Add Product</h2>
	<form action="" method="POST" enctype="multipart/form-data">
		<div class="form-group">
			<label for="product_name">Product Name:</label>
			<input type="text" class="form-control" name="product_name" placeholder="Enter Product Name" value="<?php echo @$_POST['product_name']; ?>">
		</div>
		<div class="form-group">
			<label for="description">Product Description:</label>
			<textarea class="form-control" name="description" placeholder="Enter Product Description" value="<?php echo @$_POST['description']; ?>"></textarea>

		</div>
		<div class="form-group">
			<label for="product_qty">Quantity:</label>
			<input type="number" class="form-control" name="product_qty" placeholder="Enter Product Quantity" value="<?php echo @$_POST['product_qty']; ?>">
		</div>
		<div class="form-group">
			<label for="price">Price:</label>
			<input type="number" class="form-control" name="price" placeholder="Enter Product Price" value="<?php echo @$_POST['price']; ?>">
		</div>
		<div class="form-group">
			<label for="image">Image:</label>
			<input type="file" class="form-control-file" name="image" value="<?php echo @$_POST['image']; ?>">
		</div>
		<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
		<input type="hidden" name="category_id" value="<?php echo @$categories[0]['category_id']; ?>"/>
		<button type="submit" class="btn btn-primary">Add Product</button>
	</form>
</div>

<?php
	// for delete category
	if (isset($_POST["action_type"]) && $_POST["action_type"] == "delete_product") {
		$did_delete_category = $db->sql->query("
			Delete from product
				where product_id = '{$_POST['product_id']}'
				");
		
		// redirect to another page
		echo "<script>
			window.location.href = '?page=addproduct&action_type=addproduct&category_id=$category__id&success_delete_product={$_POST['product_id']}';
		</script>";
		die();
	}
?>
<!-- for list of users -->
<?php
	$categories = array();
	$category_id = 0;
	if(isset($_GET['category_id'])) {
		$category_id = $db->sql->real_escape_string($_GET['category_id']);
		
	}
	$result = $db->sql->query("
		select c.category_name, p.product_id, p.product_name, p.product_description, p.product_qty, p.price, p.product_image, p.created_date, p.modified_date from product as p
		inner join category as c
		on p.category_id = c.category_id
		where p.category_id = $category_id
	");
?>

<?php
	// - if no data
	if ($result->num_rows <= 0):
?>
<br><br>
	<table class="table table-bordered">
		<tr>
			<td>no data</td>
		</tr>
	</table>
<?php

// - if has data
else:
	$products = $result->fetch_all(MYSQLI_ASSOC);
?>
	<br>
	<br>
	<table class="table table-bordered">
		<tr>
			<th>Product Name</th>
			<th>Product Discription</th>
			<th>Product Quantity</th>
			<th>Price</th>
			<th>Image</th>
			<th>Created Date</th>
			<th>Updated Date</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($products as $products): ?>
		<tr>
			<td><?php echo $products["product_name"]; ?></td>
			<td><?php echo $products["product_description"]; ?></td>
			<td><?php echo $products["product_qty"]; ?></td>
			<td><?php echo $products["price"];?></td>
			<td><img src="<?php echo $products["product_image"]; ?>" width="100" height="100"></td>
			<td><?php echo $products["created_date"]; ?></td>
			<td><?php echo $products["modified_date"]; ?></td>
			<td>
				<!-- for edit -->
				<form action="" method="GET">
					<input type="hidden" name="page" value="editproduct" />
					<input type="hidden" name="action_type" value="edit" />
					<input type="hidden" name="product_id" value="<?php echo $products["product_id"]; ?>" />
					<input type="submit" value="Edit" class="btn btn-primary" />
				</form>
			</td>
			<td>
				<!-- for delete -->
				<form action="" method="POST">
					<input type="hidden" name="action_type" value="delete_product" />
					<input type="hidden" name="product_id" value="<?php echo $products["product_id"]; ?>" />
					<input type="submit" value="Delete" class="btn btn-danger" />
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php
endif;
?>