<?php
include 'wrapper.php';
include 'db.php';

//id de l'agent a modifier 
if(isset($_GET['agent_id'])) {
    $agent_id = $_GET['agent_id'];

    // requete sql qui recupere les dispos de l'agent dans la table agent 
    $sql = "SELECT * FROM dispo_agents WHERE id_agent = $agent_id ORDER BY FIELD(jour, 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi')";
    $result = $conn->query($sql);

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

// formulaire de modif des dispos 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_dispo'])) {
    $update_errors = [];
    foreach (['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi'] as $jour) {
        // choix dispo ou non 
        $AM = isset($_POST[$jour . '_AM']) ? 1 : 0;
        $PM = isset($_POST[$jour . '_PM']) ? 1 : 0;

        // maj des nouvelles dispos 
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

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Disponibilités</title>
</head>
<body>
    <h2>Modifier Disponibilités</h2>
    <form method="post">
         <!-- affichage html avec carrés a cocher  -->
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
