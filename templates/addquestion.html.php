<h2>Ask a New Question</h2>

<form action="" method="POST" enctype="multipart/form-data">
    
    <div>
        <label for="questionText">Type your problem description here:</label><br>
        <textarea id="questionText" name="questionText" rows="6" cols="50" required></textarea>
    </div>
    
    <div style="margin-top: 15px;">
        <label for="image">Attach a Screenshot (Optional):</label><br>
        <input type="file" id="image" name="image" accept="image/png, image/jpeg, image/gif">
    </div>

    <div style="margin-top: 15px;">
        <label for="moduleId">Select Academic Module Related to Query:</label><br>
        <select id="moduleId" name="moduleId" required>
            <option value="">-- Choose Module --</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?=$module['moduleId']?>">
                    <?=htmlspecialchars($module['moduleCode'] . ' - ' . $module['moduleName'], ENT_QUOTES, 'UTF-8')?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="margin-top: 20px;">
        <input type="submit" value="Publish Question">
    </div>
</form>