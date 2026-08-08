<h2>Edit Module</h2>

<form action="" method="POST">
    <input type="hidden" name="id" value="<?= htmlspecialchars($module['id'], ENT_QUOTES, 'UTF-8') ?>">
    
    <div>
        <label for="moduleCode">Module Code:</label><br>
        <input type="text" id="moduleCode" name="moduleCode" value="<?= htmlspecialchars($module['moduleCode'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>
    
    <div style="margin-top: 10px;">
        <label for="moduleName">Module Name:</label><br>
        <input type="text" id="moduleName" name="moduleName" value="<?= htmlspecialchars($module['moduleName'], ENT_QUOTES, 'UTF-8') ?>" required>
    </div>
    
    <div style="margin-top: 15px;">
        <input type="submit" value="Save Changes">
    </div>
</form>