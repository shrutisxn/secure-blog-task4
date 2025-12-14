<?php
require 'db.php';

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $username = trim($_POST['username']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required!";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare(
            "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
        );

        try {
            $stmt->execute([$username, $email, $hashedPassword]);
            $message = "Registration successful!";
        } catch (PDOException $e) {
            $message = "Username or Email already exists!";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
</head>
<body>

<h2>User Registration</h2>

<form method="POST">
    <input type="text" name="username" placeholder="Username"><br><br>
    <input type="email" name="email" placeholder="Email"><br><br>
    <input type="password" name="password" placeholder="Password"><br><br>
    <button type="submit">Register</button>
</form>

<p><?php echo $message; ?></p>

</body>
</html>