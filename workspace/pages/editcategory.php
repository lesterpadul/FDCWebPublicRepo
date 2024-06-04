<?php
if (isset($_POST['id'])) {
    $result = $db->sql->query("
        update category 
        set
            category_name = '{$_POST["category_name"]}',
            modified_date = CURRENT_TIMESTAMP()
        where 
            category_id = {$_POST['id']}
    ");
    
    // redirect to another page
	echo "<script>
        window.location.href = '?page=addcategory&success_update_category={$_POST['id']}';
    </script>";
    die();
}

$result = $db->sql->query("
    select * from category 
    where 
    category_id = '{$_GET['category_id']}'
");

$edit_category = $result->fetch_all(MYSQLI_ASSOC);

?>
<div class="container">
    <h2>Update Category</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="category_name">Category Name:</label>
            <input type="text" class="form-control" name="category_name" value="<?php echo htmlspecialchars($edit_category[0]['category_name']); ?>">
        </div>
        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($_SESSION['user_id']); ?>" />
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($edit_category[0]['category_id']); ?>"/>
        <button type="submit" class="btn btn-primary">Update Category</button>
    </form>
</div>
