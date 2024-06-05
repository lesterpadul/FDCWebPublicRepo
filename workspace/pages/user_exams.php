<?php
$student_id = $_SESSION['user_id'];

$sql_available = "
    SELECT e.id, e.title 
    FROM exams e 
    LEFT JOIN (
        SELECT exam_id 
        FROM student_answers 
        WHERE user_id = ?
    ) sa 
    ON e.id = sa.exam_id 
    WHERE e.status = 1 
    AND sa.exam_id IS NULL
";
$stmt_available = $conn->prepare($sql_available);
$stmt_available->bind_param("i", $student_id);
$stmt_available->execute();
$result_available = $stmt_available->get_result();

$sql_taken = "
    SELECT DISTINCT e.id, e.title 
    FROM exams e 
    INNER JOIN student_answers sa 
    ON e.id = sa.exam_id 
    WHERE e.status = 1 
    AND sa.user_id = ?
";
$stmt_taken = $conn->prepare($sql_taken);
$stmt_taken->bind_param("i", $student_id);
$stmt_taken->execute();
$result_taken = $stmt_taken->get_result();

if (!$result_available || !$result_taken) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Available Exams</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Available Exams</h1>
        <ul class="list-group mb-5">
            <?php while($exam = $result_available->fetch_assoc()) { ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?php echo ($exam['title']); ?>
                    <a href="?page=user_view_questions&exam_id=<?php echo $exam['id']; ?>" class="btn btn-primary">Take Exam</a>
                </li>
            <?php } ?>
        </ul>

        <h1 class="mb-4">Taken Exams</h1>
        <ul class="list-group">
            <?php while($exam = $result_taken->fetch_assoc()) { ?>
                <li class="list-group-item">
                    <?php echo ($exam['title']); ?>
                </li>
            <?php } ?>
        </ul>
    </div>
</body>
</html>
