<?php
session_start();
require 'db.php';

$stmt = $pdo->prepare("
    SELECT title, content, created_at 
    FROM posts 
    ORDER BY created_at DESC
");
$stmt->execute();
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Secure Blog</title>
</head>
<body>

<h2>Secure Blog</h2>

<?php foreach ($posts as $post): ?>
    <h3><?= htmlspecialchars($post['title']) ?></h3>
    <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
    <small><?= $post['created_at'] ?></small>
    <hr>
<?php endforeach; ?>

</body>
</html>