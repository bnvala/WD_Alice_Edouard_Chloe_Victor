<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "omnes_immobilier";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

// Récupération des données de la table des biens
$sql = "SELECT photo, type, ville FROM biens";
$result = $conn->query($sql);

// Fermeture de la connexion
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Tout Parcourir</title>
    <style>
        .property {
            border: 1px solid #ddd;
            margin: 10px;
            padding: 10px;
            display: inline-block;
            vertical-align: top;
            width: 200px;
            text-align: center;
        }
        .property img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <h1>Tout Parcourir</h1>
    <div class="properties">
        <?php
        if ($result->num_rows > 0) {
            // Affichage des données de chaque ligne
            while($row = $result->fetch_assoc()) {
                echo '<div class="property">';
                echo '<img src="' . $row["photo"] . '" alt="' . $row["type"] . '">';
                echo '<h2>' . $row["type"] . '</h2>';
                echo '<p>' . $row["ville"] . '</p>';
                echo '</div>';
            }
        } else {
            echo "0 résultats";
        }
        ?>
    </div>
</body>
</html>
