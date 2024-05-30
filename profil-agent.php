<?php include 'wrapper.php'; ?>
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
            width: 1000px;
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
        $photo_dimension = ($id >= 1 && $id <= 4) ? ' width="120" height="150"' : ' width="150" height="150"';
        echo '<img src="photos_agents/' . $agent["photo"] . '" alt="Photo de l\'agent" class="photo-agent"' . $photo_dimension . '>';
        echo '<div class="info">';
        echo '<div><strong>Name:</strong> ' . $agent["prenom"] . ' ' . $agent["nom"] . '</div>';
        echo '<div><strong>Email:</strong> ' . $agent["courriel"] . '</div>';
        echo '<div><strong>Téléphone:</strong> ' . $agent["numero_tel"] . '</div>';
        echo '</div></div>';

        $dispo_sql = "SELECT * FROM dispo_agents WHERE id_agent = $id";
        $dispo_result = $conn->query($dispo_sql);
        $dispo_data = [];
        while ($dispo_row = $dispo_result->fetch_assoc()) {
            $dispo_data[$dispo_row["jour"]] = $dispo_row;
        }

        $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];

        echo '<div class="schedule">';
        echo '<table>';
        echo '<thead><tr><th></th>';
        foreach ($days as $day) {
            echo "<th>$day</th>";
        }
        echo '</tr></thead>';
        echo '<tbody>';
        echo '<tr><th>AM</th>';
        foreach ($days as $day) {
            $availability = isset($dispo_data[$day]) ? $dispo_data[$day]["AM"] : 1;
            echo '<td' . ($availability ? '' : ' class="unavailable"') . '></td>';
        }
        echo '</tr>';
        echo '<tr><th>PM</th>';
        foreach ($days as $day) {
            $availability = isset($dispo_data[$day]) ? $dispo_data[$day]["PM"] : 1;
            echo '<td' . ($availability ? '' : ' class="unavailable"') . '></td>';
        }
        echo '</tr>';
        echo '</tbody></table>';
        echo '</div>';

        echo '<div class="buttons">';
        if (isset($_SESSION['utilisateur'])) {
            echo '<button onclick="window.location.href=\'creneaux.php?id=' . $id . '\'">Prendre un RDV</button>';
        } else {
            echo '<button onclick="window.location.href=\'formrdv.php?id=' . $id . '&redirect=creneaux.php?id=' . $id . '\'">Prendre un RDV</button>';
        }
        echo '<button onclick="window.location.href=\'communiquer.php?id=' . $id . '\'">Communiquer</button>';
        echo '<button onclick="window.open(\'cv_agents/' . $agent["cv"] . '\', \'_blank\')">Voir le CV</button>';
        echo '</div>';
        echo '</div>';
    } else {
        echo "No agent found";
    }

    $conn->close();
    ?>
</body>
</html>
