<?php 
include 'wrapper.php';

// connexion
if (!isset($_SESSION['utilisateur']['id'])) {
    header("Location: form.php");
    exit();
}

$id_client = $_SESSION['utilisateur']['courriel'];

include 'db.php';

// Requête pour récupérer les rendez-vous du client actuellement connecté
$sql = "SELECT * FROM rdv WHERE courriel_client = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $id_client);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "<h1>Rendez-vous</h1>";
    // Affichage des rendez-vous
    $count = 1;
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h2>Rendez-vous $count</h2>";
        echo "<p>Date: " . $row['date'] . "</p>";
        echo "<p>Heure: " . $row['heure'] . "</p>";
        echo "<p>Adresse: " . $row['adresse'] . "</p>";
        echo "<p>Durée: " . $row['duree'] . " minutes</p>";
        // Bouton d'annulation de rendez-vous
        echo "<form action='supprimer_rdv.php' method='get'>";
        echo "<input type='hidden' name='id_rdv' value='" . urlencode($row['id']) . "'>";
        echo "<input type='submit' value='Annuler le rendez-vous'>";
        echo "</form>";
        

        echo "</div>";
        echo "<hr>";
        $count++;
    }
} else {
    echo "<h1>Rendez-vous</h1>";
    echo "Aucun rendez-vous trouvé.";
}

$stmt->close();
$conn->close();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rendez-vous</title>
    <style>
        h1 {
            text-align: center;
        }
        div {
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
    </style>
</head>
<body>
</body>
</html>
