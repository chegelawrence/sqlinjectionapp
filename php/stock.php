<html>
<head>
<title>Stock</title>
<style>
      table,
      th,
      td {
        padding: 10px;
        border: 1px solid black;
        border-collapse: collapse;
      }
</style>
</head>
<body>
    <?php
    require "db.php";
    $connection = dbConnect();
    if($connection !== null){
        $query = "SELECT * FROM stock";
        $result = mysqli_query($connection, $query);

        if(mysqli_num_rows($result) > 0){
            echo "<table style='border:2px solid black'>";
            echo "<tr><th>Name</th><th>Quantity</th></th><th>Price/Unit</th><th>*</th></tr>";
            while($row = mysqli_fetch_assoc($result)){
                echo "<tr><td>".$row['product_name']."</td><td>".$row['quantity']."</td><td>".$row['price']."</td><td><a href='delete.php?id=".$row["id"]."'>Delete</a></td></tr>";
            }
            echo "</table>";
        }else{
            echo "No records found";
        }
        mysqli_close($connection);
    }else{
        echo "Database error ".mysqli_error($connection);
    }
    ?>
    <br>
    <a href="dashboard.php">Dashboard</a>
</body>
</html>