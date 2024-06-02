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

            $id_bien = 71;

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
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "pj_piscine";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Échec de la connexion : " . $conn->connect_error);
            }

            $id_bien = 71;

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
               ?>
               <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2530.2660044358527!2d3.014740376473815!3d50.640750771629115!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c32aa785fa98bd%3A0x83317c7db567a5b3!2s10%20Av.%20de%20la%20R%C3%A9publique%2C%2059160%20Lille!5e0!3m2!1sfr!2sfr!4v1716993651194!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>                <?php 
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
