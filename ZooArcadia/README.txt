Bienvenue au Zoo Arcadia !

Découvrez la merveilleuse diversité de la faune tropicale, de la savane africaine et des marais en plein coeur de la Bretagne.

Ce site présente les habitats et animaux du zoo, les services offerts, les avis des visiteurs, ainsi qu'un formulaire de commentaires/avis. Il y a également une page de connexion qui est réservé aux personnels et aux vétérinaires du zoo. 


Table des matières :

1- Description du projet
2- Structure du projet
3- Prérequis
4- Installation
5- Utilisation
6- Scripts PHP
7- Structure de la base de données
8- Personnalisation
9- Contact


1- Description du projet :

Le projet du site web du Zoo Arcadia est un site web qui est statique avec des fonctionnalités dynamiques pour afficher des informations sur les habitats, les animaux, ainsi que les services offerts par le zoo. Les visiteurs peuvent également laisser des avis via un formulaire de commentaires.


2- Structure du projet : 

Le projet est structuré comme suit :
- 'index.html' qui est la page d'accueil du site web.
- 'styles.css' qui correspond au fichier CSS pour le style du site. 
- 'script.js' c'est le fichier javascript pour les éventuelles interactions du site web.
- 'ajouter_commentaire.php' est le script PHP qui permet de traiter et d'enregistrer les commentaires des visiteurs.
- 'connexion.html' correspond à la page de connexion pour le personnel et le vétérinaire.
- il y a aussi d'autres pages HTML spécifiques pour chaque habitat, chaque animal et les services proposés au zoo (ex:'jungle.html').


3- Prérequis :

- un serveur web comme Apache, avec un support PHP.
- MySQL pour la base de données avec MAMP.
- un environnement de développement local qui est optionnel mais fortement recommandé comme MAMP. 


4- Installation :

Cloner le dépôt GitHub sur votre pc : 
git clone https://github.com/votre-utilisateur/zoo-arcadia.git
cd zoo-arcadia

Ensuite il faut configurer la base de données.
Utiliser MySQL pour créer une nouvelle base de données que vous allez nommer 'zoo_arcadia' : 
CREATE DATABASE zoo_arcadia;
USE zoo_arcadia;

Vous devez ensuite créer la table des commentaires :
Soit vous les importez à partir d'un fichier SQL, soit vous les créez manuellement.
CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    commentaire TEXT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Il faut ensuite configurer la connexion à la base de données. Il faut au préalable s'assurer que les informations de connexion à la base de données dans 'ajouter_commentaire.php' sont correctes.
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_arcadia";

// Créer une connexion 
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

Vous devez ensuite déployer le site : placer tous les fichiers du projet dans le répertoire de votre serveur web.


5- Utilisation :

Page d'accueil :
- 'index.html' présente les différentes sections du zoo incluant les habitats, les animaux, les services et les avis des visiteurs.
- Chaque section est liée à des pages spécifiques pour les habitats, les animaux et les services proposés.

Formulaire de commentaires :
Les visiteurs du zoo peuvent laisser leur avis via le formulaire de commentaires dans la section "avis".
<div class="comment-form">
    <h3>Laissez un commentaire</h3>
    <form action="ajouter_commentaire.php" method="post">
        <label for="nom">Pseudo:</label>
        <input type="text" id="nom" name="nom" required><br>
        <label for="commentaire">Avis:</label>
        <textarea id="commentaire" name="commentaire" required></textarea><br>
        <button type="submit">Soumettre</button>
    </form>
</div>


6- Scripts PHP :

Le script 'ajouter_commentaire.php' traite et enregistre les commentaires/avis dans la base de données :
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "zoo_arcadia";

// Créer une connexion 
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $commentaire = $_POST['commentaire'];
    
    // Echapper les entrées pour éviter les injections SQL
    $nom = $conn->real_escape_string($nom);
    $commentaire = $conn->real_escape_string($commentaire);

    $sql = "INSERT INTO commentaires (nom, commentaire) VALUES ('$nom', '$commentaire')";

    if ($conn->query($sql) === TRUE) {
        echo "Nouveau commentaire ajouté avec succès";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>


7- Structure de la base de données 

Afin de s'assurer que le script fonctionne correctement, voici un exemple de création de table pour les commentaires :
CREATE TABLE commentaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    commentaire TEXT NOT NULL,
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


8- Personnalisation :

Pour modifier le style du site, éditez le fichier 'styles.css'. Vous pouvez changer les couleurs, les polices et la disposition des éléments selon vos préférences. 

Pour ajouter de nouveaux habitats ou animaux..., vous devez créer des nouvelles pages HTML et mettre à jour les liens dans 'index.html'.

Enfin, si vous avez besoin de fonctionnalités supplémentaires ou de faire des modifications au niveau des données traitées, éditez les scripts PHP.


9- Contact

Pour toute question ou suggestion, veuillez contacter l'équipe du Zoo Arcadia à contact@zooarcadia.com.
