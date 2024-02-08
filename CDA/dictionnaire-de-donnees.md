## Dictionnaire de données en amont de la modélisation

Posts

|Nom|Type|Taille|Description|
|-|-|-|-|
|num_posts|Entier|-|ID du post|
|titre|Chaîne de caractères|100|Titre du post|
|corps|Texte|-|Description du post|
|extrait|Chaîne de caractères|300|Les 300 premiers caractères de la description|
|fichier_image|image|150|Le lien de l'image|
|created_at|Date|-|Date de création|
|updated_at|Date|-|Date de mise à jour|


Commentaires

|Nom|Type|Taille|Description|
|-|-|-|-|
|num_comment|Entier|-|ID du commentaire|
|corps|Texte|-|Contenu du commentaire|
|created_at|Date|-|Date de création|
|updated_at|Date|-|Date de mise à jour|
|num_podcast|Entier|-|ID du podcast|


Catégories

|Nom|Type|Taille|Description|
|-|-|-|-|
|num_category|Entier|-|ID de la catégorie|
|nom|Chaîne de caractères|100|titre de la catégorie|
|created_at|Date|-|Date de création|
|updated_at|Date|-|Date de mise à jour|


Utilisateurs

|Nom|Type|Taille|Description|
|-|-|-|-|
|num_utilisateur|Entier|-|ID de la catégorie|
|nom|Chaîne de caractères|100|nom de l'utilisateur|
|image|Chaîne de caractères|150|photo de l'utilisateur|
|created_at|Date|-|Date de création|
|updated_at|Date|-|Date de mise à jour|



## Evolution du dictionnaire de données après le MPD

Podcasts

|Nom|Type|Taille|Description|
|-|-|-|-|
|id|BIGINT UNSIGNED|-|ID du post|
|titre|VARCHAR|100|Titre du post|
|corps|TEXT|-|Description du post|
|extrait|VARCHAR|300|Les 300 premiers caractères de la description|
|fichier_image|VARCHAR|150|Le lien de l'image|
|created_at|TIMESTAMP|-|Date de création|
|updated_at|TIMESTAMP|-|Date de mise à jour|
|id_categorie|BIGINT UNSIGNED|-|ID de la categorie à laquelle appartient le podcast|


Commentaires

|Nom|Type|Taille|Description|
|-|-|-|-|
|id|BIGINT UNSIGNED|-|ID du commentaire|
|corps|TEXT|-|Contenu du commentaire|
|created_at|TIMESTAMP|-|Date de création|
|updated_at|TIMESTAMP|-|Date de mise à jour|
|podcast_id|BIGINT UNSIGNED|-|ID du podcast à qui appartient les commentaires|
|util_id|BIGINT UNSIGNED|-|ID de l'utilisateur à qui appartient le commentaire|


Catégories

|Nom|Type|Taille|Description|
|-|-|-|-|
|id|BIG INT UNSIGNED|-|ID de la catégorie|
|nom|VARCHAR|100|titre de la catégorie|
|created_at|TIMESTAMP|-|Date de création|
|updated_at|TIMESTAMP|-|Date de mise à jour|


Utilisateurs

|Nom|Type|Taille|Description|
|-|-|-|-|
|id|BIG INT UNSIGNED|-|ID de la catégorie|
|nom|VARCHAR|100|nom de l'utilisateur|
|photo|VARCHAR|150|photo de l'utilisateur|
|created_at|TIMESTAMP|-|Date de création|
|updated_at|TIMESTAMP|-|Date de mise à jour|
