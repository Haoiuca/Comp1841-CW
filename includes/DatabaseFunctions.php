<?php

## REUSABLE QUERY FUNCTION ##
// This replaces the need to manually prepare and execute every time.
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}


## SPECIFIC DATABASE FUNCTIONS ##

function getQuestionsWithDetails($pdo) {
    $sql = 'SELECT `questions`.`id`, `questions`.`questionText`, `questions`.`questionDate`, `questions`.`image`, 
                   `author`.`name` AS authorName, `author`.`email` AS authorEmail,
                   `module`.`moduleName`, `module`.`moduleCode`
            FROM `questions`
            INNER JOIN `author` ON `questions`.`authorId` = `author`.`id`
            INNER JOIN `module` ON `questions`.`moduleId` = `module`.`moduleId`
            ORDER BY `questions`.`questionDate` DESC';
            
    $query = query($pdo, $sql);
    return $query->fetchAll();
}


function findQuestionById($pdo, $id) {
    $sql = 'SELECT * FROM `questions` WHERE `id` = :id';
    $parameters = ['id' => $id];
    
    $query = query($pdo, $sql, $parameters);
    return $query->fetch();
}


function allAuthors($pdo) {
    $sql = 'SELECT * FROM `author` ORDER BY `name` ASC';
    
    $query = query($pdo, $sql);
    return $query->fetchAll();
}


function allModules($pdo) {
    $sql = 'SELECT * FROM `module` ORDER BY `moduleCode` ASC';
    
    $query = query($pdo, $sql);
    return $query->fetchAll();
}


function saveQuestion($pdo, $questionText, $questionDate, $image, $authorId, $moduleId) {
    $sql = 'INSERT INTO `questions` (`questionText`, `questionDate`, `image`, `authorId`, `moduleId`) 
            VALUES (:questionText, :questionDate, :image, :authorId, :moduleId)';
            
    $parameters = [
        'questionText' => $questionText,
        'questionDate' => $questionDate,
        'image' => $image,
        'authorId' => $authorId,
        'moduleId' => $moduleId
    ];
    
    query($pdo, $sql, $parameters);
}


function updateQuestion($pdo, $id, $questionText, $authorId, $moduleId) {
    $sql = 'UPDATE `questions` 
            SET `questionText` = :questionText, `authorId` = :authorId, `moduleId` = :moduleId 
            WHERE `id` = :id';
            
    $parameters = [
        'id' => $id,
        'questionText' => $questionText,
        'authorId' => $authorId,
        'moduleId' => $moduleId
    ];
    
    query($pdo, $sql, $parameters);
}


function deleteQuestion($pdo, $id) {
    $sql = 'DELETE FROM `questions` WHERE `id` = :id';
    $parameters = ['id' => $id];
    
    query($pdo, $sql, $parameters);
}