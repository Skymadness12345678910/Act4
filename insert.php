<?php require_once 'core/db.Config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Insert</title>
</head>
<body>

<?php
$type = $_GET['type'] ?? '';

if (isset($_POST['save'])) {
    if ($type === 'author') {
        $pdo->prepare("INSERT INTO authors (name, email) VALUES (?, ?)")->execute([$_POST['name'], $_POST['email']]);
        header("Location: index.php"); exit;
    } elseif ($type === 'book') {
        $pdo->prepare("INSERT INTO books (title, author_id) VALUES (?, ?)")->execute([$_POST['title'], $_POST['author_id']]);
        header("Location: index.php"); exit;
    }
}
?>

<h1>Insert <?= ucfirst($type) ?></h1>

<?php if ($type === 'author'): ?>
<form method="post">
    Name: <input type="text" name="name" required><br>
    Email: <input type="text" name="email" required><br>
    <button type="submit" name="save">Save</button>
    <a href="index.php">Cancel</a>
</form>

<?php elseif ($type === 'book'): ?>
<form method="post">
    Title: <input type="text" name="title" required><br>
    Author:
    <select name="author_id">
        <?php
        $authors = $pdo->query("SELECT * FROM authors ORDER BY name")->fetchAll();
        foreach ($authors as $a): ?>
        <option value="<?= $a['author_id'] ?>"><?= htmlspecialchars($a['name']) ?></option>
        <?php endforeach; ?>
    </select><br>
    <button type="submit" name="save">Save</button>
    <a href="index.php">Cancel</a>
</form>

<?php else: ?>
<p>Invalid type.</p>
<a href="index.php">Back</a>
<?php endif; ?>

</body>
</html>
