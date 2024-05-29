<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communiquer avec l'agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .communication-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 700px;
            padding: 20px;
            text-align: center;
        }
        .buttons {
            text-align: center;
            margin-top: 20px;
        }
        .buttons button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            margin: 5px;
            border-radius: 5px;
            cursor: pointer;
        }
        .buttons button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    // Inclure le fichier de connexion à la base de données
    include 'db.php';

    // Récupérer l'ID de l'agent depuis l'URL
    $id = $_GET['id'];

    // Requête pour obtenir les informations de l'agent
    $sql = "SELECT * FROM agent WHERE id_agent = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Récupérer les informations de l'agent
        $agent = $result->fetch_assoc();
    ?>

    <div class="communication-card">
        <h2>Communiquer avec l'agent</h2>
        <div class="buttons">
            <button onclick="window.location.href='chat.php?id=<?php echo $id; ?>'">Chatter avec l'agent</button>
            <button onclick="window.location.href='mailto:<?php echo $agent["courriel"]; ?>'">Envoyer un mail à l'agent</button>
            <button onclick="launchAudioCall()">Appel audio</button>
            <button onclick="launchVideoCall()">Appel vidéo</button>
        </div>
    </div>

    <?php
    } else {
        echo "No agent found";
    }

    // Fermer la connexion à la base de données
    $conn->close();
    ?>

    <script>
        function launchAudioCall() {
            if (confirm("Voulez-vous vraiment lancer un appel audio ?")) {
                // Code pour lancer l'appel audio ici
                alert("L'appel audio est lancé !");
            }
        }

        function launchVideoCall() {
            if (confirm("Voulez-vous vraiment lancer un appel vidéo ?")) {
                // Code pour lancer l'appel vidéo ici
                alert("L'appel vidéo est lancé !");
            }
        }
    </script>
</body>
</html>
