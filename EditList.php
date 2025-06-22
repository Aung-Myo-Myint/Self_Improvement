<?php 
require 'config.php';

// ────────────────────────────────────────────────────────────────────────
//  Handle form submit + update
// ────────────────────────────────────────────────────────────────────────
if ($_POST) {
    $title = $_POST['title'];
    $desc  = $_POST['description'];
    $id    = $_POST['List_id'];

    $sql  = "UPDATE todo SET Title = :title, Description = :desc WHERE List_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':title' => $title,
        ':desc'  => $desc,
        ':id'    => $id
    ]);

    echo "<script>alert('Task updated!');window.location.href='index.php';</script>";
    exit;
}

// ────────────────────────────────────────────────────────────────────────
//  Fetch the record we want to edit
// ────────────────────────────────────────────────────────────────────────
$stmt = $pdo->prepare("SELECT * FROM todo WHERE List_id = :id");
$stmt->execute([':id' => $_GET['id'] ?? 0]);
$result = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$result) {
    echo "<script>alert('Task not found');window.location.href='index.php';</script>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>CyberCore | Edit Task</title>
  <!-- Bootstrap + Icons + Fonts -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet" />
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@600;800&family=Rubik:wght@400;600&display=swap" rel="stylesheet" />
  <style>
    :root {
      --clr-primary:#00eaff;
      --clr-accent:#ff007d;
    }
    body {
      background:#0e0f11;
      color:#e0e0e0;
      font-family:'Rubik',sans-serif;
      overflow-x:hidden;
    }
    /* ───── nav ───── */
    .navbar {
      background:linear-gradient(90deg,var(--clr-primary),var(--clr-accent));
      padding:1rem 0;
    }
    .navbar-brand {
      font-family:'Orbitron',sans-serif;
      font-weight:800;
      color:#000;
    }
    /* ───── hero banner ───── */
    .hero {
      background:url('https://images.unsplash.com/photo-1521737604893-d14cc237f11d?auto=format&fit=crop&w=1600&q=80') center/cover no-repeat;
      height:280px;
      display:flex;
      align-items:center;
      justify-content:center;
      position:relative;
    }
    .hero::after {
      content:'';
      position:absolute;inset:0;
      background:rgba(0,0,0,.55);
    }
    .hero h1 {
      position:relative;
      font-family:'Orbitron',sans-serif;
      font-size:2.5rem;
      color:var(--clr-primary);
      z-index:1;
    }
    /* ───── form card ───── */
    .card {
      background:#1b1c1f;
      border:1px solid var(--clr-primary);
      border-radius:1rem;
      box-shadow:0 0 16px rgba(0,234,255,.2);
    }
    .btn-neon {
      background:var(--clr-accent);
      border:none;
      color:#000;
      font-weight:600;
      box-shadow:0 0 8px var(--clr-accent);
    }
    .btn-neon:hover {box-shadow:0 0 12px var(--clr-accent);}
    label {font-weight:600;}
  </style>
</head>
<body>
  <!-- nav -->
  <nav class="navbar navbar-expand-lg">
    <div class="container">
      <a class="navbar-brand" href="index.php"><i class="bi bi-kanban-fill"></i> CYBERCORE</a>
    </div>
  </nav>

  <!-- hero -->
  <section class="hero mb-5">
    <h1><i class="bi bi-pencil-fill me-2"></i>Edit Your Task</h1>
  </section>

  <!-- main content -->
  <div class="container fade-in">
    <div class="row justify-content-center">
      <div class="col-lg-6">
        <div class="card p-4">
          <h3 class="text-center text-primary mb-4">Update Details</h3>
          <form method="POST" novalidate>
            <div class="mb-3">
              <label for="title" class="form-label">Title</label>
              <input type="text" id="title" name="title" class="form-control" required value="<?= htmlspecialchars($result['Title']); ?>" />
            </div>
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea id="description" name="description" rows="5" class="form-control"><?= htmlspecialchars($result['Description']); ?></textarea>
            </div>
            <input type="hidden" name="List_id" value="<?= $result['List_id']; ?>" />
            <div class="d-flex justify-content-between">
              <a href="index.php" class="btn btn-secondary"><i class="bi bi-arrow-left"></i> Cancel</a>
              <button class="btn btn-neon"><i class="bi bi-save"></i> Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
