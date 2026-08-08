<h2>Edit Author</h2>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($author['id'], ENT_QUOTES, 'UTF-8') ?>">
    
    <div>
        <label for="name">Author Name:</label><br>
        <input type="text" id="name" name="name" value="<?= htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>
    
    <div style="margin-top: 10px;">
        <label for="email">Email Address:</label><br>
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($author['email'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>
    
    <div style="margin-top: 15px;">
        <input type="submit" value="Save Changes">
    </div>
</form>