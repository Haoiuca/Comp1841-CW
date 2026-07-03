<h2>Edit Question Entry</h2>

<form action="index.php?action=edit" method="POST">
    <input type="hidden" name="questionId" value="<?=$question['id']?>">

    <div>
        <label for="questionText">Modify your query content:</label><br>
        <textarea id="questionText" name="questionText" rows="6" cols="50" required><?=htmlspecialchars($question['questionText'], ENT_QUOTES, 'UTF-8')?></textarea>
    </div>
    
    <div>
        <label for="authorId">Author:</label><br>
        <select id="authorId" name="authorId" required>
            <?php foreach ($authors as $author): ?>
                <option value="<?=$author['id']?>" <?=$author['id'] == $question['authorId'] ? 'selected' : ''?>>
                    <?=htmlspecialchars($author['name'], ENT_QUOTES, 'UTF-8')?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div>
        <label for="moduleId">Module Assignment:</label><br>
        <select id="moduleId" name="moduleId" required>
            <?php foreach ($modules as $module): ?>
                <option value="<?=$module['id']?>" <?=$module['id'] == $question['moduleId'] ? 'selected' : ''?>>
                    <?=htmlspecialchars($module['moduleCode'] . ' - ' . $module['moduleName'], ENT_QUOTES, 'UTF-8')?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    
    <div style="margin-top: 15px;">
        <input type="submit" name="submit" value="Save Changes">
    </div>
</form>