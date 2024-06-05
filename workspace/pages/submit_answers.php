
<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answers'], $_POST['exam_id'], $_SESSION['user_id'])) {
    $student_id = $_SESSION['user_id'];
    $exam_id = $_POST['exam_id'];
    
    if (!is_numeric($exam_id)) {
        die("Error: Invalid exam ID.");
    }

    $answers = $_POST['answers'];
    $total_questions = count($answers);
    $correct_answers = 0;

    $correct_choices = [];
    $stmt_correct = $conn->prepare("
        SELECT question_id, id AS correct_choice_id
        FROM choices
        WHERE question_id IN (
            SELECT id FROM questions WHERE exam_id = ? AND status = 1
        ) AND is_correct = 1
    ");
    $stmt_correct->bind_param("i", $exam_id);
    $stmt_correct->execute();
    $result_correct = $stmt_correct->get_result();
    while ($row_correct = $result_correct->fetch_assoc()) {
        $correct_choices[$row_correct['question_id']] = $row_correct['correct_choice_id'];
    }
    $stmt_correct->close();

    foreach ($answers as $question_id => $user_choice) {
        $stmt = $conn->prepare("SELECT is_correct FROM choices WHERE question_id = ? AND id = ?");
        $stmt->bind_param("ii", $question_id, $user_choice);
        $stmt->execute();
        $stmt->bind_result($is_correct);
        $stmt->fetch();
        $stmt->close();

        $stmt_insert = $conn->prepare("INSERT INTO student_answers (user_id, exam_id, question_id, choice_id) VALUES (?, ?, ?, ?)");
        $stmt_insert->bind_param("iiii", $student_id, $exam_id, $question_id, $user_choice);
        $stmt_insert->execute();
        $stmt_insert->close();

        if ($is_correct) {
            $correct_answers++;
        }
    }

    $score = ($correct_answers / $total_questions) * 100;
?>

<div class="container mt-5">
    <h1>Your Score</h1>
    <p>You answered <?php echo $correct_answers; ?> out of <?php echo $total_questions; ?> questions correctly.</p>
    <p>Your score is <?php echo $score; ?>%</p>

    <h2>Correct Answers</h2>
    <?php foreach ($correct_choices as $question_id => $correct_choice_id) { ?>
        <?php
            $stmt_question = $conn->prepare("SELECT question FROM questions WHERE id = ?");
            $stmt_question->bind_param("i", $question_id);
            $stmt_question->execute();
            $stmt_question->bind_result($question);
            $stmt_question->fetch();
            $stmt_question->close();

            $stmt_choice = $conn->prepare("SELECT choice FROM choices WHERE id = ?");
            $stmt_choice->bind_param("i", $correct_choice_id);
            $stmt_choice->execute();
            $stmt_choice->bind_result($correct_choice);
            $stmt_choice->fetch();
            $stmt_choice->close();
        ?>
        <p><strong><?php echo $question; ?></strong>: <?php echo $correct_choice; ?></p>
    <?php } ?>
</div>

<?php
} else {
?>

<div class="container mt-5">
    <p class="alert alert-warning">No answers submitted.</p>
</div>

<?php
}

$conn->close();

?>
