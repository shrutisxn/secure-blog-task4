<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    die("Access Denied");
}
?>

<h2>Admin Dashboard</h2>
<a href="create_post.php">Create Post</a>