<?php
// entete 
include 'wrapper.php';

// mdp connexion BDD
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// Connexion BDD
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// vérifaction recupération ID client 
if (!isset($_GET['id_agent'])) {
    echo "ID de l'agent non défini dans l'URL.";
    exit; // Arrête le script
}

$agent_id = $_GET['id_agent'];

// requete SQL information agent 
$sql = "SELECT communication.*, client.prenom AS prenom_client, client.nom AS nom_client
        FROM communication
        INNER JOIN client ON communication.ID_client = client.id
        WHERE communication.ID_agent = $agent_id
        ORDER BY communication.ID_client, communication.timestamp DESC"; 

$result = $conn->query($sql);

$conversations = [];
$clients = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $conversation_id = $row['ID_client'];
        if (!isset($clients[$conversation_id])) {
            $clients[$conversation_id] = $row['prenom_client'] . ' ' . $row['nom_client'];
        }
       // nouvelle conversation si non existante 
        if (!isset($conversations[$conversation_id])) {
            $conversations[$conversation_id] = [
                'nom_client' => $clients[$conversation_id],
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
    <title>Conversations de l'Agent</title>
    <style>
          /* style de la page en css*/
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
        .formulaire-conteneur {
            margin-top: 20px;
            display: flex;
            justify-content: center; 
        }
        .formulaire-interieur {
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
        /* fonction en javascript*/
        /* bouton pour afficher la conversation avec le client */
        function afficherConversation(conversationId) {
            var conversations = document.getElementsByClassName('conversation');
            for (var i = 0; i < conversations.length; i++) {
                conversations[i].style.display = 'none';
            }
            document.getElementById('conversation-' + conversationId).style.display = 'block';
        }
        /* bouton pour repondre au client  */
        function envoyerMessage(conversationId) {
            var formulaire = document.getElementById('formulaire-' + conversationId);
            var formData = new FormData(formulaire);

            fetch('send_message.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    var conteneurMessage = document.createElement('div');
                    conteneurMessage.classList.add('message', 'agent');
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
            <h3>Clients</h3>
            <ul>
                <?php foreach ($clients as $conversation_id => $nom_complet_client): ?>
                    <li><button onclick="afficherConversation(<?php echo $conversation_id; ?>)"><?php echo $nom_complet_client; ?></button></li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="contenu">
            <h2>Conversations de l'Agent</h2>
            <?php if (empty($conversations)): ?>
                <p>Aucune conversation trouvée pour cet agent.</p>
            <?php else: ?>
                <?php foreach ($conversations as $conversation_id => $conversation): ?>
                    <div id="conversation-<?php echo $conversation_id; ?>" class="conversation" style="display: none;">
                        <h3>Conversation avec <?php echo $conversation['nom_client']; ?></h3>
                        <?php foreach ($conversation['messages'] as $message): ?>
                            <div class="message <?php echo $message['envoyeur'] == 'agent' ? 'agent' : 'client'; ?>">
                                <strong><?php echo $message['envoyeur'] == 'agent' ? 'Vous' : $conversation['nom_client']; ?>:</strong>
                                <p><?php echo htmlspecialchars($message['message']); ?></p>
                                <span><?php echo $message['timestamp']; ?></span>
                            </div>
                        <?php endforeach; ?>
                        <div class="formulaire-conteneur">
                            <div class="formulaire-interieur">
                                <form id="formulaire-<?php echo $conversation_id; ?>" action="send_message.php" method="POST">
                                    <input type="hidden" name="id_agent" value="<?php echo $agent_id; ?>">
                                    <input type="hidden" name="id_client" value="<?php echo $conversation_id; ?>">
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
