<?php include 'wrapper.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Communiquer avec l'agent</title>
    <style>

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
    include 'db.php';

    // prendre id depuis url 
    $id = $_GET['id'];

    // infos de lagent
    $sql = "SELECT * FROM agent WHERE id_agent = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $agent = $result->fetch_assoc();
    ?>

    <div class="communication-card">
        <h2>Communiquer avec l'agent</h2>
        <div class="buttons">
             <!-- boutons pour differents choix qui envoient vers d'autres pages  -->
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

    $conn->close();
    ?>

    <script>
        function launchAudioCall() {
            if (confirm("Voulez-vous vraiment lancer un appel audio ?")) {
                //renvo vers lien teams 
                window.location.href = 'https://teams.live.com/l/invite/FEAL8HUGO780vvGBAE';
            }
        }

        function launchVideoCall() {
            if (confirm("Voulez-vous vraiment lancer un appel vidéo ?")) {
                window.location.href = 'https://teams.live.com/l/invite/FEAL8HUGO780vvGBAE';
                //renvoi vers lien teams 
            }
        }
    </script>
</body>
</html>
