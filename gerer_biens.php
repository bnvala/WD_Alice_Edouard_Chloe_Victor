<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gérer les Biens</title>
    <style>
        .ok {
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
            justify-content: space-around; 
            gap: 20px; 
        }
        .item {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px; 
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
            margin: 10px 0;
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
        .delete-button {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 5px 20px;
            border-radius: 10px;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px; 
            text-decoration: none;
            font-size: 16px;
        }
        .delete-button:hover {
            background-color: #c82333;
        }
        .return-button {
            background-color: transparent;
            border: none;
            color: #007bff;
            text-decoration: underline;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }
        .return-button:hover {
            color: #0056b3;
        }
    </style>
</head>
<body>
<?php include 'wrapper.php'; ?>
<div ok>
    <h1><center>Gérer les Biens</center></h1>
    <br>
    <center><a href="ajouter_bien.php" class="add-button">Ajouter un bien</a></center>
    <br><br>
    <?php

    $servername = "localhost";
    $username = "root";        
    $password = "";            
    $dbname = "pj_piscine";    

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Échec de la connexion : " . $conn->connect_error);
    }

    // Vérifier si un bien doit être supprimé
    if (isset($_GET['delete']) && $_GET['delete'] == 'true' && isset($_GET['id'])) {
        // ID du bien à supprimer
        $bienId = $_GET['id']; 

        // Requête SQL pour supprimer le bien avec l'ID 
        $sql = "DELETE FROM biens WHERE id = $bienId";

        
        if ($conn->query($sql) === TRUE) {
            header("Location: gerer_biens.php");
            exit; 
        } else {
            echo '<script>alert("Erreur lors de la suppression du bien : ' . $conn->error . '");</script>';
        }
    }

    // Requête SQL pour récupérer tous les biens
    $sql = "SELECT * FROM biens";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo '<div class="container">'; 

        while($row = $result->fetch_assoc()) {
            echo '<div class="item">';
            echo '<div class="item-container">'; 
            echo '<img src="' . $row["photos"] . '" alt="Photo du bien">';
            echo '<h3>' . $row["type"] . '</h3>';
            echo '<p>' . $row["adresse"] . '</p>';
            echo '<a href="?delete=true&id=' . $row["id"] . '" class="delete-button">Supprimer</a>';
            echo '</div>'; 
            echo '</div>'; 
        }

        echo '</div>'; 
    } else {
        echo "Aucun bien trouvé.";
    }

    $conn->close();
    ?>
    <br><br>
    <center><a href="mon_compte_admin.php" class="return-button">Retour</a></center>
    <br><br>
</div>
</body>
</html>
