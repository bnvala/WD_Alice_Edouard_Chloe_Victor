<?php
include 'wrapper.php';
// Inclure le fichier de connexion à la base de données et d'autres fichiers nécessaires
include 'db.php';

// Vérifier si un agent est sélectionné
if(isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];

    // Récupérer les disponibilités actuelles de l'agent pour chaque jour de la semaine
    $sql = "SELECT * FROM dispo_agents WHERE id_agent = $agent_id ORDER BY FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi')";
    $result = $conn->query($sql);

    // Vérifier si les disponibilités existent
    if ($result->num_rows > 0) {
        $dispos = [];
        while ($row = $result->fetch_assoc()) {
            $dispos[$row['jour']] = ['AM' => $row['AM'], 'PM' => $row['PM']];
        }
    } else {
        echo "Aucune disponibilité trouvée pour cet agent.";
        exit();
    }
} else {
    echo "Aucun agent sélectionné.";
    exit();
}

// Traitement de la soumission du formulaire de modification des disponibilités
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_dispo'])) {
    $update_errors = [];
    foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'] as $jour) {
        $AM = isset($_POST[$jour . '_AM']) ? 1 : 0;
        $PM = isset($_POST[$jour . '_PM']) ? 1 : 0;

        // Mettre à jour les disponibilités de l'agent dans la base de données
        $sql_update = "UPDATE dispo_agents SET AM='$AM', PM='$PM' WHERE id_agent=$agent_id AND jour='$jour'";

        if (!$conn->query($sql_update)) {
            $update_errors[] = "Erreur lors de la mise à jour des disponibilités pour $jour: " . $conn->error;
        }
    }
    
    if (empty($update_errors)) {
        echo "Disponibilités mises à jour avec succès.";
    } else {
        echo implode('<br>', $update_errors);
    }
}

// Fermer la connexion à la base de données
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Disponibilités</title>
    <!-- Ajouter le style CSS si nécessaire -->
</head>
<body>
    <h2>Modifier Disponibilités</h2>
    <form method="post">
        <input type="hidden" name="agent_id" value="<?php echo $agent_id; ?>">
        <?php foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'] as $jour): ?>
            <div>
                <h3><?php echo $jour; ?></h3>
                <label for="<?php echo $jour; ?>_AM">Disponibilité AM:</label>
                <input type="checkbox" id="<?php echo $jour; ?>_AM" name="<?php echo $jour; ?>_AM" value="1" <?php if($dispos[$jour]['AM'] == 1) echo "checked"; ?>>
                <label for="<?php echo $jour; ?>_PM">Disponibilité PM:</label>
                <input type="checkbox" id="<?php echo $jour; ?>_PM" name="<?php echo $jour; ?>_PM" value="1" <?php if($dispos[$jour]['PM'] == 1) echo "checked"; ?>>
            </div>
        <?php endforeach; ?>
        <button type="submit" name="update_dispo">Mettre à jour les disponibilités</button>
    </form>
</body>
</html>
