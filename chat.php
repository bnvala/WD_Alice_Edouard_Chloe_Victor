<?php
include 'wrapper.php';

// Détruire la session existante pour réinitialiser la conversation
session_destroy();
session_start();

// Initialiser la session pour stocker les messages
$_SESSION['messages'] = [];
// Ajouter le message de bienvenue
$_SESSION['messages'][] = ['sender' => 'Bot', 'text' => 'Bonjour, veuillez poser votre question, un agent vous répondra dans les plus brefs délais.'];

// Fonction pour ajouter un message à la session
function add_message($sender, $text) {
    $_SESSION['messages'][] = ['sender' => $sender, 'text' => $text];
}

// Fonction pour générer une réponse automatique
function generate_response() {
    return "Votre message a bien été transmis à l'agent, il vous répondra dès que possible.";
}

// Si un message a été envoyé, ajouter le message et générer une réponse
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['message'])) {
    $message = htmlspecialchars($_POST['message']);
    add_message('Vous', $message);

    // Générer et ajouter la réponse automatique
    $response = generate_response();
    add_message('Bot', $response);
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
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
            width: 80%;
            max-width: 600px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .messages {
            max-height: 400px;
            overflow-y: auto;
            margin-bottom: 20px;
        }
        .message {
            margin-bottom: 10px;
        }
        .message.you {
            text-align: right;
        }
        .message.bot {
            text-align: left;
        }
        .message p {
            display: inline-block;
            padding: 10px;
            border-radius: 5px;
            max-width: 70%;
        }
        .message.you p {
            background-color: #e1ffc7;
        }
        .message.bot p {
            background-color: #ffe1e1;
        }
        .chat-form {
            display: flex;
            width: 100%;
        }
        .chat-form input[type="text"] {
            flex: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .chat-form input[type="submit"] {
            padding: 10px 20px;
            border: none;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            margin-left: 10px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="chat-container">
        <div class="messages">
            <?php foreach ($_SESSION['messages'] as $message): ?>
                <div class="message <?php echo $message['sender'] === 'Vous' ? 'you' : 'bot'; ?>">
                    <p><?php echo $message['text']; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
        <form class="chat-form" action="chat.php" method="POST">
            <input type="text" name="message" placeholder="Écrivez votre message..." required>
            <input type="submit" value="Envoyer">
        </form>
    </div>
</body>
</html>
