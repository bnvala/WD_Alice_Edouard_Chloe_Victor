<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent Profile</title>
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
        .profile-card {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 700px;
            padding: 20px;
        }
        .profile-card .header {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .profile-card .header img {
            border-radius: 50%;
            margin-right: 20px;
        }
        .profile-card h2 {
            margin-top: 0;
        }
        .profile-card .info {
            margin-bottom: 20px;
        }
        .profile-card .info div {
            margin: 5px 0;
        }
        .schedule {
            margin-bottom: 20px;
            text-align: center;
        }
        .schedule table {
            width: 100%;
            border-collapse: collapse;
        }
        .schedule th, .schedule td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .schedule th {
            background-color: #f4f4f4;
        }
        .unavailable {
            background-color: #000;
            color: #fff;
        }
        .buttons {
            text-align: center;
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

    $id = $_GET['id'];
    $sql = "SELECT * FROM agent WHERE id_agent = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $agent = $result->fetch_assoc();
        echo '<div class="profile-card">';
        echo '<div class="header">';
        echo '<img src="' . $agent["photo"] . '" alt="Photo de l\'agent" class="photo-agent" width="160" height="200">';
        echo '<div class="info">';
        echo '<div><strong>Name:</strong> ' . $agent["prenom"] . $agent["nom"] .'</div>';
        echo '<div><strong>Email:</strong> ' . $agent["courriel"] . '</div>';
        echo '<div><strong>Téléphone:</strong> ' . $agent["numero_tel"] . '</div>';
        echo '</div></div>';
        echo '<div class="schedule">';
        echo '<table>';
        echo '<thead><tr><th></th><th>Lundi</th><th>Mardi</th><th>Mercredi</th><th>Jeudi</th><th>Vendredi</th></tr></thead>';
        echo '<tbody>';
        echo '<tr><th>AM</th><td></td><td class="unavailable"></td><td></td><td></td><td class="unavailable"></td></tr>';
        echo '<tr><th>PM</th><td></td><td></td><td class="unavailable"></td><td></td><td></td></tr>';
        echo '</tbody></table>';
        echo '</div>';
        echo '<div class="buttons">';
        echo '<button onclick="alert(\'Prendre RDV avec notre conseiller\')">Prendre un RDV</button>';
        echo '<button onclick="alert(\'Rentrer en communication avec notre agent\')">Communiquer</button>';
        echo '<button onclick="alert(\'Voir CV\')">Voir le CV</button>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "No agent found";
    }

    $conn->close();
    ?>
</body>
</html>
