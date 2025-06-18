<?php 


require 'config.php';

$pdostatement = $pdo->prepare("DELETE FROM todo WHERE List_id=".$_GET['id']);
$pdostatement->execute();
header("Location: index.php");


?> 