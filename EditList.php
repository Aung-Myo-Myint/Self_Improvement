<?php 
require 'config.php';

if ($_POST) {
    $title = $_POST['title'];
    $desc = $_POST['description'];
    $id = $_POST['List_id'];

    $sql = "UPDATE todo SET Title = :title, Description = :desc WHERE List_id = :id";
    $pdostatement = $pdo->prepare($sql);
    $result = $pdostatement->execute([
        ':title' => $title,
        ':desc' => $desc,
        ':id' => $id
    ]);

    if ($result) {
        echo "<script>alert('To-Do has been updated');window.location.href='index.php'</script>";
    }
} else {
    $pdostatement = $pdo->prepare("SELECT * FROM todo WHERE List_id = :id");
    $pdostatement->execute([':id' => $_GET['id']]);
    $result = $pdostatement->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>✏️ Edit Task</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <style>
    body {
      background: #f5f7fa;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 1rem;
    }
    .form-label {
      font-weight: 600;
    }
    .fade-in {
      animation: fadeIn 0.6s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark">
  <div class="container">
    <a class="navbar-brand" href="index.php">🗂️ My To Do List</a>
  </div>
</nav>

<!-- Main Content -->
<div class="container mt-5 fade-in">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-lg">
        <div class="card-body p-4">
          <h3 class="mb-4 fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Task</h3>
          <form action="" method="POST">
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" class="form-control" name="title" id="title" required 
                     value="<?php echo htmlspecialchars($result[0]['Title']); ?>">
            </div>

            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea name="description" id="description" class="form-control" rows="5"><?php echo htmlspecialchars($result[0]['Description']); ?></textarea>
            </div>

            <input type="hidden" name="List_id" value="<?php echo $result[0]['List_id']; ?>">

            <div class="d-flex justify-content-between">
              <a href="index.php" class="btn btn-warning">
                <i class="bi bi-arrow-left"></i> Back
              </a>
              <button type="submit" class="btn btn-primary">
                <i class="bi bi-save"></i> Update
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

</body>
</html>