<?php require_once 'core/db.Config.php'; ?>

<?php
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if ($type === 'author') {
    $pdo->prepare("DELETE FROM authors WHERE author_id=?")->execute([$id]);
    header("Location: index.php"); exit;
} elseif ($type === 'book') {
    $pdo->prepare("DELETE FROM books WHERE book_id=?")->execute([$id]);
    header("Location: index.php"); exit;
} else {
    die("Invalid type.");
}
?>
