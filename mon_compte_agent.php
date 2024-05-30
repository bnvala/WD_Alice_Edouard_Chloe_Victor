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
    <title>Mon Compte Agent</title>
    <style>
        #cadre {
    width: 100%; /* Modifié pour être encore plus large */
    max-width: 800px; /* Limite la largeur maximale */
    height : 400Spx;
    margin: 50px auto; /* Positionné plus bas et centré horizontalement */
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
    margin-top: 40px; /* Augmentation de la marge supérieure pour décaler vers le bas */
    text-decoration: none;
}

        #deconnexionBtn:hover {
            background-color: grey;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            font-size: 16px;
            color: white;
            background-color: #003366;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div id="cadre">
        <h2>Mon Compte Agent</h2>
        <p>Nom et prénom : <?php echo htmlspecialchars($utilisateur['nom']); ?> <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
        <p>Identifiant : <?php echo htmlspecialchars($utilisateur['courriel']); ?></p>
        
        <div class="button-container">
            <a href="mes_rendez-vous.php" class="button">Mes Rendez-vous</a>
            <a href="mes_messages.php" class="button">Mes Messages</a>
            <a href="mes_consultations.php" class="button">Mes Consultations</a>
        </div>
<br> <br> 
        <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
    </div>
</body>
</html>
