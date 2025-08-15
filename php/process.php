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

$name  = isset($_POST['name']) ? trim($_POST['name']) : '';
$email = isset($_POST['email']) ? trim($_POST['email']) : '';

// Server-side validation
$errors = [];
if (!preg_match('/^[A-Za-z\s]{2,50}$/', $name)) {
    $errors[] = 'Invalid name.';
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL) || strlen($email) > 100) {
    $errors[] = 'Invalid email.';
}

if ($errors) {
    mysqli_close($conn);
    header('Location: /' . urlencode(implode(" ", $errors)));
    exit();
}

$sql = "INSERT INTO users (name, email) VALUES ('" . mysqli_real_escape_string($conn, $name) . "', '" . mysqli_real_escape_string($conn, $email) . "')";
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
