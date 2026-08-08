<h2>Manage Authors</h2>

<a href="addauthor.php">Add a new author</a>

<table border="1" cellpadding="5" cellspacing="0" style="margin-top: 15px; width: 100%;">
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($authors as $author): ?>
            <tr>
                <td><?= htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($author['email'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><a href="editauthor.php?id=<?= $author['id'] ?>">Edit</a></td>
                <td>
                    <form action="deleteauthor.php" method="POST" style="margin: 0;">
                        <input type="hidden" name="id" value="<?= $author['id'] ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>