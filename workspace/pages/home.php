<?php

// for creating contact
// if (isset($_POST["first_name"])) {
//     $first_name = $db->sql->real_escape_string($_POST["first_name"]);
//     $company_name = $db->sql->real_escape_string($_POST["company_name"]);
//     $phone = $db->sql->real_escape_string($_POST["phone"]);
//     $email = $db->sql->real_escape_string($_POST["email"]);
//     $status = $db->sql->real_escape_string($_POST["status"]);
//     $user_id = $db->sql->real_escape_string($_POST["user_id"]);

//     $did_add_contact = $db->sql->query("insert into user
//         (
//             user_id,
//             user_name,
//             first_name,
//             company_name,
// 			email,
// 			phone_number
//         )
//         values
//         (
//             '{$status}',
//             '{$user_id}',
//             '{$company_name}',
//             '{$first_name}',
//             '{$email}',
//             '{$phone}'
//         )");
		
// 		// redirect to another page
// 		echo "<script>
// 			window.location.href = '?page=home&success_add_contact=1';
// 		</script>";
// 		die();
// }

// for delete contact
if (isset($_POST["action_type"]) && $_POST["action_type"] == "delete") {
	$did_delete_contact = $db->sql->query("
		Delete from user
			where user_id = {$_POST['id']};");
		
	// redirect to another page
	echo "<script>
		window.location.href = '?page=home&success_delete_user=$_POST[id]';
	</script>";
	die();
}

// for list of users
$result = $db->sql->query("
    select * from user 

");

if (isset($_GET["success_add_contact"])) {
	echo "successfully added contact!";
}
?>

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
	$users = $result->fetch_all(MYSQLI_ASSOC);
?>
<br><br>
	<table class="table table-bordered">
		<tr>
			<th>#</th>
			<th>Name</th>
			<th>Company Name</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php foreach($users as $users): ?>
		<tr>
			<td><?php echo $users["user_id"]; ?></td>
			<td><?php echo $users["first_name"]; ?></td>
			<td><?php echo $users["last_name"]; ?></td>
			<td><?php echo $users["email"]; ?></td>
			<td><?php echo $users["phone_number"]; ?></td>
			<td>
				<!-- for edit -->
				<form action="" method="GET">
					<input type="hidden" name="page" value="edit" />
					<input type="hidden" name="action_type" value="edit" />
					<input type="hidden" name="id" value="<?php echo $users["user_id"]; ?>" />
					<input type="submit" value="Edit" class="btn btn-primary" />
				</form>
			</td>
			<td>
				<!-- for delete -->
				<form action="?page=home" method="POST">
					<input type="hidden" name="action_type" value="delete" />
					<input type="hidden" name="id" value="<?php echo $users["user_id"]; ?>" />
					<input type="submit" value="Delete" class="btn btn-danger" />
				</form>
			</td>
		</tr>
		<?php endforeach; ?>
	</table>
<?php
endif;
?>