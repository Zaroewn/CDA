<?php declare(strict_types = 1);

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');

$query = $pdo -> query('SELECT * FROM posts', PDO::FETCH_ASSOC);

$posts = $query -> fetchAll();

var_dump($posts);

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/podcast.css">
    <title>Choix des post</title>
</head>

<body>
    <div class="grid-container">
        <div class="item1"></div>

        <div class="item2">

            <h1>SpaceCasts</h1>

            <?php

                echo "<div class=\"div\">",
                        "<p>" .$podcastSelection['nom']. "</p>",
                        "<span>" .$podcastSelection['created_at']. "</span>",
                        "<h2>" .$podcastSelection['titre']. "</h2>",
                        "<audio src=\"$podcastSelection[fichier_audio]\" controls></audio>",
                        "<p>" .$podcastSelection['corps']. "</p>",
                    "</div>"; 

                echo '<br><br>';
            ?>