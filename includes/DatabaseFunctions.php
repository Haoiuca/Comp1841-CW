<?php

function getQuestionsWithDetails($pdo) {
    // Using explicit INNER JOINs to pull relational entity data together
    $sql = 'SELECT `questions`.`id`, `questions`.`questionText`, `questions`.`questionDate`, `questions`.`image`, 
                   `authors`.`name` AS authorName, `authors`.`email` AS authorEmail,
                   `modules`.`moduleName`, `modules`.`moduleCode`
            FROM `questions`
            INNER JOIN `authors` ON `questions`.`authorId` = `authors`.`id`
            INNER JOIN `modules` ON `questions`.`moduleId` = `modules`.`id`
            ORDER BY `questions`.`questionDate` DESC';
            
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(); // Returns an array of associative arrays
}


function findQuestionById($pdo, $id) {
    $sql = 'SELECT * FROM `questions` WHERE `id` = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(); // Returns just one row array
}


function allAuthors($pdo) {
    $sql = 'SELECT * FROM `authors` ORDER BY `name` ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}

function allModules($pdo) {
    $sql = 'SELECT * FROM `modules` ORDER BY `moduleCode` ASC';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function saveQuestion($pdo, $questionText, $questionDate, $image, $authorId, $moduleId) {
    $sql = 'INSERT INTO `questions` (`questionText`, `questionDate`, `image`, `authorId`, `moduleId`) 
            VALUES (:questionText, :questionDate, :image, :authorId, :moduleId)';
            
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':questionText', $questionText);
    $stmt->bindValue(':questionDate', $questionDate);
    $stmt->bindValue(':image', $image);
    $stmt->bindValue(':authorId', $authorId);
    $stmt->bindValue(':moduleId', $moduleId);
    $stmt->execute();
}

function updateQuestion($pdo, $id, $questionText, $authorId, $moduleId) {
    $sql = 'UPDATE `questions` 
            SET `questionText` = :questionText, `authorId` = :authorId, `moduleId` = :moduleId 
            WHERE `id` = :id';
            
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':questionText', $questionText);
    $stmt->bindValue(':authorId', $authorId);
    $stmt->bindValue(':moduleId', $moduleId);
    $stmt->execute(); // Runs updates cleanly via POST execution hooks
}


function deleteQuestion($pdo, $id) {
    $sql = 'DELETE FROM `questions` WHERE `id` = :id';
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}