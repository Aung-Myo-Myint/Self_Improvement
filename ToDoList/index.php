<?php 
require 'config.php';


?>
 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body>

<?php 
    $pdostatement = $pdo->prepare("SELECT * FROM todo ORDER BY List_id DESC");
    $pdostatement->execute();
    $result = $pdostatement->fetchAll();

?>

<div class="card">

<div class="card-body">

    <h2>To Do Home Page</h2>
    <a href="AddList.php" type="button" class="btn btn-success">Create</a> <br> 

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody> 
            <?php 
            $i=1;
            if($result){
                foreach ($result as $value){
                 ?> 

                 <tr>
                <td><?php echo $i;?></td>
                <td><?php echo $value['Title'];?></td>
                <td><?php echo $value['Description'];?></td>
                <td><?php  echo date('Y-m-d',strtotime($value['CreatedAt']))?></td>
                <td>
   <a href="EditList.php" type="button" class="btn btn-warning">Edit</a>

   <a href="#" type="button" class="btn btn-danger">Delete</a>
                </td>
            </tr>
                 
                 <?php 
                 $i++;
                }
            }
            ?>
            
        </tbody>

    </table>

</div>

</div>
    
</body>
</html>