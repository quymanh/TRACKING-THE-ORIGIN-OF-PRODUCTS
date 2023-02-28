<?php 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Setting up the time zone
    date_default_timezone_set('Asia/Ho_Chi_Minh');

    $dbhost = "localhost";
    $dbuser = "root";
    $dbpass = "";

    $dbname = "supplychain";
    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

    if (!$conn) {
        echo "Kết nối thất bại!";
        exit();
    }

    try {
        $pdo = new PDO("mysql:host={$dbhost};dbname={$dbname}", $dbuser, $dbpass,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch( PDOException $ex ) {
        echo "Connection error :" . $ex->getMessage();
    }
?>