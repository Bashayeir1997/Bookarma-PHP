<?php
require 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = trim($_POST['category']);
    $description = trim($_POST['description']);
    
    // Validation
    if (empty($title) || empty($author) || empty($category)) {
        $error = "Please fill in all required fields.";
    } else {
        // Use prepared statement for security
        $stmt = $conn->prepare("INSERT INTO books (title, author, category, description, created_at) VALUES (?, ?, ?, ?, NOW())");
        $stmt->bind_param("ssss", $title, $author, $category, $description);
        
        if ($stmt->execute()) {
            $success = "Book added successfully!";
        } else {
            $error = "Error adding book: " . $stmt->error;
        }
        
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Save Book - Bookarma</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
   <link rel="stylesheet" href="assets/style.css" />

</head>
<body class="bg-light p-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-body text-center">
                        <?php if (isset($success)): ?>
                            <div class="alert alert-success" role="alert">
                                ✅ <?= htmlspecialchars($success) ?>
                            </div>
                            <h3 class="text-success mb-3">Success!</h3>
                            <p>Your book has been added to the library.</p>
                        <?php elseif (isset($error)): ?>
                            <div class="alert alert-danger" role="alert">
                                ❌ <?= htmlspecialchars($error) ?>
                            </div>
                            <h3 class="text-danger mb-3">Error!</h3>
                            <p>There was a problem adding your book.</p>
                        <?php endif; ?>
                        
                        <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                            <a href="add-book.php" class="btn btn-secondary">Add Another Book</a>
                            <a href="index.php" class="btn btn-primary">Back to Library</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>