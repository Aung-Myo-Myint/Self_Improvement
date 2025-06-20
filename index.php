<?php 
require 'config.php';


?>
 



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="fw-bold">📝 To Do List</h2>
        <a href="AddList.php" class="btn btn-success">+ Create Task</a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">

            <div class="table-responsive">
                <table class="table table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Created Date</th>
                            <th scope="col">Actions</th>
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
                            <td class="text-truncate" style="max-width: 250px;"><?php echo htmlspecialchars($value['Description']); ?></td>
                            <td><?php echo date('Y-m-d', strtotime($value['CreatedAt'])); ?></td>
                            <td>
                                <a href="EditList.php?id=<?php echo $value['List_id']; ?>" class="btn btn-sm btn-warning me-1">Edit</a>
                                <a href="Delete.php?id=<?php echo $value['List_id']; ?>" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</a>
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

</body>
</html>