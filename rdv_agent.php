<?php 
include 'wrapper.php';
//connexion 
if (!isset($_SESSION['utilisateur']['id_agent'])) {
    header("Location: form.php");
    exit();
}

$id_client = $_SESSION['utilisateur']['courriel'];

if (!isset($_GET['id_agent'])) {
    echo "ID de l'agent manquant dans l'URL.";
    exit();
}

$id_agent = $_GET['id_agent'];


include 'db.php';

// Requête pour récupérer les rendez-vous de l'agent actuellement connecté
$sql = "SELECT rdv.id, rdv.date, rdv.heure, 
        IFNULL(rdv.adresse, 'Indisponible') AS adresse, 
        IFNULL(rdv.autres_infos, 'Indisponible') AS autres_infos, 
        client.nom AS nom_client, client.prenom AS prenom_client 
        FROM rdv 
        JOIN client ON rdv.courriel_client = client.courriel 
        WHERE rdv.id_agent = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_agent);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <style>
        
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
        }
        .rdv-container {
            width: 100%;
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .rdv {
            background-color: #f9f9f9;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
        }
        h2 {
            color: #007bff;
            margin-bottom: 10px;
        }
        p {
            margin: 5px 0;
        }
        .edit-button {
            font-size: 14px;
            color: white;
            background-color: #28a745;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .edit-button:hover {
            background-color: #218838;
        }
        .complete-button {
            font-size: 14px;
            color: white;
            background-color: #007bff;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .complete-button:hover {
            background-color: #0056b3;
        }
        .cancel-button {
            font-size: 14px;
            color: white;
            background-color: #dc3545;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        .cancel-button:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="rdv-container">
        <h1>Rendez-vous</h1>
        <?php
        
        if ($result->num_rows > 0) {
            // Affichage des rendez-vous
            $count = 1;
            while ($row = $result->fetch_assoc()) {
                echo "<div class='rdv'>";
                echo "<h2>Rendez-vous $count</h2>";
                echo "<p>Client: " . htmlspecialchars($row['prenom_client']) . " " . htmlspecialchars($row['nom_client']) . "</p>";
                echo "<p>Date: " . htmlspecialchars($row['date']) . "</p>";
                echo "<p>Heure: " . htmlspecialchars($row['heure']) . "</p>";
                echo "<p>Adresse: " . htmlspecialchars($row['adresse']) . "</p>";
                echo "<p>Autres informations: " . htmlspecialchars($row['autres_infos']) . "</p>";
                echo "<a href='ajouter_infos.php?id_rdv=" . urlencode($row['id']) . "' class='edit-button'>Modifier les informations du rendez-vous</a>";
                echo "<a href='rdv_effectue.php?id_rdv=" . urlencode($row['id']) . "' class='complete-button'>Rendez-vous effectué</a>";
                echo "<a href='supprimer_rdv.php?id_rdv=" . (isset($row['id']) ? urlencode($row['id']) : '') . "' class='cancel-button'>Annuler</a>";
                echo "</div>";
                echo "<hr>";
                $count++;
            }
        } else {
            echo "<p>Aucun rendez-vous trouvé pour cet agent.</p>";
        }

       
        $stmt->close();
        $conn->close();
        ?>
    </div>

    <script>
        function confirmRdvEffectue(idRdv) {
            if (confirm("Êtes-vous sûr de vouloir marquer ce rendez-vous comme effectué ?")) {
                window.location.href = 'rdv_agent.php?rdv_effectue=true&id_rdv=' + idRdv;
            }
        }
    </script>
</body>
</html>
