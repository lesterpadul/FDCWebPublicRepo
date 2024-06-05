<?php
$exam_id = $_GET['exam_id'];
$message = '';

$stmt = $conn->prepare("SELECT title FROM exams WHERE id = ?");
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$stmt->bind_result($exam_title);
$stmt->fetch();
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question = $_POST['question'];
    $type = $_POST['type'];
    $ip_address = get_ip_address();

    $conn->begin_transaction();

    $stmt = $conn->prepare("INSERT INTO questions (exam_id, question, type, created_ip) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $exam_id, $question, $type, $ip_address);

    if ($stmt->execute()) {
        $question_id = $stmt->insert_id;
        $stmt->close();

        if ($type === 'true_false') {
            $correct_answer = $_POST['correct_answer'];
            $true_choice = "true";
            $false_choice = "false";

            $stmt_true = $conn->prepare("INSERT INTO choices (question_id, choice, is_correct, status) VALUES (?, ?, ?, 1)");
            $stmt_false = $conn->prepare("INSERT INTO choices (question_id, choice, is_correct, status) VALUES (?, ?, ?, 1)");

            $is_correct_true = ($correct_answer === 'true') ? 1 : 0;
            $is_correct_false = ($correct_answer === 'false') ? 1 : 0;

            $stmt_true->bind_param("isi", $question_id, $true_choice, $is_correct_true);
            $stmt_false->bind_param("isi", $question_id, $false_choice, $is_correct_false);

            if ($stmt_true->execute() && $stmt_false->execute()) {
                $conn->commit();
                $message = "New question created successfully with correct true/false choices.";
            } else {
                $conn->rollback();
                $message = "Error inserting true/false choices: " . $stmt_true->error . " " . $stmt_false->error;
            }

            $stmt_true->close();
            $stmt_false->close();
        } else {
            $conn->commit();
            $message = "New question created successfully.";
        }
    } else {
        $conn->rollback();
        $message = "Error: " . $stmt->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Question</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Add Question for Exam: <?php echo ($exam_title); ?></h1>
        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo (strpos($message, 'Error') !== false) ? 'danger' : 'success'; ?>">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <form method="post" action="">
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" name="question" required>
            </div>
            <div class="form-group">
                <label for="type">Type:</label>
                <select name="type" class="form-control" onchange="showCorrectAnswerOptions()">
                    <option value="multiple_choice">Multiple Choice</option>
                    <option value="true_false">True/False</option>
                </select>
            </div>
            <div id="correct-answer-options" class="form-group" style="display:none;">
                <label>Correct Answer:</label>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="correct_answer" value="true">
                    <label class="form-check-label">True</label>
                </div>
                <div class="form-check">
                    <input type="radio" class="form-check-input" name="correct_answer" value="false">
                    <label class="form-check-label">False</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Question</button>
            <a href="?page=view_questions&id=<?php echo $exam_id; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>

<script>
        function showCorrectAnswerOptions() {
            var type = document.querySelector('select[name="type"]').value;
            if (type === 'true_false') {
                document.getElementById('correct-answer-options').style.display = 'block';
            } else {
                document.getElementById('correct-answer-options').style.display = 'none';
            }
        }
</script>