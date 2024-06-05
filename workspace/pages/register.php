<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Assuming sanitize is a function to sanitize input
    $username = sanitize($_POST['username']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $role = 'student';
    $ip_address = get_ip_address();

    if (empty($username) || empty($password)) {
        echo "All fields are required.";
    } else {
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Username already taken.";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (username, password, role, status, created_ip) VALUES (?, ?, ?, 1, ?)");
            $stmt->bind_param("ssss", $username, $password, $role, $ip_address);

            if ($stmt->execute()) {
                echo "Registration successful";
            } else {
                echo "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Register</h1>
        <form action="?page=register" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary">Register</button>
        </form>
        <?php if (isset($message)): ?>
            <div class="alert alert-info mt-3">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
