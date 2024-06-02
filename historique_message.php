<?php
include 'wrapper.php';

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// Connexion BDD
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// vérification de recupération de l'identifiant du client 
if (!isset($_GET['id'])) {
    echo "ID du client non défini dans l'URL.";
    exit; 
}

$client_id = $_GET['id'];

// requête SQL pour recupérer les messages du client 
$sql = "SELECT communication.*, agent.prenom AS prenom_agent, agent.nom AS nom_agent
        FROM communication
        INNER JOIN agent ON communication.ID_agent = agent.ID_agent
        WHERE communication.ID_client = $client_id
        ORDER BY communication.ID_agent, communication.timestamp DESC"; 

$result = $conn->query($sql);

if ($result === false) {
    die("Erreur dans la requête SQL : " . $conn->error);
}

$conversations = [];
$agents = [];

// recupération du nom de l'agent qui envoie un message au client 
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $conversation_id = $row['ID_agent'];
        if (!isset($agents[$conversation_id])) {
            $agents[$conversation_id] = $row['prenom_agent'] . ' ' . $row['nom_agent'];
        }
        if (!isset($conversations[$conversation_id])) {
            $conversations[$conversation_id] = [
                'nom_agent' => $agents[$conversation_id],
                'messages' => []
            ];
        }
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
        .encadrement {
            border-bottom: 1px solid #ccc;
        }
        .principal {
            display: flex;
            flex: 1;
            height: calc(100vh - 50px); 
        }
        .barre-laterale {
            width: 200px;
            border-right: 1px solid #ccc;
            padding: 10px;
            overflow-y: auto;
        }
        .barre-laterale ul {
            list-style: none; 
            padding: 0;
            margin: 0;
        }
        .barre-laterale li {
            margin-bottom: 10px;
        }
        .barre-laterale button {
            width: 100%;
            padding: 10px;
            background-color: #f1f1f1;
            border: 1px solid #ccc;
            text-align: left;
            cursor: pointer;
            border-radius: 5px;
        }
        .contenu {
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
        .conteneur-formulaire {
            margin-top: 20px;
            display: flex;
            justify-content: center; 
        }
        .interieur-formulaire {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }
        textarea {
            width: 100%; 
            max-width: 500px; 
            margin-bottom: 10px; 
        }
        button[type="button"] {
            width: 100%;
            max-width: 100px; 
        }
    </style>
    <script>
        /* fonction permetant au bouton de fonctionner correctement */
        /* premier bouton qui permet d'afficher les conversations en javascript */
        function afficherConversation(conversationId) {
            var conversations = document.getElementsByClassName('conversation');
            for (var i = 0; i < conversations.length; i++) {
                conversations[i].style.display = 'none';
            }
            document.getElementById('conversation-' + conversationId).style.display = 'block';
        }
        /* bouton permettant d'envoyer un message à l'agent  */
        function envoyerMessage(conversationId) {
            var formulaire = document.getElementById('formulaire-' + conversationId);
            var formData = new FormData(formulaire);

            fetch('send_message_client.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var conteneurMessage = document.createElement('div');
                    conteneurMessage.classList.add('message', 'client');
                    conteneurMessage.innerHTML = `<strong>Vous:</strong><p>${data.message}</p><span>${data.timestamp}</span>`;
                    var elementConversation = document.getElementById('conversation-' + conversationId);
                    elementConversation.insertBefore(conteneurMessage, formulaire.parentNode);
                    formulaire.reset();
                } 
            })
        }
    </script>
</head>
<body>
    <!-- contenu du corp de la page html -->
    <div class="encadrement">
    </div>
    <div class="principal">
        <div class="barre-laterale">
            <h3>Agents</h3>
            <ul>
                <?php foreach ($agents as $conversation_id => $nom_complet_agent): ?>
                    <li>
                        <button onclick="afficherConversation(<?php echo $conversation_id; ?>)">
                            <?php echo $nom_complet_agent; ?>
                        </button>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="contenu">
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
                        <div class="conteneur-formulaire">
                            <div class="interieur-formulaire">
                                <form id="formulaire-<?php echo $conversation_id; ?>" action="send_message_client.php" method="POST">
                                    <input type="hidden" name="id_client" value="<?php echo $client_id; ?>">
                                    <input type="hidden" name="id_agent" value="<?php echo $conversation_id; ?>">
                                    <textarea name="message" rows="4" cols="50" required></textarea><br>
                                    <button type="button" onclick="envoyerMessage(<?php echo $conversation_id; ?>)">Envoyer</button>
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
