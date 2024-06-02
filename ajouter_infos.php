<?php
include 'wrapper.php';

if (!isset($_SESSION['utilisateur'])) {
    header("Location: form.php");
    exit();
}

//chercher id du rdv dans l'url de la page 
if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URL.";
    exit();
}
//prendfe l'id du rdv 
$id_rdv = $_GET['id_rdv'];

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $adresse = $_POST['adresse'];
    $autres_infos = $_POST['autres_infos'];

    // maj des  informations du rendez-vous
    $sql = "UPDATE rdv SET date = ?, heure = ?, adresse = ?, autres_infos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $date, $heure, $adresse, $autres_infos, $id_rdv);

    if ($stmt->execute()) {
        //redirection apres execution
        $id_agent = $_SESSION['utilisateur']['id_agent'];
        header("Location: rdv_agent.php?id_agent=" . urlencode($id_agent));
        exit();
    } else {
        echo "Erreur lors de la mise à jour des informations.";
    }

    $stmt->close();
}

// pre-remplir le form 
$sql = "SELECT * FROM rdv WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rdv);
$stmt->execute();
$result = $stmt->get_result();
$rdv = $result->fetch_assoc();

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier les informations du RDV</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .form-container {
            width: 100%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            margin-bottom: 10px;
            color: #666;
        }
        input[type="text"], input[type="date"], input[type="time"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            font-size: 16px;
            color: white;
            background-color: #28a745;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
     <!-- formulaire a completer  mettre "aucune info" si la base de donnée est vide pour ne pas faire beuguer -->
    <div class="form-container">
        <h1>Modifier les informations du RDV</h1>
        <form action="" method="post">
            <label for="date">Date :</label>
            <input type="date" id="date" name="date" value="<?php echo htmlspecialchars($rdv['date']); ?>" required>

            <label for="heure">Heure :</label>
            <input type="time" id="heure" name="heure" value="<?php echo htmlspecialchars($rdv['heure']); ?>" required>

            <label for="adresse">Adresse :</label>
            <input type="text" id="adresse" name="adresse" value="<?php echo $rdv['adresse'] !== null ? htmlspecialchars($rdv['adresse']) : 'Aucune information'; ?>" required>

            <label for="autres_infos">Autres informations :</label>
            <textarea id="autres_infos" name="autres_infos" rows="4" required><?php echo $rdv['autres_infos'] !== null ? htmlspecialchars($rdv['autres_infos']) : 'Aucune information'; ?></textarea>

            <input type="submit" value="Enregistrer">
        </form>
    </div>
</body>
</html>
