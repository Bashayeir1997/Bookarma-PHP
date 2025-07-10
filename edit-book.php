<?php
require 'db_connection.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid book ID.");
}

$id = intval($_GET['id']);

$sql = "SELECT * FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    die("Book not found.");
}

$book = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $category = $_POST['category'];
    $description = trim($_POST['description']);

    if (!empty($title) && !empty($author) && !empty($category)) {
        $update_sql = "UPDATE books SET title = ?, author = ?, category = ?, description = ? WHERE id = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ssssi", $title, $author, $category, $description, $id);
        if ($update_stmt->execute()) {
            header("Location: index.php?message=updated");
            exit;
        } else {
            $error = "Failed to update: " . $conn->error;
        }
    } else {
        $error = "Please fill in all required fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Edit Book - Bookarma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
<link rel="stylesheet" href="assets/style.css" />

</head>
<body class="bg-light p-5">
  <div class="container">
    <h1 class="text-center mb-4">✏️ Edit Book</h1>

    <?php if (!empty($error)): ?>
      <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
    <?php endif; ?>

    <form action="" method="post" class="border p-4 rounded bg-white shadow-sm">
      <div class="mb-3">
        <label for="title" class="form-label">📖 Book Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= htmlspecialchars($book['title']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="author" class="form-label">✍️ Author</label>
        <input type="text" class="form-control" id="author" name="author" value="<?= htmlspecialchars($book['author']) ?>" required>
      </div>

      <div class="mb-3">
        <label for="category" class="form-label">📚 Category</label>
        <select class="form-select" id="category" name="category" required>
          <option value="" disabled>Select category</option>
          <?php
          $categories = ['Fiction', 'Non-Fiction', 'Biography', 'Science', 'Other'];
          foreach ($categories as $cat) {
              $selected = ($cat === $book['category']) ? 'selected' : '';
              echo "<option value=\"$cat\" $selected>$cat</option>";
          }
          ?>
        </select>
      </div>

      <div class="mb-3">
        <label for="description" class="form-label">📝 Description</label>
        <textarea class="form-control" id="description" name="description" rows="4"><?= htmlspecialchars($book['description']) ?></textarea>
      </div>

      <button type="submit" class="btn btn-primary w-100">Update Book</button>
    </form>
  </div>
</body>
</html>
