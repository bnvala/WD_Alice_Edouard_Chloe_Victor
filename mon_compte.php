<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    echo "<script>window.location.href = 'form.php';</script>";
    exit;
}
$utilisateur = $_SESSION['utilisateur'];

// Redirection vers la page de connexion si l'utilisateur n'est pas connecté
echo "<script>window.location.href = 'form.php';</script>";
exit;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
        }
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
            background-color: #007bff; /* Bleu */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            text-decoration: none; /* Pour un lien */
        }
        #deconnexionBtn:hover {
            background-color: #0056b3; /* Bleu plus foncé au survol */
        }
    </style>
</head>
<body>
    <div id="cadre">
        <h2>Mon Compte</h2>
        <p>Nom : <?php echo $utilisateur['nom']; ?></p>
        <p>Prénom : <?php echo $utilisateur['prenom']; ?></p>
        <p>Adresse : <?php echo $utilisateur['adresse']; ?></p>
        <p>Identifiant : <?php echo $utilisateur['courriel']; ?></p>
        <!-- Vous pouvez ajouter d'autres informations de l'utilisateur ici -->

        <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
    </div>
</body>
</html>
