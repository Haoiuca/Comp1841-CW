<?php
function query($pdo, $sql, $parameters = []) {
    $query = $pdo->prepare($sql);
    $query->execute($parameters);
    return $query;
}


## SPECIFIC DATABASE FUNCTIONS ##

function getQuestionsWithDetails($pdo) {
    $sql = 'SELECT `questions`.`id`, `questions`.`authorId`, `questions`.`questionText`, `questions`.`questionDate`, `questions`.`image`, 
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


function getAuthor($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM author WHERE id = :id', $parameters);
    return $query->fetch();
}

function getAuthorByEmail($pdo, $email) {
    $parameters = [':email' => $email];
    $query = query($pdo, 'SELECT * FROM author WHERE email = :email', $parameters);
    return $query->fetch();
}

function insertAuthor($pdo, $name, $email, $password) {
    $query = 'INSERT INTO author (name, email, password) VALUES (:name, :email, :password)';
    $parameters = [
        ':name' => $name, 
        ':email' => $email,
        // Hash the password securely!
        ':password' => password_hash($password, PASSWORD_DEFAULT) 
    ];
    query($pdo, $query, $parameters);
}

function updateAuthor($pdo, $id, $name, $email) {
    $query = 'UPDATE author SET name = :name, email = :email WHERE id = :id';
    $parameters = [':name' => $name, ':email' => $email, ':id' => $id];
    query($pdo, $query, $parameters);
}

function deleteAuthor($pdo, $id) {
    // Note: Due to Foreign Keys, deleting an author will delete their questions (if ON DELETE CASCADE)
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM author WHERE id = :id', $parameters);
}


function allModules($pdo) {
    $sql = 'SELECT * FROM `module` ORDER BY `moduleCode` ASC';
    
    $query = query($pdo, $sql);
    return $query->fetchAll();
}


function getModule($pdo, $id) {
    $parameters = [':id' => $id];
    $query = query($pdo, 'SELECT * FROM module WHERE moduleId = :id', $parameters);
    return $query->fetch();
}

function insertModule($pdo, $moduleName, $moduleCode) {
    $query = 'INSERT INTO module (moduleName, moduleCode) VALUES (:moduleName, :moduleCode)';
    $parameters = [':moduleName' => $moduleName, ':moduleCode' => $moduleCode];
    query($pdo, $query, $parameters);
}

function updateModule($pdo, $id, $moduleName, $moduleCode) {
    $query = 'UPDATE module SET moduleName = :moduleName, moduleCode = :moduleCode WHERE moduleId = :id';
    $parameters = [':moduleName' => $moduleName, ':moduleCode' => $moduleCode, ':id' => $id];
    query($pdo, $query, $parameters);
}

function deleteModule($pdo, $id) {
    // Note: Due to Foreign Keys, deleting a module will delete its questions (if ON DELETE CASCADE)
    $parameters = [':id' => $id];
    query($pdo, 'DELETE FROM module WHERE moduleId = :id', $parameters);
}


function insertQuestion($pdo, $questionText, $questionDate, $image, $authorId, $moduleId) {
    $query = 'INSERT INTO questions (questionText, questionDate, image, authorId, moduleId) 
              VALUES (:questionText, :questionDate, :image, :authorId, :moduleId)';
              
    $parameters = [
        ':questionText' => $questionText,
        ':questionDate' => $questionDate,
        ':image' => $image, 
        ':authorId' => $authorId,
        ':moduleId' => $moduleId
    ];
    
    query($pdo, $query, $parameters);
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