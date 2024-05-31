<?php
include 'wrapper.php';

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
    <title>Mon Compte Client</title>
    <style>

        #cadre {
            width: 400px;
            margin: 0 auto;
            margin-top : 10px; 
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        #deconnexionBtn {
            font-size: 20px;
            color: white;
            background-color: grey;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            text-decoration: none;
        }
        #deconnexionBtn:hover {
            background-color: #0056b3;
        }
        #messagerieBtn {
            font-size: 20px;
            color: white;
            background-color: #0f056b;
            border: none;
            padding: 10px 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="cadre">
        <h2>Mon Compte Client</h2>
        <p>Nom et prénom : <?php echo htmlspecialchars($utilisateur['nom'])?> <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
        <p>Adresse : <?php echo htmlspecialchars($utilisateur['adresse']); ?></p>
        <p>Identifiant : <?php echo htmlspecialchars($utilisateur['courriel']); ?></p>
        <br>
        <a href="historique_message.php" id="messagerieBtn">Messagerie</a>
        <br><br><br> 
        <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
    </div>
</body>
</html>
