<?php include 'wrapper.php';

if (!isset($_SESSION['utilisateur'])) {
//verif la connexion et page d econnexion si deco
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
    <title>Mon Compte Administrateur</title>
    <style>
        h2 {
            margin-bottom: 20px;
        }
        #deconnexionBtn {
            font-size: 20px;
            color: white;
            background-color: #007bff;
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
        .action-btn {
            display: block;
            font-size: 16px; 
            color: white;
            background-color: #376b8c; 
            border: none;
            padding: 8px 16px; 
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px auto; 
            text-decoration: none;
            max-width: 200px; 
        }
        .action-btn:hover {
            background-color: #2b5170; 
        }
    </style>
</head>
<body>
    <div>
         <!-- informations de l'admin +boutons pour toutes les fonctionnalité speciales du profil -->
        <center>
            <h2>Mon Compte Administrateur</h2>
            <p>Nom : <?php echo htmlspecialchars($utilisateur['nom']); ?></p>
            <p>Prénom : <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
            <p>Identifiant : <?php echo htmlspecialchars($utilisateur['courriel']); ?></p>
            <a href="gerer_agents.php" class="action-btn">Gérer les agents immobiliers</a>
            <a href="gerer_biens.php" class="action-btn">Gérer les biens</a>
            <a href="ajt_admin.php" class="action-btn">Ajouter un administrateur</a><br>
            <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
        </center>
    </div>
</body>
</html>
