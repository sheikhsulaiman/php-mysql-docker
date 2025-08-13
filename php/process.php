<?php
$servername = "db"; // important! service name from docker-compose
$username   = "root";
$password   = "root";
$dbname     = "php_mysql_docker_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$name  = $_POST['name'];
$email = $_POST['email'];

$sql = "INSERT INTO users (name, email) VALUES ('$name', '$email')";
if (mysqli_query($conn, $sql)) {
    mysqli_close($conn);
    header('Location: /');
    exit();
} else {
    $error = mysqli_error($conn);
    mysqli_close($conn);
    header('Location: /' . urlencode($error));
    exit();
}
