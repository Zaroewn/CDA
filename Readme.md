J'ai choisi de créer un projet de type blog, axé sur les livres. Vous aller voir le site comme si vous étiez l'administrateur de celui-ci. Vous pourrez donc, ajouter, modifier et supprimer des articles.
Le code implémente donc toutes les fonctionnalités CRUD, j'ai choisi la plupart du temps de faire ces fonctionnalités sous type de fonctions pour factoriser au maximum le code, et évité les répétitions.

Toutes les fonctions se trouvent dans le fichier functions.php :

- Create : Ce fait grâce à la fonction createPost(), qui implémente un code de type requête préparé SQL.
- Read: Ce fait grâce à la fonction getPosts(), et getPost(), elles implémentent code de type requête préparé SQL.
- Update: Ce fait grâce à la fonction updatePost(), qui implémente un code de type requête préparé SQL.
- Delete: Ce fait grâce à la fonction deletePost(), qui implémente un code de type requête préparé SQL.

Vous trouverez des fonctions supplémentaires comme getComments, ou addComment qui permettent de récupérer des commentaires liés au post choisit pour la première, et d'ajouter un commentaire pour la seconde.

Nous éxécuturons le projet localement grâce à deux programmes, visual studio code et Docker.

Comment éxécuter le projet localement :

  Étape 1:
  Étape 2:
  Étape 3:
  Étape 4:
  Étape 5:
  Étape 6:
  Étape 7:
  Étape 8:
  Étape 9:
  Étape 10:
