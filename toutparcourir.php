<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tout Parcourir</title>
    <link rel="stylesheet" type="text/css" href="styles_toutparcourir.css">
</head>
<body>
<?php include 'wrapper.php';?>

    <h1>Nos propriétés</h1>
    <?php
    
    $servername = "localhost"; 
    $username = "root";      
    $password = "";           
    $dbname = "pj_piscine";    

    // connexion bdd
    $conn = new mysqli($servername, $username, $password, $dbname);

 
    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // recuperation des biens de 49 à 73
    $sql = "SELECT id, type, adresse, photos, prix FROM biens WHERE id BETWEEN 49 AND 73";
    $result = $conn->query($sql);

   
    if ($result->num_rows > 0) {
        echo '<div class="container">'; 

        // Parcourir les résultats
        while($row = $result->fetch_assoc()) {
            echo '<div class="item">';
            echo '<a href="pages_biens/bien' . $row["id"] . '.php">'; // si on clique sur le bien on va sur sa page
            echo '<div class="item-container">'; 
            echo '<img src="' . $row["photos"] . '" alt="Photo du bien">';
            echo '<h3>' . $row["type"] . '</h3>';
            echo '<p>' . $row["adresse"] . '</p>';
            echo '<p>Prix: ' . $row["prix"] . ' €</p>'; 
            echo '</div>'; 
            echo '</a>'; 
            echo '</div>';
        }

        echo '</div>'; 
    } else {
        echo "Aucun bien trouvé.";
    }

    
    $conn->close();
    include 'nos-agents.php'; //affichage de tous les agents avec un code php 
    ?>
   
</body>
</html>
