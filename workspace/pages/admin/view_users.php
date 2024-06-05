<?php

$sql = "SELECT id, username, role, status FROM users WHERE role = 'student'";
$result = $conn->query($sql);

if (!$result) { 
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Users</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Users</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Status</th>
                    <th>Action</th>

                </tr>
            </thead>
            <tbody>
                <?php while($user = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo ($user['id']); ?></td>
                        <td><?php echo ($user['username']); ?></td>
                        <td><?php echo ($user['role']); ?></td>
                        <td><?php echo ($user['status']); ?></td>
                        <td>
                            <?php if ($user['status']) { ?>
                                <button class="btn btn-danger btn-sm" onclick="disableUser(<?php echo $user['id']; ?>)">Disable</button>
                            <?php } else { ?>
                                <button class="btn btn-success btn-sm" onclick="enableUser(<?php echo $user['id']; ?>)">Enable</button>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <script>
        function disableUser(userId) {
            if (confirm('Are you sure you want to disable this user?')) {
                window.location.href = '?page=disable_user&id=' + userId;
            }
        }
        
        function enableUser(userId) {
            if (confirm('Are you sure you want to enable this user?')) {
                window.location.href = '?page=enable_user&id=' + userId;
            }
        }
    </script>