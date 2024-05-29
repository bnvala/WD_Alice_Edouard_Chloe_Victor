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
        function bookSlot(id_agent, jour, creneau) {
            if (confirm("Voulez-vous confirmer la réservation pour " + jour + " " + creneau + "?")) {
                window.location.href = 'reserver.php?id_agent=' + id_agent + '&jour=' + jour + '&creneau=' + creneau;
            }
        }
    </script>
</head>
<body>
    <?php
    include 'db.php';

    $id_agent = $_GET['id'];
    $sql = "SELECT * FROM dispo_agents WHERE id_agent = $id_agent";
    $result = $conn->query($sql);

    $dispo_data = [];
    while ($row = $result->fetch_assoc()) {
        $dispo_data[$row["jour"]] = $row;
    }

    $days = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi"];
    ?>

    <div class="schedule">
        <h1>Prendre un RDV</h1>
        <table>
            <thead>
                <tr>
                    <th></th>
                    <?php foreach ($days as $day) { echo "<th>$day</th>"; } ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>AM</th>
                    <?php foreach ($days as $day) {
                        $dispo = isset($dispo_data[$day]) ? $dispo_data[$day]["AM"] : 1;
                        $status_class = $dispo ? 'available' : 'unavailable';
                        echo '<td class="' . $status_class . '" onclick="bookSlot(' . $id_agent . ', \'' . $day . '\', \'AM\')"></td>';
                    } ?>
                </tr>
                <tr>
                    <th>PM</th>
                    <?php foreach ($days as $day) {
                        $dispo = isset($dispo_data[$day]) ? $dispo_data[$day]["PM"] : 1;
                        $status_class = $dispo ? 'available' : 'unavailable';
                        echo '<td class="' . $status_class . '" onclick="bookSlot(' . $id_agent . ', \'' . $day . '\', \'PM\')"></td>';
                    } ?>
                </tr>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
