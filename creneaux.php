<!DOCTYPE html>
<html lang="en">
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
            pointer-events: none;
        }
        .reserved {
            background-color: blue;
            color: #fff;
            pointer-events: none;
        }
        .available {
            background-color: #fff;
            cursor: pointer;
        }
        .available:hover {
            background-color: #ddd;
        }
    </style>
    <script>
        function bookSlot(id_agent, jour, heure) {
            if (confirm("Voulez-vous confirmer la réservation pour " + jour + " à " + heure + "?")) {
                window.location.href = 'reserver.php?id_agent=' + id_agent + '&jour=' + jour + '&heure=' + heure;
            }
        }
    </script>
</head>
<body>
    <?php
    include 'db.php';

    $id_agent = $_GET['id'];
    $sql = "SELECT * FROM dispo_agents_heure_par_heure WHERE id_agent = $id_agent";
    $result = $conn->query($sql);

    $dispo_data = [];
    while ($row = $result->fetch_assoc()) {
        $dispo_data[$row["jour"]][$row["heure"]] = $row["dispo"];
    }

    $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
    $hours = ["10:00:00", "11:00:00", "12:00:00", "13:00:00", "14:00:00", "15:00:00", "16:00:00", "17:00:00"];
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
                <?php foreach ($hours as $hour) { ?>
                <tr>
                    <th><?php echo $hour; ?></th>
                    <?php foreach ($days as $day) {
                        $dispo = isset($dispo_data[$day][$hour]) ? $dispo_data[$day][$hour] : 0;
                        $status_class = $dispo ? 'available' : 'unavailable';
                        echo '<td class="' . $status_class . '" onclick="bookSlot(' . $id_agent . ', \'' . $day . '\', \'' . $hour . '\')"></td>';
                    } ?>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
