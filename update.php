<?php require_once 'core/db.Config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Update</title>
</head>
<body>

<?php
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if (isset($_POST['save'])) {
    if ($type === 'author') {
        $pdo->prepare("UPDATE authors SET name=?, email=? WHERE author_id=?")->execute([$_POST['name'], $_POST['email'], $id]);
        header("Location: index.php"); exit;
    } elseif ($type === 'book') {
        $pdo->prepare("UPDATE books SET title=?, author_id=? WHERE book_id=?")->execute([$_POST['title'], $_POST['author_id'], $id]);
        header("Location: index.php"); exit;
    }
}

if ($type === 'author') {
    $row = $pdo->prepare("SELECT * FROM authors WHERE author_id=?")->execute([$id])->fetch();
    if (!$row) { die("Author not found."); ?>
<form method="post">
    Name: <input type="text" name="name" value="<?= htmlspecialchars($row['name']) ?>" required><br>
    Email: <input type="text" name="email" value="<?= htmlspecialchars($row['email']) ?>" required><br>
    <button type="submit" name="save">Update</button>
    <a href="index.php">Cancel</a>
</form>
<?php }
} elseif ($type === 'book') {
    $row = $pdo->prepare("SELECT * FROM books WHERE book_id=?")->execute([$id])->fetch();
    if (!$row) { die("Book not found."); ?>
<form method="post">
    Title: <input type="text" name="title" value="<?= htmlspecialchars($row['title']) ?>" required><br>
    Author:
    <select name="author_id">
        <?php
        $authors = $pdo->query("SELECT * FROM authors ORDER BY name")->fetchAll();
        foreach ($authors as $a): ?>
        <option value="<?= $a['author_id'] ?>" <?= $a['author_id']==$row['author_id']?'selected':'' ?>><?= htmlspecialchars($a['name']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit" name="save">Update</button>
    <a href="index.php">Cancel</a>
</form>
<?php }
} else { ?>
<p>Invalid type.</p>
<a href="index.php">Back</a>
<?php } ?>

</body>
</html>
