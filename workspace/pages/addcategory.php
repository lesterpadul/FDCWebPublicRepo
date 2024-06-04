<?php
// If there is POST data
if (isset($_POST["category_name"])) {
    // Escape the input to prevent SQL injection
    $category_name = $db->sql->real_escape_string($_POST["category_name"]);

    // Check if the field is not empty
    if (empty($category_name)) {
        echo "You have a missing field";
        die();
    }
    
    // Prepare the SQL statement
    $stmt = $db->sql->prepare("INSERT INTO category (category_name) VALUES (?)");
    $stmt->bind_param("s", $category_name);

    // Execute the query
    if ($stmt->execute()) {
        echo "New category created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    echo "<script>
		window.location.href = '?page=addcategory&success_add_category=$_POST[category_name]';
	</script>";
    
    // Close the statement
    $stmt->close();
}
?>

<?php
// for delete category
if (isset($_POST["action_type"]) && $_POST["action_type"] == "delete_cartegory") {
    $did_delete_category = $db->sql->query("
        Delete from category
            where category_id = '{$_POST['id']}'");
    
    // redirect to another page
    echo "<script>
        window.location.href = '?page=addcategory&success_delete_category={$_POST['id']}';
    </script>";
    die();
}
?>

<?php
$result = $db->sql->query("
select * from category
");
?>

<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category Form</h3>
                </div>
                <div class="card-body">
                    <form action="" method="POST">
                         <div class="form-group">
                            <label for="name">Category Name</label>
                            <input type="text" name="category_name" class="form-control" value="<?php echo @$_POST['category_name']; ?>">
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" class="btn btn-primary">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// - if no data
if ($result->num_rows <= 0):
?>
	<table class="table table-bordered">
		<tr>
			<td>no data</td>
		</tr>
	</table>

<?php

// - if has data
else:
	$categories = $result->fetch_all(MYSQLI_ASSOC);
?>
<br><br>
	<table class="table table-bordered">
		<tr>
			<th>#</th>
			<th>Catory Name</th>
			<th>Created</th>
            <th>Modified</th>
			<th>Add Product</th>
            <th>Edit Product</th>
            <th>Delete Product</th>
		</tr>
		<?php foreach($categories as $categories): ?>
		<tr>
			<td><?php echo $categories["category_id"]; ?></td>
			<td><?php echo $categories["category_name"]; ?></td>
            <td><?php echo $categories["created_date"]; ?></td>
            <td><?php echo $categories["modified_date"]; ?></td>
            <td>
                <!-- for add product -->
                <form action="?page=addcategory" method="GET" class="inline-form">
                    <input type="hidden" name="page" value="addproduct">
                    <input type="hidden" name="action_type" value="addproduct" />
                    <input type="hidden" name="category_id" value="<?php echo ($categories["category_id"]); ?>" />
                    <input type="submit" value="Add Product" class="btn btn-primary" />
                </form>
                </div>
            </td>
            <td>
                <!-- for edit -->
                <form action="" method="GET" class="inline-form">
                    <input type="hidden" name="page" value="editcategory" />
                    <input type="hidden" name="action_type" value="editcategory">
                    <input type="hidden" name="category_id" value="<?php echo ($categories["category_id"]); ?>" />
                    <input type="submit" value="Edit" class="btn btn-primary" />
                </form>
			</td>
			<td>
                <!-- for delete -->
                <form action="?page=addcategory" method="POST" class="inline-form">
                    <input type="hidden" name="action_type" value="delete_cartegory" />
                    <input type="hidden" name="id" value="<?php echo ($categories["category_id"]); ?>" />
                    <input type="submit" value="Delete" class="btn btn-danger" />
                </form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php
endif;
?>
