<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $comment = htmlspecialchars($_POST['comment']);

    // Connexion à la base de données (remplacez les valeurs par les informations de connexion)
    $servername = "localhost";
    $username = "votre_nom_utilisateur";
    $password = "votre_mot_de_passe";
    $dbname = "zoo_arcadia";

    // Créer une connexion
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Vérifier la connexion
    if ($conn->connect_error) {
        die("La connexion a échoué: " . $conn->connect_error);
    }

    // Préparer et exécuter la requête SQL pour insérer le commentaire
    $sql = "INSERT INTO commentaires (nom, commentaire) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $name, $comment);

    if ($stmt->execute()) {
        echo "Merci pour votre commentaire, $name!";
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }

    // Fermer la connexion
    $stmt->close();
    $conn->close();
}
?>

