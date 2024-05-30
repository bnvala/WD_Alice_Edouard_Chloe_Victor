<?php 
include 'wrapper.php';

// Vérifier si l'agent est connecté
if (!isset($_SESSION['agent']['id'])) {
    header("Location: form.php");
    exit();
}

$id_agent = $_SESSION['agent']['id'];

// Connexion à la base de données (supposons que vous ayez déjà une connexion dans wrapper.php)
include 'db.php';

// Requête pour récupérer les rendez-vous de l'agent actuellement connecté
$sql = "SELECT * FROM rdv WHERE id_agent = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_agent);
$stmt->execute();
$result = $stmt->get_result();

// Vérifier s'il y a des rendez-vous
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
        echo "</div>";
        echo "<hr>";
        $count++;
    }
} else {
    echo "<h1>Rendez-vous</h1>";
    echo "Aucun rendez-vous trouvé pour cet agent.";
}

// Fermer la connexion et le statement
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
        /* Style CSS pour les rendez-vous */
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
    <!-- Aucun contenu HTML ici, tout est généré par PHP -->
</body>
</html>
