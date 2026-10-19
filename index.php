<?php require_once 'core/db.Config.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title>Publish Books</title>
</head>
<body>

<h1>Publish Books</h1>

<h2>Authors (Parent)</h2>
<p><a href="insert.php?type=author">Add Author</a></p>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Name</th><th>Email</th><th>Action</th></tr>
<?php
$authors = $pdo->query("SELECT * FROM authors ORDER BY author_id DESC")->fetchAll();
foreach ($authors as $a): ?>
<tr>
    <td><?= $a['author_id'] ?></td>
    <td><?= htmlspecialchars($a['name']) ?></td>
    <td><?= htmlspecialchars($a['email']) ?></td>
    <td>
        <a href="update.php?type=author&id=<?= $a['author_id'] ?>">Update</a> |
        <a href="delete.php?type=author&id=<?= $a['author_id'] ?>" onclick="return confirm('Delete author?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

<h2>Books (Child)</h2>
<p><a href="insert.php?type=book">Add Book</a></p>
<table border="1" cellpadding="5">
<tr><th>ID</th><th>Title</th><th>Author</th><th>Action</th></tr>
<?php
$books = $pdo->query("SELECT b.*, a.name AS author_name FROM books b JOIN authors a ON b.author_id=a.author_id ORDER BY b.book_id DESC")->fetchAll();
foreach ($books as $b): ?>
<tr>
    <td><?= $b['book_id'] ?></td>
    <td><?= htmlspecialchars($b['title']) ?></td>
    <td><?= htmlspecialchars($b['author_name']) ?></td>
    <td>
        <a href="update.php?type=book&id=<?= $b['book_id'] ?>">Update</a> |
        <a href="delete.php?type=book&id=<?= $b['book_id'] ?>" onclick="return confirm('Delete book?')">Delete</a>
    </td>
</tr>
<?php endforeach; ?>

</body>
</html>
