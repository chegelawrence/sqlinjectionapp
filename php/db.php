<?php
//include this file wherever you need a database connection

function dbConnect(){

    $connection = mysqli_connect("172.20.0.4", "app","userpassword","app");

    if(!$connection){

       echo("Database connection failed: ".mysqli_connect_error());

        return null;
    }

    return $connection;
   
}

//done