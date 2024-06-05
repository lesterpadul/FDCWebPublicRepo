<?php
$id = isset($_GET['id']) ? $_GET['id'] : null;
$exam_id = isset($_GET['exam_id']) ? $_GET['exam_id'] : null;
$message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $type = $_POST['type'];

    $stmt = $conn->prepare("UPDATE questions SET question = ?, type = ? WHERE id = ?");
    $stmt->bind_param("ssi", $question, $type, $id);

    if ($stmt->execute()) {
        $message = "Question updated successfully";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();

} else {
    if ($id && $exam_id) {
        $stmt = $conn->prepare("SELECT * FROM questions WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $question = $result->fetch_assoc();

        $stmt->close();
    } else {
        $message = "Error: Question ID or Exam ID not provided.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Question</title>
</head>
<body>
    <div class="container mt-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <h1 class="mb-4">Edit Question</h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="question">Question:</label>
                <textarea class="form-control" name="question" required><?php echo ($question['question'] ?? ''); ?></textarea>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select class="form-control" name="type" required>
                    <option value="multiple_choice" <?php if(($question['type'] ?? '') == 'multiple_choice') echo 'selected'; ?>>Multiple Choice</option>
                    <option value="true_false" <?php if(($question['type'] ?? '') == 'true_false') echo 'selected'; ?>>True/False</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Update Question</button>
        </form>
        <br>
        <a href="?page=view_questions&id=<?php echo ($exam_id ?? ''); ?>" class="btn btn-secondary">Cancel</a>
    </div>

