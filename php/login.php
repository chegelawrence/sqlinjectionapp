<?php
//error_reporting(0);
require("db.php");

session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST') {
   $username = ucfirst(trim($_POST['username']));
   $password = $_POST['password'];
   $connection = dbConnect();
   if($connection !== null){
      $password_hash = md5($password);
      $query = "SELECT id FROM users WHERE username = '$username' AND password_hash = '$password_hash'";
      $result = mysqli_query($connection, $query);

      if(mysqli_num_rows($result) > 0){
          session_start();
          $_SESSION['token'] = md5(time() + 3600);
          $_SESSION['user'] = $username;
          header("Location: /dashboard.php");
      }else{
          echo "Wrong username or password";
      }
      mysqli_close($connection);
   }else{
       echo "Database error";
   }
}
?>

<html>
<head>
<title>Inventory System | Admin login</title>
</head>
<body>
    <div style="margin-right:auto;margin-left:auto">
        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
            <h3>Admin Login</h3>
            <input type="text" name="username" id="username" placeholder="Username">
            <br><br>
            <input type="password" name="password" id="password" placeholder="Password">
            <br><br>
            <input type="submit" value="Sign In">
            <hr>
            <a href="/register.php">Create account</a>
        </form>
    </div>
</body>
</html>