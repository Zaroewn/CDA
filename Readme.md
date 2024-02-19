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

  1. Télécharger Docker-> https://www.docker.com/get-started/.
  2. Télécharger le dossier CDA depuis GitHub https://github.com/Zaroewn/CDA.git, dezipper-le et copier-le dans le dossier Documents. ![image](https://github.com/Zaroewn/CDA/assets/147649399/bced325b-12d0-4528-b04a-05e52ac31e5a)

  3. Lancer Docker, aller dans les paramètres (petite roue crantée en haut à droite), cocher la ligne, appliquer et relancer Docker. ![image](https://github.com/Zaroewn/CDA/assets/147649399/682b1d2d-6930-47c0-afd1-f9d503b53a3a)


  4. Lancer l'invit de commande windows, changer le chemin par défault, par celui ou vous avez mis le projet CDA (normalement dans le dossier Documents). Par exemple si vous avez mis le projet dans le dossier documents faites un `cd Documents\CDA` dans l'invit de commande vous devez avoir un chemin se terminant par CDA comme ici ![image](https://github.com/Zaroewn/CDA/assets/147649399/f004181f-ae0d-4377-82b6-fe27d61ea16a). Si vous avez mis le dossier CDA autre par que dans Documents, faites juste un `cd` et changer le chemin Documents\CDA par le bon.

  5. Une fois dans le bon dossier, faites un `docker-compose up -d` dans l'invit de commande.
  6. Quand tout est fini dans l'invit de commande rendez-vous sur l'adresse http://localhost:8082/, rentrer "root" dans username, laisser le mot de passe vide, puis connecter vous à phpMyAdmin.
  7. copier ce code, et coller le dans l'onglet SQL de phpMyAdmin puis appuyer sur go ou éxécuter. ![image](https://github.com/Zaroewn/CDA/assets/147649399/e7f098ff-8c8a-4f71-82a4-4264a7e7212e)

  ```
-- Utilisation de la base de données
USE cda;

-- Création de la table "categories"
CREATE TABLE IF NOT EXISTS categories (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nom          VARCHAR(100) NOT NULL,
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `categories` (`id`, `nom`, `created_at`, `updated_at`) VALUES
(1, 'Littérature', '2024-02-08 15:49:33', '2024-02-08 15:50:17'),
(2, 'Policiers', '2024-02-08 15:49:33', '2024-02-08 15:49:33'),
(3, 'Science-fiction', '2024-02-08 15:50:07', '2024-02-08 15:50:07'),
(4, 'Manga', '2024-02-08 15:50:07', '2024-02-08 15:50:07'),
(5, 'Roman', '2024-02-11 17:40:46', '2024-02-11 17:40:46');

-- Création de la table "utilisateurs"
CREATE TABLE IF NOT EXISTS utilisateurs (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  nom             VARCHAR(100) NOT NULL,
  photo           VARCHAR(150) NOT NULL,
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO `utilisateurs` (`id`, `nom`, `photo`, `created_at`, `updated_at`) VALUES
(1, 'Maxime', 'profil.jpg', '2024-02-08 15:51:57', '2024-02-11 16:48:59'),
(2, 'Georges', 'profil.jpg', '2024-02-08 15:51:57', '2024-02-11 17:15:31'),
(3, 'Julie', 'profil.jpg', '2024-02-08 15:52:26', '2024-02-11 17:15:31'),
(4, 'April', 'profil.jpg', '2024-02-08 15:52:26', '2024-02-11 17:15:31');
(5, 'John', 'profil.jpg', '2024-02-13 21:07:52', '2024-02-14 20:52:47');
(6, 'Matthew', 'profil.jpg', '2024-02-13 21:08:38', '2024-02-14 20:52:47');
(7, 'Iris', 'profil.jpg', '2024-02-13 21:15:01', '2024-02-14 20:52:47');

-- Création de la table "Podcasts"
CREATE TABLE IF NOT EXISTS posts (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  titre         VARCHAR(100) NOT NULL,
  corps         TEXT NOT NULL,
  extrait       VARCHAR(300) NOT NULL,
  fichier_image VARCHAR(150),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  id_categorie BIGINT UNSIGNED,
  FOREIGN KEY (id_categorie) REFERENCES categories (id) ON DELETE SET NULL
);

INSERT INTO `posts` (`id`, `titre`, `corps`, `extrait`, `fichier_image`, `created_at`, `updated_at`, `id_categorie`) VALUES
(1, 'One Piece', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;\r\n', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut', 'onepiece.jpg', '2024-02-08 15:58:02', '2024-02-10 11:30:12', 4),
(2, 'Naruto', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;\r\n\r\n\r\nPellentesque mollis, diam ut fringilla gravida, mauris ex luctus odio, in tempus sapien quam tempus arcu. Integer feugiat dui id sodales tempus. In et fringilla tellus, vitae scelerisque ligula. Donec pretium non tellus at aliquet. Curabitur pharetra ex dolor, ac porta lorem dignissim eu. Suspendisse volutpat, libero et lacinia consequat, magna mauris rhoncus neque, euismod sollicitudin neque ante a tortor. Donec ullamcorper, sapien in porttitor euismod, leo nunc ultrices erat, rutrum bibendum tellus tortor sit amet nisi. Suspendisse vitae ullamcorper erat. Phasellus vulputate quis elit sit amet rhoncus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut', 'naruto.jpg', '2024-02-08 16:43:55', '2024-02-10 11:25:49', 4),
(3, 'Bleach', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fri', 'bleach.jpg', '2024-02-08 16:59:19', '2024-02-10 11:30:12', 4),
(4, 'L''attaque des titans', 'Aliquam dapibus, orci ac sollicitudin maximus, risus metus sagittis urna, et placerat elit sapien nec lorem. Curabitur risus eros, scelerisque id nibh non, eleifend sagittis massa. Sed euismod vitae mauris sed consectetur. Curabitur non consectetur diam. Donec pellentesque vulputate libero sed fringilla. Maecenas condimentum blandit tellus scelerisque fermentum. Mauris aliquet lectus non quam mattis, volutpat molestie elit luctus. Phasellus tincidunt ullamcorper mi, id vehicula est volutpat at. Aenean mauris tortor, lacinia et suscipit a, posuere eu metus.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', 'Aliquam dapibus, orci ac sollicitudin maximus, risus metus sagittis urna, et placerat elit sapien nec lorem. Curabitur risus eros, scelerisque id nibh non, eleifend sagittis massa. Sed euismod vitae mauris sed consectetur. Curabitur non consectetur diam. Donec pellentesque vulputate libero sed fring', 'attaque-des-titans.jpg', '2024-02-08 17:24:24', '2024-02-10 11:30:12', 4),
(5, 'One Punch Man', 'Pellentesque mollis, diam ut fringilla gravida, mauris ex luctus odio, in tempus sapien quam tempus arcu. Integer feugiat dui id sodales tempus. In et fringilla tellus, vitae scelerisque ligula. Donec pretium non tellus at aliquet. Curabitur pharetra ex dolor, ac porta lorem dignissim eu. Suspendisse volutpat, libero et lacinia consequat, magna mauris rhoncus neque, euismod sollicitudin neque ante a tortor. Donec ullamcorper, sapien in porttitor euismod, leo nunc ultrices erat, rutrum bibendum tellus tortor sit amet nisi. Suspendisse vitae ullamcorper erat. Phasellus vulputate quis elit sit amet rhoncus.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', 'Pellentesque mollis, diam ut fringilla gravida, mauris ex luctus odio, in tempus sapien quam tempus arcu. Integer feugiat dui id sodales tempus. In et fringilla tellus, vitae scelerisque ligula. Donec pretium non tellus at aliquet. Curabitur pharetra ex dolor, ac porta lorem dignissim eu. Suspendiss', 'one_punch_man.jpg', '2024-02-10 09:48:07', '2024-02-10 11:30:12', 4),
(6, 'Demon Slayer', 'Nulla eros augue, mattis ac sem ac, sagittis placerat urna. Fusce ipsum dolor, efficitur et laoreet eget, vulputate ut velit. Nullam eu dolor quis mauris maximus iaculis ut vel nunc. Proin imperdiet hendrerit sapien, id semper nunc dictum nec. Fusce cursus at orci eu vehicula. Donec blandit accumsan augue at commodo. Mauris at leo faucibus, eleifend justo vel, rutrum massa. Praesent a arcu magna. Suspendisse ultricies sollicitudin neque et pulvinar. Nulla ac diam volutpat magna condimentum ultrices ut eget nunc. Praesent lobortis quam sed dui cursus, in semper ligula iaculis.\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fringilla blandit dictum. Donec eleifend, leo eget consequat gravida, lorem tellus molestie ipsum, ac dapibus lacus risus quis nisi. Fusce faucibus non libero id blandit. Quisque quis dolor nisl. Aenean lobortis elit vel massa dictum, ut placerat lorem suscipit. Quisque at eros egestas, consequat nulla at, hendrerit quam. Aliquam a urna hendrerit, tempor nulla eget, sollicitudin est. Cras vel ipsum consectetur, volutpat risus blandit, pretium lorem. Curabitur mollis ultricies odio. Donec at ligula lorem. Sed scelerisque quis sapien a semper. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae;', 'Nulla eros augue, mattis ac sem ac, sagittis placerat urna. Fusce ipsum dolor, efficitur et laoreet eget, vulputate ut velit. Nullam eu dolor quis mauris maximus iaculis ut vel nunc. Proin imperdiet hendrerit sapien, id semper nunc dictum nec. Fusce cursus at orci eu vehicula. Donec blandit accumsan', 'demon_slayer.jpg', '2024-02-10 10:00:17', '2024-02-10 11:30:12', 4),
(7, 'Pokémon', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper libero orci, et varius ante dictum sed. Morbi cursus magna eget ante luctus, nec elementum orci dictum. Nullam vel bibendum augue, ac commodo neque. Etiam eu viverra ipsum. Vestibulum suscipit, urna vitae malesuada auctor, erat urna dignissim velit, id suscipit diam justo laoreet erat. Donec id auctor velit. Curabitur cursus mollis nulla, sed ullamcorper risus tempus ac. Morbi sit amet nisl bibendum, fringilla libero eleifend, vestibulum erat. Duis eget sem cursus, efficitur libero at, porta turpis. Ut lacinia ex neque, a mattis ipsum ultrices vitae. Fusce sit amet enim aliquet, congue orci ut, finibus arcu. Cras viverra ante sed dui tempor elementum. Curabitur a tortor eleifend dui semper lobortis. Aenean non elit tristique, mollis orci quis, finibus mi. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus facilisis ante et libero ornare bibendum.\r\n\r\nCurabitur dignissim justo sit amet gravida pharetra. Aliquam convallis purus et turpis laoreet euismod. Phasellus eget tellus massa. Donec odio eros, pharetra quis enim in, ornare lobortis lectus. Phasellus vel sapien placerat, lacinia mi vitae, iaculis libero. Vivamus justo urna, sagittis iaculis feugiat in, sodales sed diam. Ut congue ac enim non feugiat. Nullam vitae ante vel nisl tincidunt dignissim. Maecenas finibus non ante quis tincidunt. In eu imperdiet mauris. Etiam sit amet dolor tellus. Ut posuere dui nec volutpat dapibus. Donec non viverra nibh. Nullam et euismod massa.\r\n\r\nNulla facilisi. In finibus augue id lorem vehicula, sed vulputate tellus suscipit. Sed consequat mattis odio, ut pretium leo mollis sed. Vivamus sit amet tristique nunc. Cras aliquam massa quis suscipit convallis. Etiam eu venenatis mauris, ac dignissim odio. Suspendisse at euismod nulla. Vivamus sodales gravida mauris ut vehicula. Morbi convallis efficitur magna. Vestibulum pretium vulputate diam, ut euismod eros elementum id. Sed et elit id sem placerat suscipit. Cras pretium turpis a neque bibendum, tristique rhoncus ipsum tempus. Cras commodo justo eu magna sodales fringilla. Sed dapibus non mi quis dapibus.', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut semper libero orci, et varius ante dictum sed. Morbi cursus magna eget ante luctus, nec elementum orci dictum. Nullam vel bibendum augue, ac commodo neque. Etiam eu viverra ipsum. Vestibulum suscipit, urna vitae malesuada auctor, erat urna ', 'pokemon.jpg', '2024-02-10 18:38:31', '2024-02-10 18:38:31', 4);


-- Création de la table "commentaires"
CREATE TABLE IF NOT EXISTS commentaires (
  id BIGINT UNSIGNED PRIMARY KEY AUTO_INCREMENT,
  corps       TEXT NOT NULL,
  created_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  updated_at   TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  id_post BIGINT UNSIGNED,
  id_utilisateur BIGINT UNSIGNED,
  FOREIGN KEY (id_post) REFERENCES posts (id) ON DELETE SET NULL,
  FOREIGN KEY (id_utilisateur) REFERENCES utilisateurs (id) ON DELETE SET NULL
);

INSERT INTO `commentaires` (`id`, `corps`, `created_at`, `updated_at`, `id_post`, `id_utilisateur`) VALUES
(1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam, odio ac interdum congue, libero arcu porttitor risus, eget consectetur odio odio a nibh. Sed sed consectetur sem. Nullam in mollis nunc. Cras interdum libero nec lorem elementum laoreet. Nunc ultricies nunc nec urna sodales pretium.', '2024-02-11 16:02:24', '2024-02-11 16:02:24', 1, 1),
(2, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam, odio ac interdum congue, libero arcu porttitor risus, eget consectetur odio odio a nibh. Sed sed consectetur sem. Nullam in mollis nunc.', '2024-02-11 17:14:32', '2024-02-11 17:14:32', 1, 4),
(3, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam, odio ac interdum congue, libero arcu porttitor risus, eget consectetur odio odio a nibh. Sed sed consectetur sem. Nullam in mollis nunc. Cras interdum libero nec lorem elementum laoreet. Nunc ultricies nunc nec urna sodales pretium.', '2024-02-11 17:33:48', '2024-02-11 17:33:48', 7, 3),
(4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam, odio ac interdum congue, libero arcu porttitor risus, eget consectetur odio odio a nibh. Sed sed consectetur sem. Nullam in mollis nunc. Cras interdum libero nec lorem elementum laoreet. Nunc ultricies nunc nec urna sodales pretium.', '2024-02-11 17:33:48', '2024-02-11 17:33:48', 6, 2),
(5, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam, odio ac interdum congue, libero arcu porttitor risus, eget consectetur odio odio a nibh. Sed sed consectetur sem. Nullam in mollis nunc. Cras interdum libero nec lorem elementum laoreet. Nunc ultricies nunc nec urna sodales pretium.', '2024-02-11 17:34:54', '2024-02-11 17:34:54', 7, 1),
(6, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed aliquam, odio ac interdum congue, libero arcu porttitor risus, eget consectetur odio odio a nibh. Sed sed consectetur sem. Nullam in mollis nunc. Cras interdum libero nec lorem elementum laoreet. Nunc ultricies nunc nec urna sodales pretium.', '2024-02-11 17:34:54', '2024-02-11 17:34:54', 7, 4);

  ```
 10. Une fois toute ces étapes passer, vous devriez avoir accès au projet via l'adresse -> http://localhost:8084/
