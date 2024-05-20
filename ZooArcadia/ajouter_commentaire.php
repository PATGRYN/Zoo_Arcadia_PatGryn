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
