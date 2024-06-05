<?php
$question_id = $_GET['id'];

$exam_id = $_GET['exam_id'];
echo $exam_id;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $choice_id = $_POST['choice_id'];
    $action = $_POST['action'];

    if ($action == 'disable') {
        $new_status = 0;
    } elseif ($action == 'enable') {
        $new_status = 1;
    }

    $stmt = $conn->prepare("UPDATE choices SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_status, $choice_id);

    if ($stmt->execute()) {
        $message = "Choice status updated successfully.";
        $reloadPage = true;
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}

$stmt = $conn->prepare("
    SELECT q.question, c.id AS choice_id, c.choice, c.is_correct, c.status
    FROM questions q
    LEFT JOIN choices c ON q.id = c.question_id
    WHERE q.id = ?
");

$stmt->bind_param("i", $question_id);
$stmt->execute();
$result = $stmt->get_result();

$choices = [];
while ($row = $result->fetch_assoc()) {
    $choices[] = $row;
}

$question_name = $choices[0]['question'];

$stmt->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Choices</title>
</head>
<body>
    <div class="container mt-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>
        <h1>Choices for Question: <?php echo($question_name); ?></h1>
        <a href="?page=add_choice&id=<?php echo ($question_id) ?>&exam_id='<?php echo ($exam_id); ?>" class="btn btn-primary mb-3">Add New Choice</a>
        <a href="?page=view_questions&id=<?php echo $exam_id; ?>" class="btn btn-secondary mb-3">Go Back to Questions</a>
        <h2>Choices List</h2>
        <?php if (count($choices) > 0 && $choices[0]['choice_id'] !== null): ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Choice</th>
                    <th>Is Correct</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($choices as $row) { ?>
                <tr>
                    <td><?php echo ($row['choice_id']); ?></td>
                    <td><?php echo ($row['choice']); ?></td>
                    <td><?php echo ($row['is_correct']); ?></td>
                    <td><?php echo ($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 1): ?>
                            <form method="post" action="">
                                <input type="hidden" name="choice_id" value="<?php echo $row['choice_id']; ?>">
                                <input type="hidden" name="action" value="disable">
                                <button type="submit" class="btn btn-secondary btn-sm">Disable</button>
                            </form>
                        <?php else: ?>
                            <form method="post" action="">
                                <input type="hidden" name="choice_id" value="<?php echo $row['choice_id']; ?>">
                                <input type="hidden" name="action" value="enable">
                                <button type="submit" class="btn btn-success btn-sm">Enable</button>
                            </form>
                        <?php endif; ?>
                        <br>
                        <a href="?page=edit_choice&id=<?php echo ($row['choice_id']); ?>&question_id=<?php echo ($question_id); ?>&exam_id=<?php echo ($exam_id); ?>" class="btn btn-warning btn-sm">Edit</a>

                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <?php else: ?>
            <p>No choices available for this question.</p>
        <?php endif; ?>
    </div>
