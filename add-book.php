<?php require 'db_connection.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Book - Bookarma</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="assets/style.css" />
</head>
<body class="bg-light p-4">

  <?php include 'includes/nav.php'; ?>

  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <h1 class="text-center mb-4">➕ Add a New Book</h1>

        <div class="card shadow">
          <div class="card-body">
            <form action="save-book.php" method="post">
              <div class="mb-3">
                <label for="title" class="form-label">📖 Book Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
              </div>

              <div class="mb-3">
                <label for="author" class="form-label">✍️ Author</label>
                <input type="text" class="form-control" id="author" name="author" required>
              </div>

              <div class="mb-3">
                <label for="category" class="form-label">📚 Category</label>
                <select class="form-select" id="category" name="category" required>
                  <option value="" disabled selected>Select category</option>
                  <option>Fiction</option>
                  <option>Non-Fiction</option>
                  <option>Biography</option>
                  <option>Science</option>
                  <option>History</option>
                  <option>Romance</option>
                  <option>Mystery</option>
                  <option>Fantasy</option>
                  <option>Self-Help</option>
                  <option>Other</option>
                </select>
              </div>

              <div class="mb-3">
                <label for="description" class="form-label">📝 Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter a brief description of the book..."></textarea>
              </div>

              <div class="d-grid gap-2 d-md-flex justify-content-md-center">
                <button type="submit" class="btn btn-primary">💾 Save Book</button>
                <a href="index.php" class="btn btn-secondary">🔙 Back to Library</a>
              </div>
            </form>
          </div>
        </div>

      </div>
    </div>
  </div>

  <?php include 'includes/footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
