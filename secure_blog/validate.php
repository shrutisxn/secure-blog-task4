<?php
session_start();
require 'db.php';

if (empty($_POST['username']) || empty($_POST['password'])) {
    die("Invalid input");
}

$username = trim($_POST['username']);
$password = trim($_POST['password']);

$stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
$stmt->execute([$username]);
$user = $stmt->fetch();

if ($user && password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['role'] = $user['role'];
    header("Location: admin_dashboard.php");
} else {
    echo "Login failed";
}
?>