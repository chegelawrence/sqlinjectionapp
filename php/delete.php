<?php
require "db.php";
if(!isset($_GET['id'])){
    echo "Specify the id parameter";
    exit(1);
}



$product_id = $_GET['id'];
$connection = dbConnect();

if($connection !== null){
    $query = "DELETE FROM stock WHERE id = '".$product_id."'";
    if(mysqli_query($connection, $query)){
        mysqli_close($connection);
        echo "Record deleted successfully";
        echo "<br><a href='stock.php'>Go back</a>";
    }
}else{
    echo "Database error";
    exit(1);
}

//done