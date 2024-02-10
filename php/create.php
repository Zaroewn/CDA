<?php
 $pdo = new PDO('mysql:host=localhost;dbname=cda', 'root', '');
 $statut = '*Veuillez renseigner tout les champs';
$statut1 = 'Nouvelle article crée :)';

    // Validation du formulaire...
    if(isset($_FILES['image']) && $_FILES['image']['error'] == 0 ) {
        // 1mo = 1 000 000 d'octets
        // Ou lui demande de vérifier si la taille de l'image fait bien moins de 3mo(méga octets)
        if($_FILES['image']['size'] <= 3000000) {
            $informationsImage = pathinfo($_FILES['image']['name']); // récupère dans un tableau toutes les infos de l'image grâce à la fonction pathinfo().
            $extensionImage = $informationsImage['extension']; // On récupère dans une variable la clé ['extension'] du tableau $informationsImage.
            $extensionsArray = array('png', 'jpg', 'gif', 'JPEG'); // On créer un tableau avec les extensions que l'on autorise.
            if(in_array($extensionImage, $extensionsArray)) {
                move_uploaded_file($_FILES['image']['tmp_name'], '../src/'. basename($_FILES['image']['name'])); 
            }
        } 
    }
    if (!empty($_POST['titre']) && !empty($_POST['corps']) && !empty($_FILES['image']['name']) && !empty($_POST['categorie'])) {

        $query = $pdo->prepare('INSERT INTO posts (titre, corps, extrait, fichier_image, id_categorie) VALUES (:titre, :corps, :extrait, :fichier_image, :id_categorie)');
        $query->bindValue('titre', $_POST['titre'], PDO::PARAM_STR);
        $query->bindValue('corps', $_POST['corps'], PDO::PARAM_STR);
        $query->bindValue('extrait', substr($_POST['corps'], 0, 300), PDO::PARAM_STR);
        $query->bindValue('fichier_image', $_FILES['image']['name'], PDO::PARAM_STR);
        $query->bindValue('id_categorie', $_POST['categorie'], PDO::PARAM_INT);
        $query->execute();
    } 
        
    

// Récupération des catégories
$query = $pdo -> query('SELECT id, nom FROM categories');
$categories = $query -> fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/cud.css">
    <script type="module" src="../js/create.js"> defer</script>
    <title>Création d'un nouveau post</title>
</head>
<body>
    <header>
        <h1>BookX</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="update.php">Modifier un post</a></li>
            <li><a href="delete.php">Supprimer un post</a></li>
        </ul>
    </nav>

    <section class="containeur">
        <h2>Créer un nouveau post</h2>

        <form action="create.php" method="post" enctype="multipart/form-data">
            <label for="titre">Titre du post :</label><br>
            <input type="text" name="titre" placeholder="Titre du post">
            <br><br>

            <label for="corps">Contenu du post :</label><br>
            <textarea name="corps" cols="30" rows="10" placeholder="Écrivez votre post ici"></textarea>
            <br><br>

            <label for="categorie">Catégorie du post :</label><br>
            <select name="categorie" id="categorie">
                <?php foreach ($categories as $categorie) : ?>
                    <option value="<?= $categorie['id']?>"><?=$categorie['nom']?></option>
                <?php endforeach ?>
            </select>
            <h4 id="addCategory">Ajouter une catégorie</h4>
            <br><br>

            <label for="image">Image du post :</label><br>
            <input type="file" name="image"/>
            <br><br>

            <input type="submit" value="Créer le post">
        </form>

        <?php if (empty($_POST['titre']) || empty($_POST['corps']) || empty($_FILES['image']['name']) || empty($_POST['categorie'])) : ?>
            <h3><?= $statut?></h3>
        <?php else : ?>
            <h3><?= $statut1?></h3>
        <?php endif ?>
    </section>

    <footer>
        <h3>
            Made with <span>&#x2661;</span> by BookX.fr
        </h3>
    </footer>
</body>
</html>