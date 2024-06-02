<?php
include 'wrapper.php';

// verification de la connexion
if (!isset($_SESSION['utilisateur']['id_agent'])) {
    header("Location: form.php");
    exit();
}

// recup de l'id_agent sur la session
$id_agent = isset($_GET['id_agent']) ? urldecode($_GET['id_agent']) : $_SESSION['utilisateur']['id_agent'];
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
        
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "pj_piscine";

        // Connexion bdd
        $conn = new mysqli($servername, $username, $password, $dbname);

       
        if ($conn->connect_error) {
            die("Échec de la connexion : " . $conn->connect_error);
        }

        //recuperation des consult de lagent 
        $sql = "SELECT id, courriel_client, date, heure, id_agent FROM consultations WHERE id_agent = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id_agent);
        $stmt->execute();
        $result = $stmt->get_result();

        
        if ($result->num_rows > 0) {
            // creation du tab
            echo '<table>';
            echo '<tr><th>ID Consultation</th><th>Courriel Client</th><th>Date</th><th>Heure</th></tr>';

            // affichage des donnee dans le tab
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row["id"] . '</td>';
                echo '<td>' . $row["courriel_client"] . '</td>';
                echo '<td>' . $row["date"] . '</td>';
                echo '<td>' . $row["heure"] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo "<p>Aucune consultation trouvée.</p>";
        }

        $stmt->close();
        $conn->close();
        ?>
    </div>
</body>
</html>
