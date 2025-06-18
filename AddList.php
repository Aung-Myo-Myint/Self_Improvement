<?php 

require 'config.php';
if ($_POST) {
    $title=$_POST['title'];
    $desc=$_POST['description'];


    $sql="INSERT INTO todo(title,description) VALUES (:title,:description)";
    $pdostatement = $pdo -> prepare($sql);
    $result=$pdostatement->execute(
        array(
            ':title'=>$title,
            ':description'=>$desc
        )
    );
    if($result){
        echo "<script>alert('New To Do is  added');window.location.href='index.php'</script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
    <title>Add New Tasks</title>
</head>
<body>

<div class="container mt-5">
    <div class="card p-4">
        <h2 class="mb-4">Create New To Do List Title</h2>
        <form action="AddList.php" method="POST">
            <div class="form-group mb-3">
                <label for="title">Title</label>
                <input type="text" class="form-control" name="title" id="title" required>
            </div>

            <div class="form-group mb-3">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" rows="5"></textarea>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a href="index.php" class="btn btn-warning">Back</a>
            </div>
        </form>
    </div>
</div>
    
</body>
</html>