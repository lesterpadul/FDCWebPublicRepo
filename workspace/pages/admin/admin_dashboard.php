<?php
// Fetch exams from the database
$sql = "SELECT * FROM exams";
$result = $conn->query($sql);

$reloadPage = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $exam_id = $_POST['exam_id'];
    $action = $_POST['action'];

    if ($action == 'disable') {
        $new_status = 0;
    } elseif ($action == 'enable') {
        $new_status = 1;
    }

    $stmt = $conn->prepare("UPDATE exams SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $new_status, $exam_id);

    if ($stmt->execute()) {
        $message = "Exam status updated successfully.";
        $reloadPage = true;
    } else {
        $message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
</head>
<body>
<div class="container mt-5">
    <h1 class="mb-4">Admin Dashboard</h1>
    <?php if (isset($message)): ?>
        <div class="alert alert-info">
            <?php echo $message; ?>
        </div>
    <?php endif; ?>
    <a href="?page=add_exam" class="btn btn-primary mb-3">Add New Exam</a>
    <h2>Exams List</h2>
    <table class="table table-bordered">
        <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo ($row['id']); ?></td>
                <td><?php echo ($row['title']); ?></td>
                <td><?php echo ($row['description']); ?></td>
                <td><?php echo ($row['status']); ?></td>
                <td>
                    <a href="?page=edit_exam&id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="?page=view_questions&id=<?php echo $row['id']; ?>" class="btn btn-info btn-sm">View Questions</a>
                    <?php if ($row['status']): ?>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="exam_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="action" value="disable">
                            <button type="submit" class="btn btn-secondary btn-sm">Disable</button>
                        </form>
                    <?php else: ?>
                        <form method="post" action="" style="display:inline;">
                            <input type="hidden" name="exam_id" value="<?php echo $row['id']; ?>">
                            <input type="hidden" name="action" value="enable">
                            <button type="submit" class="btn btn-success btn-sm">Enable</button>
                        </form>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php if ($reloadPage): ?>
    <script>
        reloadPage();
    </script>
<?php endif; ?>


<script>
        function reloadPage() {
            if (window.location.href.indexOf('reloadPage=1') === -1) {
                window.location.href = window.location.href + '?reloadPage=1';
            }
        }
</script>