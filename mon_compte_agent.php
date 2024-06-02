<?php
include 'wrapper.php';

if (!isset($_SESSION['utilisateur'])) {
    // verif connexion et page de connexion si pas connecte 
    echo "<script>window.location.href = 'form.php';</script>";
    exit;
}

$utilisateur = $_SESSION['utilisateur'];
$id_agent = $utilisateur['id_agent']; // Récuperation id_agent connecte mtn 

include 'db.php';
//dispo depuis bdd avec id_agent
$sql = "SELECT jour, heure, dispo FROM dispo_agents_heure_par_heure WHERE id_agent = $id_agent";
$result = $conn->query($sql);

$sql_creneau = "SELECT * FROM dispo_agents WHERE id_agent = $id_agent";
    $result_creneau = $conn->query($sql_creneau);

$dispo = array();
while ($row = $result->fetch_assoc()) {
    $dispo[$row['jour']][$row['heure']] = $row['dispo'];
}
//afficher les dispos 
$dispo_creneau_data = [];
    while ($row = $result_creneau->fetch_assoc()) {
        $dispo_creneau_data[$row["jour"]]["AM"] = $row["AM"];
        $dispo_creneau_data[$row["jour"]]["PM"] = $row["PM"];
    }
//couleur en fct des dispo 
function afficherCase($dispo) {
    if ($dispo) {
        echo '<td style="background-color: green;"></td>';
    } else {
        echo '<td style="background-color: red;"></td>';
    }
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte Agent</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #cadre {
            width: 100%; 
            max-width: 800px; 

            margin: 50px auto; 
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }

        h2 {
            margin-bottom: 20px;
            color: #333;
        }

        p {
            color: #666;
            margin-bottom: 10px;
        }

        #deconnexionBtn {
            font-size: 20px;
            color: white;
            background-color: grey;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 40px; 
            text-decoration: none;
        }

        #deconnexionBtn:hover {
            background-color: #555;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 20px;
        }

        .button {
            font-size: 16px;
            color: white;
            background-color: #003366;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin: 0 5px;
            text-decoration: none;
        }

        .button:hover {
            background-color: #0056b3;
        }
        .table-container {
            margin: 0 auto; 
            width: fit-content; 
            max-width: 800px; 
            text-align: center;


        }
        .unavailable-creneau {
            background-color: #000;
            color: #fff;
            pointer-events: none;
        }

    </style>
</head>
<body>
 <!--affichage des données sur lagent -->
     <div id="cadre">
        <h2>Mon Compte Agent</h2>
        <p>Nom et prénom : <?php echo htmlspecialchars($utilisateur['nom']); ?> <?php echo htmlspecialchars($utilisateur['prenom']); ?></p>
        <p>Identifiant : <?php echo htmlspecialchars($utilisateur['courriel']); ?></p>
        <p>Numéro de téléphone : <?php echo htmlspecialchars($utilisateur['numero_tel']); ?></p>
        <p>Spécialité : <?php echo htmlspecialchars($utilisateur['specialite']); ?></p>

        
        <div class="button-container">
            <a href="rdv_agent.php?id_agent=<?php echo urlencode($id_agent); ?>" class="button">Mes rendez-vous</a>
            <a href="mes_messages.php?id_agent=<?php echo urlencode($id_agent); ?>" class="button">Mes Messages</a>
            <a href="historique.php?id_agent=<?php echo urlencode($_SESSION['utilisateur']['id_agent']); ?>" class="button">Historique des RDV</a>
        </div>

        <div class="table-container">
            <br> <br> <br>
            <h3>Mon calendrier</h3>
            <table border= 1>
                <tr>
                    <th>Heure</th>
                    <th>Lundi</th>
                    <th>Mardi</th>
                    <th>Mercredi</th>
                    <th>Jeudi</th>
                    <th>Vendredi</th>
                </tr>
                <?php
                $heures = array("10:00:00", "11:00:00", "12:00:00", "13:00:00", "14:00:00", "15:00:00", "16:00:00", "17:00:00");
                // calendrirer 
                foreach ($heures as $heure) {
                    echo "<tr>";
                    echo "<td>$heure</td>";
                    foreach (array("Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi") as $jour) {
                        if (isset($dispo[$jour][$heure])) {
                            $is_am = in_array($heure, ["10:00:00", "11:00:00", "12:00:00", "13:00:00"]);
                            $creneau = $is_am ? 'AM' : 'PM';
                            $dispo_creneau = isset($dispo_creneau_data[$jour][$creneau]) ? $dispo_creneau_data[$jour][$creneau] : 1;
                            if ($dispo_creneau == 0) {
                                echo '<td style="background-color: black;"></td>'; // Case noire si le créneau est indisponible
                            } else {
                                afficherCase($dispo[$jour][$heure]); // Remplissage précédent en rouge et vert
                            }
                        } else {
                            afficherCase(false);
                        }
                    }
                    echo "</tr>";
                }
                             
                
                ?>
            </table>
        </div>
        
        <br><br>

        <a href="deconnexion.php" id="deconnexionBtn">Se déconnecter</a>
    </div>
</body>
</html>
