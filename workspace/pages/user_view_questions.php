<?php
if (!isset($_GET['exam_id']) || !is_numeric($_GET['exam_id'])) {
    die("Invalid exam ID.");
}

$exam_id = $_GET['exam_id'];

$sql = "
    SELECT q.id AS question_id, q.question, q.type, c.id AS choice_id, c.choice, c.is_correct
    FROM questions q
    INNER JOIN choices c ON q.id = c.question_id
    WHERE q.exam_id = ? AND q.status = 1 AND c.status = 1
    AND EXISTS (
        SELECT 1
        FROM choices c2
        WHERE c2.question_id = q.id AND c2.is_correct = 1 AND c2.status = 1
    )
    ORDER BY q.id, c.id";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$result = $stmt->get_result();
    
$questions = [];
while ($row = $result->fetch_assoc()) {
    $question_id = $row['question_id'];
    if (!isset($questions[$question_id])) {
        $questions[$question_id] = [
            'question' => $row['question'],
            'type' => $row['type'],
            'choices' => []
        ];
    }
    $questions[$question_id]['choices'][] = [
        'choice_id' => $row['choice_id'],
        'choice' => $row['choice'],
        'is_correct' => $row['is_correct']
    ];
}
    
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Questions</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Questions for Exam</h1>
        <form method="post" action="?page=submit_answers&exam_id=<?php echo $exam_id; ?>">
            <input type="hidden" name="exam_id" value="<?php echo $exam_id; ?>">
            <input type="hidden" name="user_id" value="<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>">

            <?php foreach ($questions as $question_id => $question_data) { ?>
                <div class="mb-4">
                    <h2><?php echo $question_data['question']; ?></h2>
                    <?php foreach ($question_data['choices'] as $choice) { ?>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="answers[<?php echo $question_id; ?>]" id="choice<?php echo $choice['choice_id']; ?>" value="<?php echo $choice['choice_id']; ?>" required>
                            <label class="form-check-label" for="choice<?php echo $choice['choice_id']; ?>"><?php echo $choice['choice']; ?></label>
                        </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <button type="submit" class="btn btn-primary">Submit Answers</button>
        </form>
    </div>
</body>
</html>
