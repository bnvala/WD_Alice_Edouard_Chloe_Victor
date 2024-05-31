<?php include 'wrapper.php'; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Administrateur</title>
    <style>
        .form-container {
            text-align: center;
            margin: 0 auto;
            max-width: 400px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
        .auth-footer {
            text-align: center;
            margin-top: 20px;
        }
        .auth-footer button {
            background: none;
            border: none;
            color: blue;
            text-decoration: underline;
            cursor: pointer;
            padding: 0; /* Supprime le rembourrage */
            margin: 0; /* Supprime les marges */
            font-size: inherit; /* Utilise la taille de police par défaut */
            text-align: center;
        }
        .auth-footer button:hover {
            color: darkblue;
        }
    </style>
</head>
<body>
    <br>
    <div class="form-container">
        <h2>Ajouter Administrateur</h2>
        <?php
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_admin'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $courriel = $_POST['courriel'];
            $mot_de_passe = $_POST['mot_de_passe'];

            // Requête SQL pour insérer un nouvel administrateur
            $sql_insert = "INSERT INTO admin (nom, prenom, courriel, mot_de_passe) VALUES (
                '$nom', 
                '$prenom', 
                '$courriel', 
                '$mot_de_passe'
            )";

            if ($conn->query($sql_insert) === TRUE) {
                echo "Nouvel administrateur ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout de l'administrateur: " . $conn->error;
            }
        }

        $conn->close();
        ?>

        <form method="post">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="courriel">Courriel:</label>
                <input type="email" id="courriel" name="courriel" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div class="form-group">
                <button type="submit" name="add_admin">Ajouter</button>
            </div>
        </div>
        </form>
        <div class="auth-footer">
            <form action="mon_compte_admin.php">
                <button type="submit">Retour</button>
            </form>
            <br><br>
    </div>
</body>
</html>
