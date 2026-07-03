<h2>Ask a New Question</h2>

<form action="index.php?action=add" method="POST">
    <div>
        <label for="questionText">Type your problem description here:</label><br>
        <textarea id="questionText" name="questionText" rows="6" cols="50" required></textarea>
    </div>
    
    <div>
        <label for="authorId">Select Your Profile Name:</label><br>
        <select id="authorId" name="authorId" required>
            <option value="">-- Choose Author --</option>
            <?php foreach ($authors as $author): ?>
                <option value="<?=$author['id']?>"><?=htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8')?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div>
        <label for="moduleId">Select Academic Module Related to Query:</label><br>
        <select id="moduleId" name="moduleId" required>
            <option value="">-- Choose Module --</option>
            <?php foreach ($modules as $module): ?>
                <option value="<?=$module['id']?>"><?=htmlspecialchars($module['moduleCode'] . ' - ' . $module['moduleName'], ENT_QUOTES, 'UTF-8')?></option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="margin-top: 15px;">
        <input type="submit" name="submit" value="Publish Question">
    </div>
</form>