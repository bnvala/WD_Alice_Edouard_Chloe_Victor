<?php
include 'wrapper.php';

// Vérifier si l'agent est connecté
if (!isset($_SESSION['utilisateur'])) {
    header("Location: form.php");
    exit();
}

// Vérifier si l'ID du rendez-vous est passé en paramètre d'URL
if (!isset($_GET['id_rdv'])) {
    echo "ID du rendez-vous manquant dans l'URL.";
    exit();
}

$id_rdv = $_GET['id_rdv'];

// Connexion à la base de données (supposons que vous ayez déjà une connexion dans wrapper.php)
include 'db.php';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $adresse = $_POST['adresse'];
    $autres_infos = $_POST['autres_infos'];

    // Requête pour mettre à jour les informations du rendez-vous
    $sql = "UPDATE rdv SET date = ?, heure = ?, adresse = ?, autres_infos = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $date, $heure, $adresse, $autres_infos, $id_rdv);

    if ($stmt->execute()) {
        // Rediriger vers la page rdv_agent.php avec l'ID de l'agent connecté
        $id_agent = $_SESSION['utilisateur']['id_agent'];
        header("Location: rdv_agent.php?id_agent=" . urlencode($id_agent));
        exit();
    } else {
        echo "Erreur lors de la mise à jour des informations.";
    }

    // Fermer le statement
    $stmt->close();
}

// Récupérer les informations actuelles du rendez-vous pour pré-remplir le formulaire
$sql = "SELECT * FROM rdv WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_rdv);
$stmt->execute();
$result = $stmt->get_result();
$rdv = $result->fetch_assoc();

// Fermer la connexion
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
        /* Style CSS pour le formulaire */
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
