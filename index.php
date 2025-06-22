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
  <title>CyberCore Tasks | Productivity Platform</title>

  <!-- Bootstrap, Icons, Google Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;800&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      background: #0e0f11;
      color: #e0e0e0;
      font-family: 'Rubik', sans-serif;
    }

    .navbar {
      background: linear-gradient(90deg, #00eaff, #ff007d);
      padding: 1rem;
    }

    .navbar-brand {
      font-family: 'Orbitron', sans-serif;
      font-weight: 800;
      color: #000;
    }

    .hero {
      background: url('https://images.unsplash.com/photo-1633158829870-6229507f5d6e?auto=format&fit=crop&w=1600&q=80') no-repeat center center/cover;
      height: 400px;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #fff;
      text-shadow: 0 2px 10px rgba(0,0,0,0.8);
    }

    .hero h1 {
      font-family: 'Orbitron', sans-serif;
      font-size: 3rem;
    }

    .btn-neon {
      background-color: #b6ff00;
      color: #000;
      font-weight: 600;
      border: none;
      box-shadow: 0 0 8px #b6ff00;
    }

    .card {
      background: #1b1c1f;
      border: 1px solid #00eaff;
      border-radius: 1rem;
      box-shadow: 0 0 16px rgba(0, 234, 255, 0.2);
    }

    .table thead {
      background: rgba(0, 234, 255, 0.1);
      color: #00eaff;
    }

    footer {
      background: #121214;
      color: #888;
      text-align: center;
      padding: 2rem 0;
      margin-top: 4rem;
    }
  </style>
</head>

<body>
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="#">CyberCore</a>
      <a href="AddList.php" class="btn btn-neon">+ New Task</a>
    </div>
  </nav>

  <div class="hero text-center">
    <div>
      <h1>Manage Tasks in Style</h1>
      <p class="lead">Stay focused. Stay productive. With CyberCore.</p>
    </div>
  </div>

  <div class="container py-5">
    <div class="card">
      <div class="card-body">
        <h3 class="text-primary mb-4"><i class="bi bi-kanban-fill"></i> Your Tasks</h3>

        <div class="table-responsive">
          <table class="table table-striped table-dark">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              <?php $i=1; foreach($result as $row): ?>
              <tr>
                <td><?= $i++; ?></td>
                <td><?= htmlspecialchars($row['Title']); ?></td>
                <td><?= htmlspecialchars($row['Description']); ?></td>
                <td><?= date('Y-m-d', strtotime($row['CreatedAt'])); ?></td>
                <td>
                  <a href="EditList.php?id=<?= $row['List_id']; ?>" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></a>
                  <a href="Delete.php?id=<?= $row['List_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')"><i class="bi bi-trash"></i></a>
                </td>
              </tr>
              <?php endforeach; ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2025 CyberCore Inc. | Built for doers, dreamers, and developers.</p>
  </footer>

</body>
</html>
