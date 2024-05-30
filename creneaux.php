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
            cursor: pointer;
        }
        .unavailable {
            background-color: black;
            color: #fff;
        }
        .available:hover {
            background-color: #0066cc;
        }
    </style>
    <script>
        function bookSlot(id_agent, jour, heure) {
            if (confirm("Voulez-vous confirmer la réservation pour " + jour + " " + heure + "?")) {
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

    if ($result === false) {
        echo "Erreur lors de l'exécution de la requête SQL : " . $conn->error;
        exit;
    }

    $dispo_data = [];
    while ($row = $result->fetch_assoc()) {
        $dispo_data[$row["jour"]][$row["heure"]] = $row["dispo"];
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
                <?php for ($hour = 10; $hour <= 17; $hour++) { ?>
                    <tr>
                        <th><?php echo $hour . "h"; ?></th>
                        <?php foreach ($days as $day) {
                            if(isset($dispo_data[$day][$hour])){
                                $dispo = $dispo_data[$day][$hour]; // Si défini, récupérer la disponibilité
                                $status_class = $dispo ? 'available' : 'unavailable';
                            } else {
                                $dispo = null; // Si non défini, considérer comme indisponible (0)
                                $status_class = 'unavailable';
                            }
                            $content = $dispo === null ? 'R' : ($dispo ? 'O' : 'X');
                            echo '<td class="' . $status_class . '" onclick="bookSlot(' . $id_agent . ', \'' . $day . '\', \'' . $hour . 'h\')">' . $content . '</td>';
                        } ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <?php $conn->close(); ?>
</body>
</html>
