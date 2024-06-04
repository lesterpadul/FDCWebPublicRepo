<?php
if (isset($_POST['user_id'])) {
    $result = $db->sql->query("
        update user 
        set
			first_name = '{$_POST["first_name"]}',
			last_name = '{$_POST["last_name"]}',
			gender = '{$_POST["gender"]}',
			birthday = '{$_POST["birthday"]}',
            phone_number = '{$_POST["phone_number"]}',
            email = '{$_POST["email"]}',
            modified = CURRENT_TIMESTAMP()
        where 
            user_id = {$_POST['id']}
    ");
    
    // redirect to another page
	echo "<script>
        window.location.href = '?page=home&success_edit_contact=1';
    </script>";
    die();
}

$result = $db->sql->query("
    select * from user 
    where 
    user_id = '{$_GET['id']}'
");

$users = $result->fetch_all(MYSQLI_ASSOC);
?>

<div class="container">
	<h2>Update User</h2>
	<form action="" method="POST">
		<div class="form-group">
			<label for="first_name">First Name:</label>
			<input type="text" class="form-control" name="first_name" placeholder="Enter First Name" value="<?php echo @$users[0]['first_name']; ?>">
		</div>
		<div class="form-group
			<label for="last_name">Last Name:</label>
			<input type="text" class="form-control" name="last_name" placeholder="Enter Company Name" value="<?php echo @$users[0]['last_name']; ?>">
		</div>
		<div class="form-group">
			<label for="gender">Genderr</label>
			<input type="text" class="form-control" name="gender" placeholder="Enter Gender" value="<?php echo @$users[0]['gender']; ?>">
		</div>
		<div class="form-group">
			<label for="birthday">Birthday:</label>
			<input type="date" class="form-control" name="birthday" placeholder="" value="<?php echo @$users[0]['birthday']; ?>">
		</div>
		<div class="form-group
			<label for="phone">Phone:</label>
			<input type="phone" class="form-control" name="phone_number" placeholder="Enter Phone" value="<?php echo @$users[0]['phone_number']; ?>">
		</div>
		<div class="form-group
			<label for="email">Email:</label>
			<input type="email" class="form-control" name="email" placeholder="Enter Email" value="<?php echo @$users[0]['email']; ?>">
		</div>
		<input type="hidden" name="user_id" value="<?php echo $_SESSION['user_id']; ?>" />
		<input type="hidden" name="status" value="1" />
		<input type="hidden" name="id" value="<?php echo @$users[0]['user_id']; ?>"/>
		<button type="submit" class="btn btn-primary">Update User</button>
	</form>
</div>