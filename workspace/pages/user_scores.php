
<?php

$user_id = $_SESSION['user_id'];

$stmt = $conn->prepare("
    SELECT e.id AS exam_id, e.title, 
           COUNT(DISTINCT q.id) AS total_questions,
           COUNT(DISTINCT CASE WHEN c.is_correct = 1 THEN s.id END) AS total_correct
    FROM exams e
    LEFT JOIN questions q ON e.id = q.exam_id
    LEFT JOIN student_answers s ON q.id = s.question_id AND s.user_id = ?
    LEFT JOIN choices c ON s.choice_id = c.id
    WHERE EXISTS (
        SELECT 1
        FROM choices c2
        WHERE c2.question_id = q.id AND c2.is_correct = 1
    )
    GROUP BY e.id
");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$exam_scores = [];
while ($row = $result->fetch_assoc()) {
    $total_correct = $row['total_correct'];
    $total_questions = $row['total_questions'];
    $title = $row['title'];
    $exam_id = $row['exam_id'];

    $score = ($total_correct / $total_questions) * 100;
    
    $exam_scores[] = [
        'title' => $title,
        'total_correct' => $total_correct,
        'total_questions' => $total_questions,
        'score' => $score,
    ];
}
$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Exam Scores</title>
</head>
<body>
    <div class="container mt-5">
        <h1>Exam Scores</h1>
        <?php if (!empty($exam_scores)): ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Exam Title</th>
                        <th>Total Questions</th>
                        <th>Total Correct</th>
                        <th>Score</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($exam_scores as $score): ?>
                        <tr>
                            <td><?php echo ($score['title']); ?></td>
                            <td><?php echo $score['total_questions']; ?></td>
                            <td><?php echo $score['total_correct']; ?></td>
                            <td><?php echo number_format($score['score'], 2); ?>%</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p class="alert alert-info">No exam scores found.</p>
        <?php endif; ?>
    </div>