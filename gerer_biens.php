<?php
session_start();

if (!isset($_SESSION['utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    echo "<script>window.location.href = 'form.php';</script>";
    exit;
}

$utilisateur = $_SESSION['utilisateur'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Biens</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .item {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin: 20px;
            padding: 20px;
            width: 250px;
            text-align: center;
        }
        .item img {
            border-radius: 10px;
            width: 100%;
            height: 150px;
            object-fit: cover;
        }
        .item h3 {
            margin: 10px 0;
        }
        .item p {
            margin: 5px 0;
        }
        .add-button {
            background-color: #28a745;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin: 20px;
            text-decoration: none;
            font-size: 18px;
        }
        .add-button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <h1>Gérer les Biens</h1>
    <a href="ajouter_bien.php" class="add-button">Ajouter un bien</a>
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

    // Requête SQL pour récupérer tous les biens
    $sql = "SELECT * FROM biens";
    $result = $conn->query($sql);

    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        echo '<div class="container">'; // Conteneur flex pour les biens

        // Parcourir les résultats
        while($row = $result->fetch_assoc()) {
            echo '<div class="item">';
            echo '<div class="item-container">'; // Conteneur autour de chaque bien
            echo '<img src="' . $row["photos"] . '" alt="Photo du bien">';
            echo '<h3>' . $row["type"] . '</h3>';
            echo '<p>' . $row["adresse"] . '</p>';
            echo '</div>'; // Fermer item-container
            echo '</div>'; // Fermer item
        }

        echo '</div>'; // Fermer le conteneur flex
    } else {
        echo "Aucun bien trouvé.";
    }

    // Fermer la connexion
    $conn->close();
    ?>
</body>
</html>
