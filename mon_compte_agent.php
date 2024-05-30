<?php
include 'wrapper.php';

if (!isset($_SESSION['utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    echo "<script>window.location.href = 'form.php';</script>";
    exit;
}

$utilisateur = $_SESSION['utilisateur'];
$id_agent = $utilisateur['id_agent']; // Récupérer l'ID de l'agent connecté
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte Agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #cadre {
            width: 100%; 
            max-width: 800px; 
            height: 400px;
            margin: 50px auto; 
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 10px;
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
            margin-top: 40px; 
            text-decoration: none;
        }

        #deconnexionBtn:hover {
            background-color: #555;
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
            <a href="rdv_agent.php" class="button">Mes Rendez-vous</a>
            <a href="mes_messages.php?id_agent=<?php echo urlencode($id_agent); ?>" class="button">Mes Messages </a>
            <a href="mes_consultations.php?id_agent=<?php echo urlencode($id_agent); ?>" class="button">Mes Consultations </a>
        </div>

        <br><br>

        <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
    </div>
</body>
</html>
