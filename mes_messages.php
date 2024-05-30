<?php
// Démarre la session
session_start();

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

// Vérifie si l'ID de l'agent est défini dans la session
if (!isset($_SESSION['utilisateur']['id'])) {
    echo "ID de l'agent non défini.";
    exit; // Arrête le script
}

$agent_id = $_SESSION['utilisateur']['id'];

// Récupérer toutes les conversations de l'agent avec les clients
$sql = "SELECT communication.*, utilisateur.nom AS nom_client
        FROM communication
        INNER JOIN utilisateur ON communication.ID_client = utilisateur.id
        WHERE ID_agent = $agent_id
        ORDER BY date_envoi DESC";
$result = $conn->query($sql);

$conversations = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $conversations[] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations de l'Agent</title>
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
        .conversation {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 600px;
            margin: 20px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
            background-color: #e9e9e9;
        }
        .message.agent {
            background-color: #c3e6cb;
            text-align: right;
        }
        .message.client {
            background-color: #d1ecf1;
        }
        .message p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <h2>Conversations de l'Agent</h2>
    <?php foreach ($conversations as $conversation): ?>
        <div class="conversation">
            <h3>Conversation avec <?php echo $conversation['nom_client']; ?></h3>
            <?php
            $conversation_id = $conversation['ID_client'];
            $sql = "SELECT * FROM communication WHERE (ID_agent = $agent_id AND ID_client = $conversation_id) OR (ID_agent = $conversation_id AND ID_client = $agent_id) ORDER BY date_envoi";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $message_class = $row['ID_client'] == $conversation_id ? 'client' : 'agent';
                    ?>
                    <div class="message <?php echo $message_class; ?>">
                        <strong><?php echo $message_class == 'client' ? $conversation['nom_client'] : 'Vous'; ?>:</strong>
                        <p><?php echo htmlspecialchars($row['message']); ?></p>
                        <span><?php echo $row['date_envoi']; ?></span>
                    </div>
                    <?php
                }
            } else {
                echo "<p>Aucun message dans cette conversation.</p>";
            }
            ?>
        </div>
    <?php endforeach; ?>
</body>
</html>
