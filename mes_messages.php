<?php
include 'wrapper.php';

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

// Vérifie si l'ID de l'agent est défini dans l'URL
if (!isset($_GET['id_agent'])) {
    echo "ID de l'agent non défini dans l'URL.";
    exit; // Arrête le script
}

$agent_id = $_GET['id_agent'];

// Récupérer toutes les communications de l'agent
$sql = "SELECT communication.*, client.nom AS nom_client
        FROM communication
        INNER JOIN client ON communication.ID_client = client.id
        WHERE communication.ID_agent = $agent_id
        ORDER BY communication.ID_client, communication.timestamp DESC";

$result = $conn->query($sql);

if ($result === false) {
    echo "Erreur lors de l'exécution de la requête : " . $conn->error;
    exit;
}

$conversations = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $conversation_id = $row['ID_client'];
        // Créer une nouvelle conversation ou ajouter un message à une conversation existante
        if (!isset($conversations[$conversation_id])) {
            $conversations[$conversation_id] = [
                'nom_client' => $row['nom_client'],
                'messages' => []
            ];
        }
        $conversations[$conversation_id]['messages'][] = $row;
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
        /* Vos styles CSS ici */
    </style>
</head>
<body>
    <h2>Conversations de l'Agent</h2>
    <?php if (empty($conversations)): ?>
        <p>Aucune conversation trouvée pour cet agent.</p>
    <?php else: ?>
        <?php foreach ($conversations as $conversation_id => $conversation): ?>
            <div class="conversation">
                <h3>Conversation avec <?php echo $conversation['nom_client']; ?></h3>
                <?php foreach ($conversation['messages'] as $message): ?>
                    <div class="message">
                        <strong><?php echo $conversation['nom_client']; ?>:</strong>
                        <p><?php echo htmlspecialchars($message['message']); ?></p>
                        <span><?php echo $message['timestamp']; ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</body>
</html>
