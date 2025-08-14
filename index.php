<?php
require 'db_connection.php';

// جلب الكتب من قاعدة البيانات
$sql = "SELECT * FROM books ORDER BY id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>📚 Bookarma - Library</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body>

<div class="page-wrapper d-flex flex-column min-vh-100">

  <?php include 'includes/nav.php'; ?>

  <!-- إضافة كلاس main-content هنا -->
  <div class="container main-content flex-grow-1">
    <h1 class="text-center mb-4">📚 Bookarma - Your Library</h1>

    <div class="text-center mb-4">
      <a href="add-book.php" class="btn btn-success">➕ Add New Book</a>
    </div>

    <?php if ($result && $result->num_rows > 0): ?>
      <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($book = $result->fetch_assoc()): ?>
          <div class="col">
            <div class="card h-100 shadow-sm">
              <div class="card-body">
                <h5 class="card-title"><?= htmlspecialchars($book['title']) ?></h5>
                <h6 class="card-subtitle mb-2 text-muted">by <?= htmlspecialchars($book['author']) ?></h6>
                <p><strong>Category:</strong> <?= htmlspecialchars($book['category']) ?></p>
                <p class="card-text"><?= nl2br(htmlspecialchars($book['description'])) ?></p>
              </div>
              <div class="card-footer d-flex justify-content-between align-items-center">
                <small class="text-muted">Added on <?= date("F j, Y", strtotime($book['created_at'])) ?></small>
                <div>
                  <a href="edit-book.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                  <a href="delete-book.php?id=<?= $book['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this book?');">Delete</a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    <?php else: ?>
      <div class="text-center">
        <p class="text-muted fs-5">🚫 No books found. Start by adding a new one!</p>
      </div>
    <?php endif; ?>
  </div>

  <?php include 'includes/footer.php'; ?>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>