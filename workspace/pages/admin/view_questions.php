<?php
$exam_id = $_GET['id'];
$message = '';
$exam_title = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $question_id = $_POST['question_id'];
    $action = $_POST['action'];

    if ($action == 'disable') {
        $new_status = 0;
    } elseif ($action == 'enable') {
        $new_status = 1;
    }

    $stmt = $conn->prepare("UPDATE questions SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_status, $question_id);

    if ($stmt->execute()) {
        $message = "Question status updated successfully.";
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$sql = "
    SELECT 
        q.*, 
        e.title AS title 
    FROM 
        questions q 
    JOIN 
        exams e ON q.exam_id = e.id 
    WHERE 
        q.exam_id = ? 
    ORDER BY 
        q.status = 1 DESC";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $exam_id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $exam_title = $row['title'];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Questions</title>

</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Questions for Exam: <?php echo ($exam_title); ?></h1>
        <?php if (!empty($message)): ?>
            <div class="alert alert-info">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>
        <a href="?page=add_question&exam_id=<?php echo ($exam_id); ?>" class="btn btn-primary mb-3">Add New Question</a>
        <a href="?page=admin_dashboard" class="btn btn-secondary mb-3">Back to Dashboard</a>
        <h2 class="mb-4">Questions List</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Question</th>
                    <th>Type</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo ($row['id']); ?></td>
                        <td><?php echo ($row['question']); ?></td>
                        <td><?php echo ($row['type']); ?></td>
                        <td><?php echo ($row['status']); ?></td>
                        <td>
                            <a href="?page=edit_question&id=<?php echo ($row['id']); ?>&exam_id=<?php echo ($exam_id); ?>" class="btn btn-info btn-sm">Edit</a>
                            <a href="?page=view_choices&id=<?php echo ($row['id']); ?>&exam_id=<?php echo ($exam_id); ?>" class="btn btn-secondary btn-sm">View Choices</a>
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="question_id" value="<?php echo ($row['id']); ?>">
                                <?php if ($row['status'] == 1): ?>
                                    <button type="submit" name="action" value="disable" class="btn btn-danger btn-sm">Disable</button>
                                <?php else: ?>
                                    <button type="submit" name="action" value="enable" class="btn btn-success btn-sm">Enable</button>
                                <?php endif; ?>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>