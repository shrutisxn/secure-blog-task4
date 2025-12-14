<?php
require 'db.php';
session_start();

// Check login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Check post id
if (!isset($_GET['id'])) {
    die("Invalid request!");
}

$post_id = intval($_GET['id']);

// Delete post
$stmt = $pdo->prepare("DELETE FROM posts WHERE id = ?");
$stmt->execute([$post_id]);

header("Location: index.php");
exit;
?>