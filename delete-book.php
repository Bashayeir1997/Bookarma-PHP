<?php
require 'db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid book ID.");
}

$id = intval($_GET['id']);

$sql = "DELETE FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: index.php?message=deleted");
    exit;
} else {
    echo "Failed to delete: " . $conn->error;
}
?>
