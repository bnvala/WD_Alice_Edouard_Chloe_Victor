<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tout Parcourir</title>
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
        }
        .item {
            flex: 1 0 30%; /* Prend 30% de la largeur de la ligne */
            box-sizing: border-box;
            padding: 10px;
            text-align: center;
        }
        .item-container {
            border: 1px solid #ccc; /* Bordure autour de chaque bien */
            padding: 10px;
            margin-bottom: 20px;
            cursor: pointer; /* Curseur pointer pour indiquer qu'il est cliquable */
        }
        .item img {
            width: 100%; /* Largeur fixe pour toutes les images */
            height: 200px; /* Hauteur fixe pour toutes les images */
            object-fit: cover; /* Redimensionne l'image pour qu'elle remplisse la zone sans déformation */
            margin-bottom: 10px; /* Espacement en bas de l'image */
        }
    </style>
</head>
<body>
    <h1>Tout Parcourir</h1>
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

    // Requête SQL pour récupérer les biens de 49 à 73
    $sql = "SELECT * FROM biens WHERE id BETWEEN 49 AND 73";
    $result = $conn->query($sql);

    // Vérifier s'il y a des résultats
    if ($result->num_rows > 0) {
        echo '<div class="container">'; // Conteneur flex pour les lignes

        // Parcourir les résultats
        while($row = $result->fetch_assoc()) {
            echo '<div class="item">';
            echo '<a href="bien' . $row["id"] . '.php">'; // Lien hypertexte vers bien{id}.php
            echo '<div class="item-container">'; // Conteneur autour de chaque bien
            echo '<img src="' . $row["photos"] . '" alt="Photo du bien">';
            echo '<h3>' . $row["type"] . '</h3>';
            echo '<p>' . $row["adresse"] . '</p>';
            echo '</div>'; // Fermer item-container
            echo '</a>'; // Fermer le lien hypertexte
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
