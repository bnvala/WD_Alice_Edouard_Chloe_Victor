<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Agent</title>
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
        .form-group input[type="text"], .form-group input[type="email"], .form-group input[type="tel"], .form-group input[type="file"], .form-group input[type="password"] {
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
<body>
     <!-- entete de la page -->
<?php include 'wrapper.php'; 
 //recuperer l'id de lagent a modifier 
if (isset($_GET['agent_id'])) {
    
    $agent_id = $_GET['agent_id'];
} else {
    
    echo "Erreur: aucun ID d'agent fourni.";
    exit;
}
?>
<div class="ish">

    <div class="form-container">
        <h2>Modifier Agent</h2>
        <p>ID de l'agent sélectionné : <?php echo $agent_id; ?></p>

        <?php
        include 'db.php';

        // requete sql pour recuperer les infos d elagent 
        $sql = "SELECT * FROM agent WHERE id_agent = $agent_id";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $nom = $row['nom'];
            $prenom = $row['prenom'];
            $specialite = $row['specialite'];
            $photo = $row['photo'];
            $courriel = $row['courriel'];
            $numero_tel = $row['numero_tel'];
            $bureau = $row['bureau'];
            $video = $row['video'];
            $cv = $row['cv'];
            $mot_de_passe = $row['mot_de_passe'];
        } else {
            echo "Agent non trouvé.";
            exit();
        }

        // modifications a update 
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_agent'])) {
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $specialite = $_POST['specialite'];
            $courriel = $_POST['courriel'];
            $numero_tel = $_POST['numero_tel'];
            $bureau = $_POST['bureau'];
            $mot_de_passe = $_POST['mot_de_passe'];

            //gestion pour les nouveaux fichiers photos et vidéos 
            $photo = $_FILES['photo']['name'] ? $_FILES['photo']['name'] : $_POST['current_photo'];
            $video = $_FILES['video']['name'] ? $_FILES['video']['name'] : $_POST['current_video'];
            $cv = $_FILES['cv']['name'] ? $_FILES['cv']['name'] : $_POST['current_cv'];

            if ($_FILES['photo']['name']) {
                $target_dir = "photos_agents/";
                $target_file = $target_dir . basename($photo);
                move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file);
            }

            if ($_FILES['video']['name']) {
                $target_dir = "videos_agents/";
                $target_file = $target_dir . basename($video);
                move_uploaded_file($_FILES["video"]["tmp_name"], $target_file);
            }

            if ($_FILES['cv']['name']) {
                $target_dir = "cv_agents/";
                $target_file = $target_dir . basename($cv);
                move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file);
            }

            // Requête SQL de maj des infos dans la table agent 
            $sql_update = "UPDATE agent SET 
                nom='$nom', 
                prenom='$prenom', 
                specialite='$specialite', 
                photo='$photo', 
                courriel='$courriel', 
                numero_tel='$numero_tel', 
                bureau='$bureau', 
                video='$video', 
                cv='$cv', 
                mot_de_passe='$mot_de_passe' 
                WHERE id_agent=$agent_id";

            if ($conn->query($sql_update) === TRUE) {
                echo "Informations de l'agent mises à jour avec succès.";
            } else {
                echo "Erreur lors de la mise à jour des informations: " . $conn->error;
            }
        }

        $conn->close();
        ?>

        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>">
            <div class="form-group">
                <label for="nom">Nom:</label>
                <input type="text" id="nom" name="nom" value="<?php echo $nom; ?>" required>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom:</label>
                <input type="text" id="prenom" name="prenom" value="<?php echo $prenom; ?>" required>
            </div>
            <div class="form-group">
                <label for="specialite">Spécialité:</label>
                <input type="text" id="specialite" name="specialite" value="<?php echo $specialite; ?>" required>
            </div>
            <div class="form-group">
                <label for="courriel">Courriel:</label>
                <input type="email" id="courriel" name="courriel" value="<?php echo $courriel; ?>" required>
            </div>
            <div class="form-group">
                <label for="numero_tel">Téléphone:</label>
                <input type="tel" id="numero_tel" name="numero_tel" value="<?php echo $numero_tel; ?>" required>
            </div>
            <div class="form-group">
                <label for="bureau">Bureau:</label>
                <input type="text" id="bureau" name="bureau" value="<?php echo $bureau; ?>" required>
            </div>
            <div class="form-group">
                <label for="mot_de_passe">Mot de passe:</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" value="<?php echo $mot_de_passe; ?>" required>
            </div>
            <div class="form-group">
                <label for="photo">Photo:</label>
                <input type="file" id="photo" name="photo">
                <input type="hidden" name="current_photo" value="<?php echo $photo; ?>">
            </div>
            <div class="form-group">
                <label for="video">Vidéo:</label>
                <input type="file" id="video" name="video">
                <input type="hidden" name="current_video" value="<?php echo $video; ?>">
            </div>
            <div class="form-group">
                <label for="cv">CV:</label>
                <input type="file" id="cv" name="cv">
                <input type="hidden" name="current_cv" value="<?php echo $cv; ?>">
            </div>

            <div class="form-group">
                <button type="submit" name="update_agent">Mettre à jour</button>
            </div>
        </form>
        <button onclick="modifierDispos()">Modifier Disponibilités</button>

        <script>
            function modifierDispos() {
                var agentId = <?php echo $agent_id; ?>;
                
                // lien vers la page de modif des dispos si buton clique
                window.location.href = 'modifier_dispos.php?agent_id=' + agentId;
            }
        </script>
    </div>
        </div>
        <div class="auth-footer">
            <form action="mon_compte_admin.php">
                <button type="submit">Retour</button>
            </form>
            <br><br>
        </div>
</body>
</html>
