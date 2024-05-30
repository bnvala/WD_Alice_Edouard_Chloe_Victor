<?php
session_start();

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
    <title>Mon Compte Administrateur</title>
    <style>

        #cadre {
            width: 400px;
            margin: 0 auto;
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
            font-size: 18px;
            color: white;
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 10px 0;
            text-decoration: none;
        }
        .action-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
<?php include 'wrapper.php'; ?>
    <div id="cadre">
        <h2>Mon Compte Administrateur</h2>
        <p>Nom : <?php echo htmlspecialchars($utilisateur['nom']); ?></p>
        <p>Prénom : <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
        <p>Identifiant : <?php echo htmlspecialchars($utilisateur['courriel']); ?></p>
        <a href="gerer_agents.php" class="action-btn">Gérer les agents immobiliers</a>
        <a href="gerer_biens.php" class="action-btn">Gérer les biens</a>
        <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
    </div>
</body>
</html>