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
  <title>📝 To‑Do // CYBERCORE</title>

  <!-- Bootstrap & Icons -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <!-- Orbitron font for neo‑tech headings -->
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;800&display=swap" rel="stylesheet">

  <style>
    /* ===== cyber‑punk palette ===== */
    :root{
      --c‑bg‑1:#05060a;
      --c‑bg‑2:#2e005f;
      --c‑neon‑pink:#ff007d;
      --c‑neon‑blue:#00eaff;
      --c‑acid‑green:#b6ff00;
    }

    /* ==== global look ==== */
    body{
      background: radial-gradient(circle at top right,var(--c‑bg‑2),var(--c‑bg‑1) 70%);
      min-height:100vh;
      color:#cfd0d3;
      font-family: 'Segoe UI', sans-serif;
      overflow-x:hidden;
    }
    .scanlines::before{           /* faint CRT scan‑lines */
      content:'';
      position:fixed;inset:0;
      background: repeating-linear-gradient(
                 0deg,
                 transparent 0,
                 rgba(255,255,255,.03) 2px,
                 transparent 4px);
      pointer-events:none;
    }
    h1,h4,nav .navbar-brand{
      font-family:'Orbitron',sans-serif;
      letter-spacing:1px;
    }

    /* nav */
    nav.navbar{
      background:linear-gradient(90deg,var(--c‑neon‑pink),var(--c‑neon‑blue));
    }
    nav .navbar-brand{
      color:#000;
      font-weight:800;
      text-shadow:0 0 6px rgba(0,0,0,.7);
    }

    /* neon button */
    .btn-neon{
      position:relative;
      color:#000;
      font-weight:600;
      background:var(--c‑acid‑green);
      border:none;
      box-shadow:0 0 8px var(--c‑acid‑green),0 0 16px var(--c‑acid‑green);
      transition:transform .15s ease;
    }
    .btn-neon:hover{ transform:translateY(-2px) scale(1.03); }

    /* card & table styling */
    .card{
      background:rgba(0,0,0,.55);
      border:1px solid var(--c‑neon‑blue);
      border-radius:1rem;
      box-shadow:0 0 20px rgba(0,234,255,.4);
    }
    .table thead{
      background:rgba(0,234,255,.15);
      color:var(--c‑neon‑blue);
      border-bottom:2px solid var(--c‑neon‑blue);
    }
    .table tbody tr{
      transition:background .2s ease;
    }
    .table tbody tr:hover{
      background:rgba(255,0,125,.1);
    }
    .table td,.table th{vertical-align:middle;}

    /* action buttons */
    .btn-action{
      border:none;
      padding:.25rem .6rem;
      font-size:.75rem;
      font-weight:600;
      color:#000;
    }
    .btn-edit{
      background:var(--c‑neon‑blue);
      box-shadow:0 0 6px var(--c‑neon‑blue);
    }
    .btn-delete{
      background:var(--c‑neon‑pink);
      box-shadow:0 0 6px var(--c‑neon‑pink);
    }
    .btn-edit:hover,.btn-delete:hover{transform:scale(1.05);}
  </style>
</head>

<body class="scanlines">

<!-- neon nav -->
<nav class="navbar navbar-expand shadow-sm py-2">
  <div class="container">
    <a class="navbar-brand" href="#"><i class="bi bi-kanban-fill"></i> CYBER TODO</a>
    <a href="AddList.php" class="btn btn-neon"><i class="bi bi-plus-circle"></i> New Task</a>
  </div>
</nav>

<!-- main -->
<div class="container py-5 fade-in">
  <div class="card shadow-lg">
    <div class="card-body px-4 py-5">
      <h4 class="mb-4 text-uppercase" style="color:var(--c‑neon‑blue);"><i class="bi bi-list-check"></i> Task Dashboard</h4>

      <div class="table-responsive">
        <table class="table table-hover align-middle">
          <thead>
            <tr>
              <th>#</th>
              <th>Title</th>
              <th>Description</th>
              <th>Created</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
          <?php $i=1; foreach($result as $row): ?>
            <tr>
              <th scope="row"><?= $i++; ?></th>
              <td><?= htmlspecialchars($row['Title']); ?></td>
              <td class="text-truncate" style="max-width:320px;"><?= htmlspecialchars($row['Description']); ?></td>
              <td><?= date('Y-m-d',strtotime($row['CreatedAt'])); ?></td>
              <td class="text-center">
                <a href="EditList.php?id=<?= $row['List_id']; ?>" class="btn btn-action btn-edit me-1">
                  <i class="bi bi-pencil-fill"></i>
                </a>
                <a href="Delete.php?id=<?= $row['List_id']; ?>" class="btn btn-action btn-delete"
                   onclick="return confirm('Delete this task?')">
                  <i class="bi bi-trash-fill"></i>
                </a>
              </td>
            </tr>
          <?php endforeach; ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>

</body>
</html>