<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présentation du Bien</title>
    <!-- Inclusion du fichier CSS -->
    <link rel="stylesheet" href="biens.css">
</head>
<body>
    <?php
// Informations de connexion à la base de données
$servername = "localhost"; // Remplacer par le nom de votre serveur
$username = "root";        // Remplacer par votre nom d'utilisateur
$password = "";            // Remplacer par votre mot de passe
$dbname = "pj_piscine";    // Nom de la base de données

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// ID du bien à afficher
$id_bien = 49;

// Requête SQL pour récupérer les informations du bien avec l'ID 49
$sql = "SELECT * FROM biens WHERE id = $id_bien";
$result = $conn->query($sql);

// Vérifier s'il y a des résultats
if ($result->num_rows > 0) {
    // Récupérer les données du bien
    $row = $result->fetch_assoc();
    $type = $row["type"];
    $photo = $row["photos"];
    $description = $row["description"];
    $adresse = $row["adresse"];

    // Afficher les informations du bien
    echo "<h1>Présentation du Bien</h1>";
    echo "<img src='$photo' alt='Photo du bien'>";
    echo "<h2>Type: $type</h2>";
    echo "<p>Description: $description</p>";
    echo "<p>Adresse: $adresse</p>";
} else {
    echo "Aucun bien trouvé avec cet ID.";
}

// Fermer la connexion
$conn->close();
?>
</body>
