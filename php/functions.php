<?php

// Fonction implémentant une requête SQL pour récupérer un post
function getPost($pdo)
{
    $query = $pdo -> prepare('SELECT p.id, p.titre, p.corps, p.fichier_image, p.created_at, c.nom AS categorie_nom 
    FROM posts p
    LEFT JOIN categories c ON p.id_categorie = c.id
    WHERE p.id = :id');

    $query -> bindValue(':id', $_GET['id'], PDO::PARAM_INT);
    $query -> execute();

    return $query -> fetch(PDO::FETCH_ASSOC);
}

// Fonction implémentant une requête SQL pour récupérer tout les posts
function getPosts($pdo)
{
    $query = $pdo -> query('SELECT p.id, p.titre, p.extrait, p.fichier_image, p.created_at, c.nom AS categorie_nom 
    FROM posts p
    LEFT JOIN categories c ON p.id_categorie = c.id
    ORDER BY created_at DESC');

    return $query -> fetchAll(PDO::FETCH_ASSOC);

}

// Fonction implémentant une requête SQL pour récupérer les commentaires liés à un post
function getComments($pdo)
{
    $query = $pdo -> prepare('SELECT commentaires.corps, commentaires.created_at, utilisateurs.nom, utilisateurs.photo 
    FROM commentaires
    LEFT JOIN utilisateurs
    ON commentaires.id_utilisateur = utilisateurs.id
    WHERE id_post = :id');

    $query -> bindValue('id', $_GET['id'], PDO::PARAM_INT);
    $query -> execute();

    return $query -> fetchAll(PDO::FETCH_ASSOC);
}

//Fonction implémentant une requête SQL pour créer un post
function createPost($pdo)
{
    $query = $pdo->prepare('INSERT INTO posts (titre, corps, extrait, fichier_image, id_categorie) VALUES (:titre, :corps, :extrait, :fichier_image, :id_categorie)');
    $query->bindValue('titre', $_POST['titre'], PDO::PARAM_STR);
    $query->bindValue('corps', $_POST['corps'], PDO::PARAM_STR);
    $query->bindValue('extrait', substr($_POST['corps'], 0, 300), PDO::PARAM_STR);
    $query->bindValue('fichier_image', $_FILES['image']['name'], PDO::PARAM_STR);
    $query->bindValue('id_categorie', $_POST['categorie'], PDO::PARAM_INT);
    return $query->execute();
}

// Fonction implémentant une requête SQL pour supprimer un post
function deletePost($pdo)
{
    $query = $pdo->prepare('DELETE FROM posts WHERE id = :id');
    $query->bindValue('id', $_POST['id'], PDO::PARAM_INT);

    return $query->execute();
}

// Fonction implémentant une requête SQL pour modifier un post
function updatePost($pdo)
{
    $query = $pdo->prepare('UPDATE posts SET titre = :titre, corps = :corps, extrait = :extrait WHERE id = :id');
    $query->bindValue('titre', $_POST['titre'], PDO::PARAM_STR);
    $query->bindValue('corps', $_POST['corps'], PDO::PARAM_STR);
    $query->bindValue('extrait', substr($_POST['corps'], 0, 300), PDO::PARAM_STR);
    $query->bindValue('id', $_POST['id'], PDO::PARAM_INT);

    return $query->execute();
}

// Fonction implémentant une requête SQL pour ajouter une catégorie
function addCategorie($pdo)
{
    $query = $pdo->prepare('INSERT INTO categories (nom) VALUES (:nom)');
    $query->bindValue('nom', $_POST['nom'], PDO::PARAM_STR);
    return $query->execute();
}
