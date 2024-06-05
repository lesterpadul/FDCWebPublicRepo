<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND role = 'admin'");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify(trim($_POST["password"]), $user["password"])) {
            // Set login to true
            $_SESSION["is_logged_in"] = true;
            $_SESSION["user_id"] = $user['id'];
            $_SESSION["username"] = $user['username'];
            $_SESSION["role"] = $user['role'];
            $_SESSION["last_login_time"] = time();
           
            // Redirect to admin dashboard
            echo "<script>
                window.location.href = '?page=admin_dashboard';
            </script>";
            die();
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Invalid username or password";
    }

    // Close the statement
    $stmt->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Admin Login</h1>
        <form method="post" action="">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
