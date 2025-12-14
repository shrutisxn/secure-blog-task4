<?php
require 'db.php';
require 'validate.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (!isset($_GET['id'])) {
    die("Invalid request!");
}

$post_id = intval($_GET['id']);

// Fetch existing post
$stmt = $pdo->prepare("SELECT * FROM posts WHERE id = ?");
$stmt->execute([$post_id]);
$post = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$post) {
    die("Post not found!");
}

$error = "";
$success = "";

// Update post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = clean_input($_POST['title']);
    $content = clean_input($_POST['content']);

    if (empty($title) || empty($content)) {
        $error = "All fields are required!";
    } else {
        $stmt = $pdo->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
        $stmt->execute([$title, $content, $post_id]);

        $success = "Post updated successfully!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Post</title>
</head>
<body>

<?php require 'header.php'; ?>

<h2>Edit Post</h2>

<?php if ($error) echo "<p style='color:red;'>$error</p>"; ?>
<?php if ($success) echo "<p style='color:green;'>$success</p>"; ?>

<form method="POST">
    <label>Title:</label><br>
    <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>"><br><br>

    <label>Content:</label><br>
    <textarea name="content"><?php echo htmlspecialchars($post['content']); ?></textarea><br><br>

    <button type="submit">Update</button>
</form>

</body>
</html>