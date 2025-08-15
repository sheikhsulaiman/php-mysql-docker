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
    <form action="process.php" method="POST" id="regForm" onsubmit="return validateForm()">
        <label for="name">Name:</label><br />
        <input type="text" id="name" name="name" required minlength="2" maxlength="50" pattern="[A-Za-z\s]+" /><br />
        <label for="email">Email:</label><br />
        <input type="email" id="email" name="email" required maxlength="100" /><br />
        <input type="submit" value="Submit" />
    </form>
    <script>
        function validateForm() {
            var name = document.getElementById('name').value.trim();
            var email = document.getElementById('email').value.trim();
            var namePattern = /^[A-Za-z\s]{2,50}$/;
            var emailPattern = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
            if (!namePattern.test(name)) {
                alert('Please enter a valid name (letters and spaces only, 2-50 characters).');
                return false;
            }
            if (!emailPattern.test(email)) {
                alert('Please enter a valid email address.');
                return false;
            }
            return true;
        }
    </script>
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