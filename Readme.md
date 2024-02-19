# Projet CDA

J'ai choisi de créer un projet de type blog, axé sur les livres. Vous aller voir le site comme si vous étiez l'administrateur de celui-ci. Vous pourrez donc, ajouter, modifier et supprimer des articles.
Le code implémente donc toutes les fonctionnalités CRUD, j'ai choisi la plupart du temps de faire ces fonctionnalités sous type de fonctions pour factoriser au maximum le code, et évité les répétitions.

Toutes les fonctions se trouvent dans le fichier functions.php :

- Create : Ce fait grâce à la fonction createPost(), qui implémente un code de type requête préparé SQL.
- Read: Ce fait grâce à la fonction getPosts(), et getPost(), elles implémentent code de type requête préparé SQL.
- Update: Ce fait grâce à la fonction updatePost(), qui implémente un code de type requête préparé SQL.
- Delete: Ce fait grâce à la fonction deletePost(), qui implémente un code de type requête préparé SQL.

Vous trouverez des fonctions supplémentaires comme getComments, ou addComment qui permettent de récupérer des commentaires liés au post choisit pour la première, et d'ajouter un commentaire pour la seconde.

Nous éxécuturons le projet localement grâce à Docker.

## Comment éxécuter le projet localement

  1. Télécharger Docker via [ce lien](https://www.docker.com/get-started/)
  2. Télécharger le dossier du projet CDA depuis GitHub via [ce lien](https://github.com/Zaroewn/CDA.git)
  3. Lancer Docker, une fois lancer, ouvrer l'invit de commande windows
  4. Changer le chemin par défault de l'invit par celui ou vous avez mis le projet CDA télécharger depuis GitHub. Par exemple si vous avez mis le projet dans le dossier documents faites un `cd Documents\CDA` dans l'invit de commande.
  5. Une fois dans le bon dossier, faites un `docker-compose up -d` dans l'invit de commande.
  6. Quand tout est fini dans l'invit de commande rendez-vous sur l'adresse http://localhost:8082/, rentrer "root" dans username, et laisser le mot de passe vide, puis connecter vous à phpMyAdmin.
  7. copier ce code, et coller le dans l'onglet SQL de phpMyAdmin.
 8. Une fois toute ces étapes passer, vous devriez avoir accès au projet via l'adresse -> http://localhost:8084/

