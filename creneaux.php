<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prendre un RDV</title>
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
        .schedule {
            text-align: center;
        }
        .schedule table {
            margin: auto;
            width: 70%;
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
        .available {
            background-color: blue;
            color: #fff;
        }
        .unavailable {
            background-color: black;
            color: #fff;
        }
    </style>
</head>
<body>
    <?php
    include 'db.php';

    $id_agent = $_GET['id'];
    $sql = "SELECT * FROM dispo_agents_heure_par_heure WHERE id_agent = $id_agent";
    $result = $conn->query($sql);

    if ($result === false) {
        echo "Erreur lors de l'exécution de la requête SQL : " . $conn->error;
        exit;
    }

    $dispo_data = [];
    while ($row = $result->fetch_assoc()) {
        $dispo_data[$row["heure"]][$row["jour"]] = $row["dispo"];
    }

    $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
    ?>

    <div class="schedule">
        <h1>Prendre un RDV</h1>
        <table>
            <thead>
                <tr>
                    <th>Heure</th>
                    <?php foreach ($days as $day) { echo "<th>$day</th>"; } ?>
                </tr>
            </thead>
            <tbody>
                <?php 
                $hours = ["09:00", "09:30", "10:00", "10:30", "11:00", "11:30", "12:00", "14:00", "14:30", "15:00", "15:30", "16:00", "16:30", "17:00", "17:30", "18:00"];
                foreach ($hours as $hour) { ?>
                    <tr>
                        <th><?php echo $hour; ?></th>
                        <?php foreach ($days as $day) {
                            $dispo = isset($dispo_data[$hour][$day]) ? $dispo_data[$hour][$day] : null;
                            $status_class = $dispo ? 'available' : 'unavailable';
                            echo '<td class="' . $status_class . '">' . ($dispo ? 'Disponible' : 'Non disponible') . '</td>';
                        } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
