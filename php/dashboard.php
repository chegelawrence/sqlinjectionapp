<?php

require "db.php";

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $name = ucfirst(trim($_POST['name']));
    $stock = $_POST['stock'];
    $price_per_unit = $_POST['price_per_unit'];

    $connection = dbConnect();
    if($connection !== null){
        $query = "INSERT INTO stock(product_name,quantity, price) VALUES('$name','$stock','$price_per_unit')";
        if(mysqli_query($connection,$query)){
            header("Location: /stock.php");
        }else{
            echo "Unexpected error occured - ".mysqli_error($connection);
        }
        mysqli_close($connection);
    }else{
        echo "Database error";
    }


}

?>

<html>
<head>
<title>Admin dashboard</title>
</head>
<body>
<div style="margin-right:auto;margin-left:auto">
        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
            <h3>Add inventory</h3>
            <input type="text" name="name" id="name" placeholder="Name">
            <br><br>
            <input type="number" name="stock" id="stock" placeholder="Quantity">
            <br><br>
            <input type="number" name="price_per_unit" id="price_per_unit" placeholder="Price per unit">
            <br><br>
            <input type="submit" value="Add">
        </form>
    </div>
<hr>
<a href="/logout.php">Logout</a>
    
</body>
</html>