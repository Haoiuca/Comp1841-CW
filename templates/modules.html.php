<h2>Manage Modules</h2>

<a href="addmodule.php">Add a new module</a>

<table border="1" cellpadding="5" cellspacing="0" style="margin-top: 15px; width: 100%;">
    <thead>
        <tr>
            <th>Module Code</th>
            <th>Module Name</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($modules as $module): ?>
            <tr>
                <td><?= htmlspecialchars($module['moduleCode'], ENT_QUOTES, 'UTF-8') ?></td>
                <td><?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?></td>
                
                <td>
                    <a href="editmodule.php?id=<?= $module['moduleId'] ?>">Edit</a>
                </td>
                
                <td>
                    <form action="deletemodule.php" method="POST" style="margin: 0;">
                        <input type="hidden" name="id" value="<?= $module['moduleId'] ?>">
                        <input type="submit" value="Delete">
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>