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
<?php include '../wrapper_biens.php'; ?>  
    <h1 class="title">Présentation du Bien</h1>
    <div class="container">
        <div class="image">
            <?php
            $servername = "localhost"; 
            $username = "root";        
            $password = "";          
            $dbname = "pj_piscine";  

            // Connexion BDD
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
            // mdp id BDD
            $servername = "localhost"; 
            $username = "root";        
            $password = "";            
            $dbname = "pj_piscine";   

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
                $description = $row["description"];
                $adresse = $row["adresse"];
                $prix = $row["prix"]; // Nouvelle ligne pour récupérer le prix du bien
        
                // Afficher les informations du bien
                echo "<h2>Type: $type</h2>";
                echo "<p>Description: $description</p>";
                echo "<p>Adresse: $adresse</p>";
                echo "<p>Prix: $prix €</p>";
        ?>
                <!-- affichage de la map sur google map -->
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2623.922425013107!2d2.3936363763673913!3d48.87875537133496!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e66dbe90b1280d%3A0xe06e4977b6eea5d!2s12%20Rue%20des%20Lilas%2C%2075019%20Paris!5e0!3m2!1sfr!2sfr!4v1716985780909!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
                echo "pas d'agent trouver";
            }
            // Fermer la connexion
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
