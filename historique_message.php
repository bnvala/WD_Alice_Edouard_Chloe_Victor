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

// Vérifie si l'ID du client est défini dans l'URL
if (!isset($_GET['id'])) {
    echo "ID du client non défini dans l'URL.";
    exit; // Arrête le script
}

$client_id = $_GET['id'];

// Récupérer toutes les communications du client
$sql = "SELECT communication.*, agent.prenom AS prenom_agent, agent.nom AS nom_agent
        FROM communication
        INNER JOIN agent ON communication.ID_agent = agent.ID_agent
        WHERE communication.ID_client = $client_id
        ORDER BY communication.ID_agent, communication.timestamp DESC"; // Ordre DESC pour les messages les plus récents en premier

$result = $conn->query($sql);

// Vérifier si la requête a réussi
if ($result === false) {
    die("Erreur dans la requête SQL : " . $conn->error);
}

$conversations = [];
$agents = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $conversation_id = $row['ID_agent'];
        if (!isset($agents[$conversation_id])) {
            $agents[$conversation_id] = $row['prenom_agent'] . ' ' . $row['nom_agent'];
        }
        // Créer une nouvelle conversation ou ajouter un message à une conversation existante
        if (!isset($conversations[$conversation_id])) {
            $conversations[$conversation_id] = [
                'nom_agent' => $agents[$conversation_id],
                'messages' => []
            ];
        }
        // Ajouter les messages au début de la liste pour les afficher dans l'ordre chronologique inverse
        array_unshift($conversations[$conversation_id]['messages'], $row);
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Conversations du Client</title>
    <style>
        body {
            display: flex;
            flex-direction: column;
            margin: 0;
        }
        .wrapper {
            border-bottom: 1px solid #ccc;
        }
        .main {
            display: flex;
            flex: 1;
            height: calc(100vh - 50px); /* Adjust according to the height of your wrapper */
        }
        .sidebar {
            width: 200px;
            border-right: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
        }
        .sidebar ul {
            list-style: none; /* Remove bullets */
            padding: 0;
            margin: 0;
        }
        .sidebar li {
            margin-bottom: 10px;
        }
        .sidebar button {
            width: 100%;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            text-align: left;
            cursor: pointer;
            border-radius: 5px;
        }
        .content {
            flex: 1;
            padding: 10px;
            overflow-y: auto;
        }
        .conversation {
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 5px;
        }
        .message.client {
            background-color: #f1f1f1;
            text-align: left;
            margin-right: auto;
            max-width: 60%;
        }
        .message.agent {
            background-color: #d1e7dd;
            text-align: right;
            margin-left: auto;
            max-width: 60%;
        }
        .form-container {
            margin-top: 20px;
            display: flex;
            justify-content: center; /* Center the container horizontally */
        }
        .form-inner {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        textarea {
            width: 100%; /* Adjust width as necessary */
            max-width: 500px; /* Set a max width for the textarea */
            margin-bottom: 10px; /* Space between textarea and button */
        }
        button[type="button"] {
            width: 100%;
            max-width: 100px; /* Set a max width for the button */
        }
    </style>
    <script>
        function showConversation(conversationId) {
            var conversations = document.getElementsByClassName('conversation');
            for (var i = 0; i < conversations.length; i++) {
                conversations[i].style.display = 'none';
            }
            document.getElementById('conversation-' + conversationId).style.display = 'block';
        }

        function sendMessage(conversationId) {
            var form = document.getElementById('form-' + conversationId);
            var formData = new FormData(form);

            fetch('send_message_client.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var messageContainer = document.createElement('div');
                    messageContainer.classList.add('message', 'client');
                    messageContainer.innerHTML = `<strong>Vous:</strong><p>${data.message}</p><span>${data.timestamp}</span>`;
                    var conversationElement = document.getElementById('conversation-' + conversationId);
                    conversationElement.insertBefore(messageContainer, form.parentNode);
                    form.reset();
                }});
        }
    </script>
</head>
<body>
    <div class="wrapper">
        <!-- Le contenu du wrapper sera inclus ici -->
    </div>
    <div class="main">
        <div class="sidebar">
            <h3>Agents</h3>
            <ul>
                <?php foreach ($agents as $conversation_id => $nom_complet_agent): ?>
                    <li>
                        <button onclick="showConversation(<?php echo $conversation_id; ?>)">
                            <?php echo $nom_complet_agent; ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="content">
            <h2>Conversations du Client</h2>
            <?php if (empty($conversations)): ?>
                <p>Aucune conversation trouvée pour ce client.</p>
            <?php else: ?>
                <?php foreach ($conversations as $conversation_id => $conversation): ?>
                    <div id="conversation-<?php echo $conversation_id; ?>" class="conversation" style="display: none;">
                        <h3>Conversation avec <?php echo $conversation['nom_agent']; ?></h3>
                        <?php foreach ($conversation['messages'] as $message): ?>
                            <div class="message <?php echo $message['envoyeur'] == 'client' ? 'client' : 'agent'; ?>">
                                <strong><?php echo $message['envoyeur'] == 'client' ? 'Vous' : $conversation['nom_agent']; ?>:</strong>
                                <p><?php echo htmlspecialchars($message['message']); ?></p>
                                <span><?php echo $message['timestamp']; ?></span>
                            </div>
                        <?php endforeach; ?>
                        <div class="form-container">
                            <div class="form-inner">
                                <form id="form-<?php echo $conversation_id; ?>" action="send_message_client.php" method="POST">
                                    <input type="hidden" name="id_client" value="<?php echo $client_id; ?>">
                                    <input type="hidden" name="id_agent" value="<?php echo $conversation_id; ?>">
                                    <textarea name="message" rows="4" cols="50" required></textarea><br>
                                    <button type="button" onclick="sendMessage(<?php echo $conversation_id; ?>)">Envoyer</button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
