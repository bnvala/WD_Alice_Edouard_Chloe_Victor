<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Présentation du Bien</title>
    <link rel="stylesheet" type="text/css" href="biens.css">
    <link rel="stylesheet" type="text/css" href="../styles_entete.css">
</head>
<body>
<?php include '../wrapper.php'; ?>  
    <h1 class="title">Présentation du Bien</h1>
    <div class="container">
        <div class="image">
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
            $id_bien = 51;

            // Requête SQL pour récupérer les informations du bien avec l'ID 49
            $sql = "SELECT * FROM biens WHERE id = $id_bien";
            $result = $conn->query($sql);

            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                // Récupérer les données du bien
                $row = $result->fetch_assoc();
                $photo = "../" . $row["photos"];
                // Afficher l'image du bien
                echo "<img src='$photo' alt='Photo du bien'>";
            } else {
                echo "Aucun bien trouvé avec cet ID.";
            }

            // Fermer la connexion
            $conn->close();
            ?>
        </div>
        <div class="info">
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
            $id_bien = 51;

            // Requête SQL pour récupérer les informations du bien avec l'ID 49
            $sql = "SELECT * FROM biens WHERE id = $id_bien";
            $result = $conn->query($sql);

            // Vérifier s'il y a des résultats
            if ($result->num_rows > 0) {
                // Récupérer les données du bien
                $row = $result->fetch_assoc();
                $type = $row["type"];
                $description = $row["description"];
                $adresse = $row["adresse"];

                // Afficher les informations du bien
                echo "<h2>Type: $type</h2>";
                echo "<p>Description: $description</p>";
                echo "<p>Adresse: $adresse</p>";
                ?>
                <!-- Carte Google Maps -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2901.173849966718!2d5.370740076052417!3d43.35247397111797!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x12c9c018a8d103eb%3A0xddb1381652923721!2s20%20Rue%20des%20Champs%2C%2013015%20Marseille!5e0!3m2!1sfr!2sfr!4v1716993503468!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                 <?php 
            } else {
                echo "Aucun bien trouvé avec cet ID.";
            }

            ?>
        </div>
    </div>

    <div class="agents-container">
        <h2>Agents Immobiliers Spécialisés</h2>
        <div class="agents">
            <?php
            // Requête SQL pour récupérer les agents immobiliers en fonction du type du bien
            $sql_agents = "SELECT * FROM agent WHERE specialite = '$type'";
            $result_agents = $conn->query($sql_agents);

            // Vérifier s'il y a des résultats
            if ($result_agents->num_rows > 0) {
                while($row_agents = $result_agents->fetch_assoc()) {
                    echo '<div class="agent-card" onclick="window.location.href=\'../profil-agent.php?id=' . $row_agents["id_agent"] . '\'">';
                    echo '<img src="../photos_agents/' . $row_agents["photo"] . '" alt="Photo de l\'agent">';
                    echo '<div class="specialty"> ' . $row_agents["nom"] . '</div>';
                    echo '<div class="specialty"> ' . $row_agents["prenom"] . '</div>';
                    echo '</div>';
                }
            } else {
                echo "No agents found";
            }
            // Fermer la connexion
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
