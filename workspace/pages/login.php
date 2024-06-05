<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username'], $_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            if ($user['role'] === 'admin') {
                echo "Admins cannot log in through this form!";
            } else {
                $_SESSION['is_logged_in'] = true;
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['last_login_time'] = time();

                // Redirect to user exams
                echo "<script>window.location.href = '?page=user_exams';</script>";
                exit();
            }
        } else {
            echo "Invalid password!";
        }
    } else {
        echo "Username does not exist!";
    }

    $stmt->close();
}
?>
<div class="container">
    <h2>Login Form</h2>
    <form action="?page=login" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Enter Username" required>
        </div>
        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</div>
