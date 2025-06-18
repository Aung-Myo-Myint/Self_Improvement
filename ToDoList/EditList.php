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

echo "<pre>";
print_r($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Edit Task</title>
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Edit Title</h2>
        <form action="" method="POST">
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" required value="<?php echo $result[0]['Title'] ?>">
            </div>

            <div class="form-group mb-3">
                <label for="description">Edit Description</label>
               <textarea name="description" id="description" class="form-control" rows="5"><?php echo $result[0]['Description']; ?></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Update">
                <a href="index.php" class="btn btn-warning">Back</a>
            </div>


    <input type="hidden" name="List_id" value="<?php echo $result[0]['List_id'] ?>">


        </form>
    </div>
</div>
    
</body>
</html>