<?php

// Fonction implémentant une requête SQL pour récupérer un post
function getPost ($pdo, $id) {
    $query = $pdo -> prepare('SELECT p.id, p.titre, p.corps, p.fichier_image, p.created_at, c.nom AS categorie_nom 
    FROM posts p
    LEFT JOIN categories c ON p.id_categorie = c.id
    WHERE p.id = :id');
    
    $query -> bindValue(':id', $id, PDO::PARAM_INT);
    $query -> execute();

    return $query -> fetch(PDO::FETCH_ASSOC);
}

// Fonction implémentant une requête SQL pour récupérer tout les posts
function getPosts($pdo, ) {
    $query = $pdo -> query('SELECT p.id, p.titre, p.extrait, p.fichier_image, p.created_at, c.nom AS categorie_nom 
    FROM posts p
    LEFT JOIN categories c ON p.id_categorie = c.id
    ORDER BY created_at DESC');
    
    return $query -> fetchAll(PDO::FETCH_ASSOC);

}

// Fonction implémentant une requête SQL pour récupérer les commentaires liés à un post
function getComments($pdo, $id) {
    $query = $pdo -> prepare('SELECT commentaires.corps, commentaires.created_at, utilisateurs.nom, utilisateurs.photo 
    FROM commentaires
    LEFT JOIN utilisateurs
    ON commentaires.id_utilisateur = utilisateurs.id
    WHERE id_post = :id');

    $query -> bindValue('id', $id, PDO::PARAM_INT);
    $query -> execute();

    return $query -> fetchAll(PDO::FETCH_ASSOC);
}

//Fonction implémentant une requête SQL pour créer un post
function createPost($pdo, $titre, $corps, $image, $categorie) {
    $query = $pdo->prepare('INSERT INTO posts (titre, corps, extrait, fichier_image, id_categorie) VALUES (:titre, :corps, :extrait, :fichier_image, :id_categorie)');
    $query->bindValue('titre', $titre, PDO::PARAM_STR);
    $query->bindValue('corps', $corps, PDO::PARAM_STR);
    $query->bindValue('extrait', substr($corps, 0, 300), PDO::PARAM_STR);
    $query->bindValue('fichier_image', $image, PDO::PARAM_STR);
    $query->bindValue('id_categorie', $categorie, PDO::PARAM_INT);
    return $query->execute();
}

// Fonction implémentant une requête SQL pour supprimer un post
function deletePost($pdo, $id) {
    $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $query->bindValue('id', $id, PDO::PARAM_INT);

    return $query->execute();
}

// Fonction implémentant une requête SQL pour modifier un post
function updatePost($pdo, $titre, $corps, $id) {
    $query = $pdo->prepare('UPDATE posts SET titre = :titre, corps = :corps, extrait = :extrait WHERE id = :id');
    $query->bindValue('titre', $titre, PDO::PARAM_STR);
    $query->bindValue('corps', $corps, PDO::PARAM_STR);
    $query->bindValue('extrait', substr($corps, 0, 300), PDO::PARAM_STR);
    $query->bindValue('id', $id, PDO::PARAM_INT);
    
    return $query->execute();
}

// Fonction implémentant une requête SQL pour ajouter une catégorie
function addCategorie($pdo, $nom) {
    $query = $pdo->prepare('INSERT INTO categories (nom) VALUES (:nom)');
    $query->bindValue('nom', $nom, PDO::PARAM_STR);
    return $query->execute();
}