<?php
$servername = "db";
$username   = "root";
$password   = "root";
$dbname     = "php_mysql_docker_db";

$conn = mysqli_connect($servername, $username, $password, $dbname);
$users = [];
if ($conn) {
    $result = mysqli_query($conn, "SELECT * FROM users");
    if (
        $result && mysqli_num_rows($result) >
        0
    ) {
        while ($row = mysqli_fetch_assoc($result)) {
            $users[] = $row;
        }
    }
    mysqli_close($conn);
} ?>
<!DOCTYPE html>
<html>

<head>
    <title>PHP MySQL Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
</head>

<body>
    <h2>Registration Form</h2>
    <?php if (isset($_GET['success'])): ?>
        <div class="message">New record created successfully!</div>
    <?php elseif (isset($_GET['error'])): ?>
        <div class="message error">
            Error:
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>
    <form action="process.php" method="POST">
        <label for="name">Name:</label><br />
        <input type="text" id="name" name="name" required /><br />
        <label for="email">Email:</label><br />
        <input type="email" id="email" name="email" required /><br />
        <input type="submit" value="Submit" />
    </form>
    <?php if (!empty($users)): ?>
        <h3>Registered Users</h3>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
            </tr>
            <?php foreach ($users as $row): ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['id']); ?></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No users found.</p>
    <?php endif; ?>
</body>

</html>