<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ip_address = get_ip_address();

    $stmt = $conn->prepare("INSERT INTO exams (title, description, status, created_ip) VALUES (?, ?, 1, ?)");  
    $stmt->bind_param("sss", $title, $description, $ip_address);

    if ($stmt->execute()) {
        echo "New exam created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Exam</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add Exam</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Add Exam</button>
            <a href="?page=admin_dashboard" class="btn btn-secondary">Cancel</a>
        </form>
    </div>