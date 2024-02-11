<?php

function getPost (PDO $pdo, $id) {

    $query = $pdo -> prepare('SELECT p.id, p.titre, p.corps, p.extrait
        FROM posts p
        WHERE id = :id');
        
    $query -> bindValue(':id', $id, PDO::PARAM_STR);
    $query -> execute();
    return $query -> fetch(PDO::FETCH_ASSOC);
}