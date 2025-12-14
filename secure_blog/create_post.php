<?php
session_start();
require 'db.php';

if ($_SESSION['role'] !== 'admin') {
    die("Access denied");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (empty($_POST['title']) || empty($_POST['content'])) {
        die("Invalid data");
    }

    $stmt = $pdo->prepare(
        "INSERT INTO posts (title, content) VALUES (?, ?)"
    );
    $stmt->execute([
        $_POST['title'],
        $_POST['content']
    ]);

    echo "Post created successfully";
}
?>

<form method="POST">
    <input type="text" name="title" required>
    <textarea name="content" required></textarea>
    <button type="submit">Save</button>
</form>