<?php
include 'wrapper.php';

// Vérifier si l'agent est connecté
if (!isset($_SESSION['utilisateur']['id_agent'])) {
    header("Location: form.php");
    exit();
}

// Récupérer l'id_agent passé en paramètre d'URL ou à partir de la session
$id_agent = isset($_GET['id_agent']) ? urldecode($_GET['id_agent']) : $_SESSION['utilisateur']['id'];
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique des Consultations</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 800px;
            margin: auto;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #007bff;
            color: white;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Historique des Consultations</h1>
        <?php
        // Informations de connexion à la base de données
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pj_piscine";

        // Connexion à la base de données
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }

        // Requête SQL pour récupérer les consultations de l'agent connecté
        $sql = "SELECT c.id, c.courriel_client, , c.date_consultation 
                FROM consultations c 
                JOIN biens b ON c.id_bien = b.id
                WHERE b.id_agent = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_agent);
        $stmt->execute();
        $result = $stmt->get_result();

        // Vérifier s'il y a des résultats
        if ($result->num_rows > 0) {
            echo '<table>';
            echo '<tr><th>ID Consultation</th><th>ID Client</th><th>ID Bien</th><th>Date Consultation</th></tr>';

            // Afficher les données pour chaque ligne
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id_consultation"] . '</td>';
                echo '<td>' . $row["id_client"] . '</td>';
                echo '<td>' . $row["id_bien"] . '</td>';
                echo '<td>' . $row["date_consultation"] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Aucune consultation trouvée.</p>";
        }

        // Fermer la connexion
        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
