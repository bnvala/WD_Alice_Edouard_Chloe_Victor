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

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            $id_bien = 64;

            $sql = "SELECT * FROM biens WHERE id = $id_bien";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $photo = "../" . $row["photos"];
                echo "<img src='$photo' alt='Photo du bien'>";
            } else {
                echo "Aucun bien trouvé avec cet ID.";
            }

            $conn->close();
            ?>
        </div>
        <div class="info">
            <?php
            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            $id_bien = 64;

            $sql = "SELECT * FROM biens WHERE id = $id_bien";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $type = $row["type"];
                $description = $row["description"];
                $adresse = $row["adresse"];
                $prix = $row["prix"];
                echo "<h2>Type: $type</h2>";
                echo "<p>Description: $description</p>";
                echo "<p>Adresse: $adresse</p>";
                echo "<p>Prix: $prix €</p>";
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
            $sql_agents = "SELECT * FROM agent WHERE specialite = '$type'";
            $result_agents = $conn->query($sql_agents);

            if ($result_agents->num_rows > 0) {
                while($row_agents = $result_agents->fetch_assoc()) {
                    echo '<div class="agent-card" onclick="window.location.href=\'../profil-agent.php?id=' . $row_agents["id_agent"] . '\'">';
                    echo '<img src="../photos_agents/' . $row_agents["photo"] . '" alt="Photo de l\'agent">';
                    echo '<div class="specialty"> ' . $row_agents["nom"] . '</div>';
                    echo '<div class="specialty"> ' . $row_agents["prenom"] . '</div>';
                    echo '</div>';
                }
            } else {
                echo "pas d'agent trouvé";
            }
            $conn->close();
            ?>
        </div>
    </div>
</body>
</html>
