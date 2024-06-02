<?php include 'wrapper.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Agent</title>
    <style>
        .ish {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        .form-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 20px;
        }
        .form-container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input[type="text"], .form-group input[type="courriel"], .form-group input[type="tel"], .form-group input[type="file"], .form-group input[type="password"] {
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
            padding: 0; 
            margin: 0; 
            font-size: inherit; 
            text-align: center;
        }
        .auth-footer button:hover {
            color: darkblue;
        }
    </style>
</head>
<body><div class="ish">

    <div class="form-container">
        <h2>Ajouter Agent</h2>
        <?php
        include 'db.php';

        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_agent'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $specialite = $_POST['specialite'];
            $courriel = $_POST['courriel'];
            $numero_tel = $_POST['numero_tel'];
            $bureau = $_POST['bureau'];
            $mot_de_passe = $_POST['mot_de_passe'];

            
            $photo = $_FILES['photo']['name'];
            $video = $_FILES['video']['name'];
            $cv = $_FILES['cv']['name'];

            // Upload des fichiers importés 
            if ($photo) {
                $target_dir = "photos_agents/";
                $target_file = $target_dir . basename($photo);
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
            }

            if ($video) {
                $target_dir = "videos_agents/";
                $target_file = $target_dir . basename($video);
                move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
            }

            if ($cv) {
                $target_dir = "cv_agents/";
                $target_file = $target_dir . basename($cv);
                move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file);
            }

            // Requête SQL d'insertion
            $sql_insert = "INSERT INTO agent (nom, prenom, specialite, photo, courriel, numero_tel, bureau, video, cv, mot_de_passe) VALUES (
                '$nom', 
                '$prenom', 
                '$specialite', 
                '$photo', 
                '$courriel', 
                '$numero_tel', 
                '$bureau', 
                '$video', 
                '$cv', 
                '$mot_de_passe'
            )";

            if ($conn->query($sql_insert) === TRUE) {
                echo "Nouvel agent ajouté avec succès.";
            } else {
                echo "Erreur lors de l'ajout de l'agent: " . $conn->error;
            }
        }

        $conn->close();
        ?>
 <!-- formulaire a replir  -->
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
            <div class="form-group">
                <label for="specialite">Spécialité:</label>
                <input type="text" id="specialite" name="specialite" required>
            </div>
            <div class="form-group">
                <label for="courriel">courriel:</label>
                <input type="courriel" id="courriel" name="courriel" required>
            </div>
            <div class="form-group">
                <label for="numero_tel">Téléphone:</label>
                <input type="tel" id="numero_tel" name="numero_tel" required>
            </div>
            <div class="form-group">
                <label for="bureau">Bureau:</label>
                <input type="text" id="bureau" name="bureau" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo">
            </div>
            <div class="form-group">
                <label for="video">Vidéo:</label>
                <input type="file" id="video" name="video">
            </div>
            <div class="form-group">
                <label for="cv">CV:</label>
                <input type="file" id="cv" name="cv">
            </div>
            <div class="form-group">
                <button type="submit" name="add_agent">Ajouter</button>
            </div>
        </form>
    </div>
    <div class="auth-footer">
            <form action="mon_compte_admin.php">
                <button type="submit">Retour</button>
            </form>
            <br><br>
    </div>
    </div>
</body>
</html>
