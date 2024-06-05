<?php
$question_id = $_GET['id'];
$exam_id = $_GET['exam_id'];


$stmt_question = $conn->prepare("SELECT question, type FROM questions WHERE id = ?");
$stmt_question->bind_param("i", $question_id);
$stmt_question->execute();
$stmt_question->bind_result($question_name, $question_type);
$stmt_question->fetch();
$stmt_question->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice = isset($_POST['choice']) ? $_POST['choice'] : '';
    $is_correct = isset($_POST['is_correct']) ? (int)$_POST['is_correct'] : 0; 

    $stmt_count = $conn->prepare("SELECT COUNT(*) FROM choices WHERE question_id = ? AND status = 1");
    $stmt_count->bind_param("i", $question_id);
    $stmt_count->execute();
    $stmt_count->bind_result($count);
    $stmt_count->fetch();
    $stmt_count->close();

    if ($question_type === 'true_false' && $count >= 2) {
        echo '<div class="alert alert-danger" role="alert">Error: This question type can only have 2 choices.</div>';
    } elseif ($count >= 4) {
        echo '<div class="alert alert-danger" role="alert">Error: This question already has 4 choices.</div>';
    } else {
        $stmt_check = $conn->prepare("SELECT COUNT(*) FROM choices WHERE question_id = ? AND is_correct = 1 AND status=1");
        $stmt_check->bind_param("i", $question_id);
        $stmt_check->execute();
        $stmt_check->bind_result($correct_count);
        $stmt_check->fetch();
        $stmt_check->close();

        if ($correct_count > 0 && $is_correct == 1) {
            echo '<div class="alert alert-danger" role="alert">Error: A correct choice already exists for this question.</div>';
        } else {
            $stmt = $conn->prepare("INSERT INTO choices (question_id, choice, is_correct) VALUES (?, ?, ?)");
            $stmt->bind_param("isi", $question_id, $choice, $is_correct);

            // Execute and check
            if ($stmt->execute()) {
                echo '<div class="alert alert-success" role="alert">New choice added successfully</div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">Error: ' . $stmt->error . '</div>';
            }

            $stmt->close();
        }
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Choice</title>
</head>
<body>
    <div class="container mt-5">
    <h1>Add Choice for Question: <?php echo $question_name; ?></h1>
        <form method="post" action="">
            <div class="form-group">
                <label for="choice">Choice:</label>
                <?php
                if ($question_type === 'multiple_choice') {
                    echo '<input type="text" class="form-control" name="choice" required>';
                } elseif ($question_type === 'true_false') {
                    echo '<select class="form-control" name="choice" required>';
                    echo '<option value="true">True</option>';
                    echo '<option value="false">False</option>';
                    echo '</select>';
                }
                ?>
            </div>
            <div class="form-group">
                <label for="is_correct">Is Correct:</label>
                <select class="form-control" name="is_correct" required>
                    <option value="0">No</option>
                    <option value="1">Yes</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Add Choice</button>
            <a href="?page=view_choices&id=<?php echo $question_id; ?>&exam_id=<?php echo $exam_id; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>