<?php
$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] != 'POST') {
    $stmt = $conn->prepare("SELECT title, description FROM exams WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($title, $description);
    $stmt->fetch();
    $stmt->close();
} else {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ip_address = get_ip_address();

    $stmt = $conn->prepare("UPDATE exams SET title = ?, description = ?, modified_ip = ? WHERE id = ?");
    $stmt->bind_param("sssi", $title, $description, $ip_address, $id);

    if ($stmt->execute()) {
        $message = "Exam updated successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Exam</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Edit Exam</h1>
        <?php if (isset($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo ($title); ?>" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description" required><?php echo ($description); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Exam</button>
        </form>
        <button type="submit" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
    </div>
