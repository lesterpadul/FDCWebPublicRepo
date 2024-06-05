<?php
$id = $_GET['id'];
$question_id = $_GET['question_id'];

$exam_id = $_GET['exam_id'];
echo $exam_id;


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice = $_POST['choice'];
    $is_correct = isset($_POST['is_correct']) ? 1 : 0;

    // Check if there is already a correct choice for the question
    $stmt = $conn->prepare("SELECT id FROM choices WHERE question_id=? AND is_correct=1");
    $stmt->bind_param("i", $question_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0 && $is_correct === 1) {
        echo "<div class='alert alert-danger' role='alert'>Error: Another correct choice already exists for this question.</div>";
    } else {
        // Update choice
        $stmt = $conn->prepare("UPDATE choices SET choice=?, is_correct=? WHERE id=?");
        $stmt->bind_param("sii", $choice, $is_correct, $id);

        if ($stmt->execute()) {
            echo "<script>window.location.href = '?page=view_choices&id=$question_id';</script>";
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }

    $stmt->close();
} else {
    $stmt = $conn->prepare("SELECT choice, is_correct FROM choices WHERE id=?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $choice = $result->fetch_assoc();
    } else {
        echo "Error: No choice found for ID $id";
        $choice = array('choice' => '');
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Choice</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Edit Choice: <?php echo isset($choice['choice']) ? $choice['choice'] : ''; ?></h1>
        <form method="post" action="">
            <div class="form-group">
                <label>Choice:</label>
                <input type="text" class="form-control" name="choice" required value="<?php echo isset($choice['choice']) ? $choice['choice'] : ''; ?>">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" name="is_correct" value="1" <?php if(isset($choice['is_correct']) && $choice['is_correct']) echo 'checked'; ?>>
                <label class="form-check-label">Is Correct</label>
            </div>
            <button type="submit" class="btn btn-primary">Update Choice</button>
            <a href="?page=view_choices&id=<?php echo $question_id; ?> &exam_id=<?php echo $exam_id; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
