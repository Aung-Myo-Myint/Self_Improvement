<?php 
require 'config.php';

$pdostatement = $pdo->prepare("SELECT * FROM todo ORDER BY List_id DESC");
$pdostatement->execute();
$result = $pdostatement->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>📝 To Do List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <style>
    body {
      background: #f0f2f5;
      font-family: 'Segoe UI', sans-serif;
    }
    .card {
      border-radius: 1rem;
    }
    .table td, .table th {
      vertical-align: middle;
    }
    .btn i {
      margin-right: 4px;
    }
    .btn-danger:hover, .btn-warning:hover {
      transform: scale(1.03);
    }
    .fade-in {
      animation: fadeIn 0.5s ease-in-out;
    }
    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(10px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>


<nav class="navbar navbar-dark bg-dark mb-4">
  <div class="container">
    <a class="navbar-brand" href="#">🗂️ My To Do List</a>
    <a href="AddList.php" class="btn btn-success"><i class="bi bi-plus-circle"></i> Create Task</a>
  </div>
</nav>

<!-- Main Content -->
<div class="container fade-in">
  <div class="card shadow-lg">
    <div class="card-body">
      <h4 class="mb-4 fw-bold text-primary">📋 Task Overview</h4>

      <div class="table-responsive">
        <table class="table table-striped table-hover align-middle">
          <thead class="table-primary">
            <tr>
              <th scope="col">#</th>
              <th scope="col">Title</th>
              <th scope="col">Description</th>
              <th scope="col">Created Date</th>
              <th scope="col" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $i = 1;
            if ($result) {
              foreach ($result as $value) {
            ?>
            <tr>
              <th scope="row"><?php echo $i++; ?></th>
              <td><?php echo htmlspecialchars($value['Title']); ?></td>
              <td class="text-truncate" style="max-width: 300px;"><?php echo htmlspecialchars($value['Description']); ?></td>
              <td><?php echo date('Y-m-d', strtotime($value['CreatedAt'])); ?></td>
              <td class="text-center">
                <a href="EditList.php?id=<?php echo $value['List_id']; ?>" class="btn btn-sm btn-warning me-2">
                  <i class="bi bi-pencil-square"></i> Edit
                </a>
                <a href="Delete.php?id=<?php echo $value['List_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure to delete this task?');">
                  <i class="bi bi-trash"></i> Delete
                </a>
              </td>
            </tr>
            <?php 
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Icons CDN -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

</body>
</html>