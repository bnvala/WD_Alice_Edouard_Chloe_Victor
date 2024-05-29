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
            $id_bien = 71;

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
            $id_bien = 71;

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
                    echo '<div class="agent-card" onclick="window.location.href=\'profil-agent.php?id=' . $row_agents["id_agent"] . '\'">';
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
