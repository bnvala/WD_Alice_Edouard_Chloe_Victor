<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tout Parcourir</title>
    <link rel="stylesheet" type="text/css" href="styles_toutparcourir.css">
</head>
<body>
<div id="wrapper">
        <header>
            <h1><center>Omnes Immobilier</center></h1>
            <nav>
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="toutparcourir.php">Tout Parcourir</a></li>
                    <li><a href="recherche.php">Recherche</a></li>
                    <li><a href="rendez-vous.php">Rendez-vous</a></li>
                    <li><a href="form.php">Votre Compte</a></li>
                </ul>
            </nav>
        </header>
</div>

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
            echo '<a href="pages_biens/bien' . $row["id"] . '.php">'; // Lien hypertexte vers bien{id}.php
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
