<h2>Available Student Questions</h2>

<?php foreach ($questions as $question): ?>
    <blockquote class="question-box">
        <p>
            <strong>Question:</strong><br>
            <?=htmlspecialchars($question['questionText'], ENT_QUOTES, 'UTF-8')?>
        </p>
        
        <?php if (!empty($question['image'])): ?>
            <p><img src="uploads/<?=htmlspecialchars($question['image'], ENT_QUOTES, 'UTF-8')?>" alt="Question Screenshot" style="max-width:300px; display:block; margin:10px 0;"></p>
        <?php endif; ?>
        
        <div class="meta-data">
            <span class="tag">Module: <?=htmlspecialchars($question['moduleCode'] . ' - ' . $question['moduleName'], ENT_QUOTES, 'UTF-8')?></span> | 
            <span class="author">Asked by: <a href="mailto:<?=htmlspecialchars($question['authorEmail'], ENT_QUOTES, 'UTF-8')?>"><?=htmlspecialchars($question['authorName'], ENT_QUOTES, 'UTF-8')?></a></span> | 
            <span class="date">On: <?=date('d-m-Y', strtotime($question['questionDate']))?></span>
        </div>
        
        <div class="actions-panel" style="margin-top: 10px;">
            <a href="index.php?action=edit&id=<?=$question['id']?>" class="btn-edit">Edit</a>
            
            <form action="index.php?action=delete" method="POST" style="display:inline; margin-left: 10px;">
                <input type="hidden" name="id" value="<?=$question['id']?>">
                <input type="submit" value="Delete" class="btn-delete" onclick="return confirm('Are you sure you want to delete this question?');">
            </form>
        </div>
    </blockquote>
    <hr>
<?php endforeach; ?>