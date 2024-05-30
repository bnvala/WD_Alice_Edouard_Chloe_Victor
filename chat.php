<?php
include 'wrapper.php';

if (!isset($_SESSION['utilisateur'])) {
    // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
    echo "<script>window.location.href = 'form.php';</script>";
    exit;
}

$utilisateur = $_SESSION['utilisateur'];
$id_client = $utilisateur['id'];

// Récupérer l'ID de l'agent depuis l'URL
$id_agent = isset($_GET['id']) ? $_GET['id'] : null;

// Vérifier que l'ID de l'agent est présent
if (!$id_agent) {
    die("ID de l'agent manquant.");
}

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

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $message = $_POST['message'];

    // Requête SQL pour insérer la communication dans la base de données
    $stmt = $conn->prepare("INSERT INTO communication (ID_client, ID_agent, message) VALUES (?, ?, ?)");
    $stmt->bind_param("iis", $id_client, $id_agent, $message);

    if ($stmt->execute()) {
        echo "Message envoyé avec succès.";
    } else {
        echo "Erreur : " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat avec l'Agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
            margin: 0;
        }
        .chat-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
            margin: 20px;
            display: flex;
            flex-direction: column;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group textarea {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            resize: vertical;
            height: 100px;
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
    </style>
</head>
<body>
    <?php include 'wrapper.php'; ?>
    <div class="chat-container">
        <form method="post">
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit">Envoyer le Message</button>
            </div>
        </form>
    </div>
</body>
</html>
