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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h2 class="mb-4 text-center">Registration Form</h2>
                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">New record created successfully!</div>
                <?php elseif (isset($_GET['error'])): ?>
                    <div class="alert alert-danger">
                        Error: <?php echo htmlspecialchars($_GET['error']); ?>
                    </div>
                <?php endif; ?>
                <form action="process.php" method="POST" id="regForm" onsubmit="return validateForm()" class="border rounded p-4 bg-white shadow-sm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" id="name" name="name" class="form-control" required minlength="2" maxlength="50" pattern="[A-Za-z\s]+" />
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" id="email" name="email" class="form-control" required maxlength="100" />
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <?php if (!empty($users)): ?>
                    <h3 class="mb-3">Registered Users</h3>
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped align-middle">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($users as $row): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($row['id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-center">No users found.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
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

</body>

</html>