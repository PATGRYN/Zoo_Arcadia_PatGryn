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

$sql = "SELECT nom, commentaire, date FROM commentaires ORDER BY date DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='comment'>";
        echo "<p><strong>" . htmlspecialchars($row['nom']) . "</strong> (" . $row['date'] . ")</p>";
        echo "<p>" . htmlspecialchars($row['commentaire']) . "</p>";
        echo "</div>";
    }
} else {
    echo "Aucun commentaire pour le moment.";
}

$conn->close();
?>