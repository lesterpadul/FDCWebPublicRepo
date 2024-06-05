<?php

if (isset($_GET['id'])) {
    $userId = intval($_GET['id']);

    $sql = "UPDATE users SET status = 0 WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userId);

    if ($stmt->execute()) {
        echo "<script>alert('User disabled successfully.'); window.location.href = '?page=view_users';</script>";
    } else {
        echo "<script>alert('Error disabling user: " . $stmt->error . "'); window.location.href = '?page=view_users';</script>";
    }

    $stmt->close();
} else {
    echo "<script>alert('Invalid user ID.'); window.location.href = '?page=view_users';</script>";
}

$conn->close();
?>