<?php
    //Start session
    session_start();

    //Create constants for db username and password
    define('SITEURL','http://localhost/food-order/'); 
    define('LOCALHOST','localhost');//constants in capital always 
    define('DB_USERNAME','root');
    define('DB_PASSWORD','');
    define('DB_NAME','food-order');

    //$conn = mysqli_connect('localhost','username','password') or die(mysqli_error()) ;
    $conn = mysqli_connect('localhost','root','') or die(mysqli_error()) ;//connection

    //$db_select = mysqli_select_db($conn , 'DBNAME') or die (mysqli_error());
    $db_select = mysqli_select_db($conn , 'food-order') or die (mysqli_error());//selecting database 


?>