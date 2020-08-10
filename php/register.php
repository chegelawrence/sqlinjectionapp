<?php

require("db.php"); 
session_start();

$conn = dbConnect();

//error_reporting(0);
if($_SERVER['REQUEST_METHOD'] === 'POST') {
    //process registration
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    
    if($username === "" || $password === "" || $confirmpassword === ""){
        $validation_error = true;
    }else{
        $validation_error = false;
        if($password !== $confirmpassword){
            $password_error = true;
        }else{
            $password_error = false;

            $connection = dbConnect();
            if($connection !== null){
                $username = ucfirst(trim($_POST['username']));

                //check if user already exists

                $query = "SELECT id FROM users WHERE username='".$username."'";
                $result = mysqli_query($connection, $query);

                if(mysqli_num_rows($result) > 0){
                    $username_error = true;
                }else{
                    $password_hash = md5($password);
                
                    $query = "INSERT INTO users(username, password_hash) VALUES('$username','$password_hash')";
    
                    if(mysqli_query($connection, $query)){
    
                        // login user and redirect to dashboard
                        
                        $_SESSION['user'] = $username;
                        $_SESSION['token'] = md5(time());
                        
                        
                        header('Location: /dashboard.php');
                    }else{
                        echo "Database error...".mysqli_error($connection);
                    }
                }

                mysqli_close($connection); //cleanup
               
            }else{
                error_log("Database error - No connection to the database");
            }

        }

    }
    

}
?>

<html>
<head>
<title>Inventory System | Admin registration</title>
</head>
<body>
    <div style="margin-right:auto;margin-left:auto">
        <form method="POST" action="<?=$_SERVER['PHP_SELF'];?>">
            <h3>Admin Registration</h3>
            <input type="text" name="username" id="username" placeholder="Username">
            <br><br>
            <?php
            if(isset($username_error) && $username_error === true){
                echo "<span style='color:red';>User already exists</span><br>";
            }
            ?>
            <input type="password" name="password" id="password" placeholder="Password">
            <br><br>
            <input type="password" name="confirmpassword" id="confirmpassword" placeholder="Confirm password">
            <br><br>
            <?php
            if(isset($password_error) && $password_error === true){
                echo "<span style='color:red';>Passwords do not match</span><br>";
            }
            if(isset($validation_error) && $validation_error === true){
                echo "<span style='color:red';>All fields are required</span><br>";
            }
            ?>
            <input type="submit" value="Register">
            <hr>
            <a href="/">Login</a>
        </form>
    </div>
</body>
</html>