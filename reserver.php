<?php
include 'wrapper.php';

include 'db.php';
$id_agent = $_GET['id_agent'];
$jour = $_GET['jour'];
$heure = $_GET['heure'];
$id_client = $_SESSION['utilisateur']['id'];
$duree = "01:00:00";
$sql_courriel = "SELECT courriel FROM client WHERE id = ?";
$stmt_courriel = $conn->prepare($sql_courriel);
$stmt_courriel->bind_param("i", $id_client);
$stmt_courriel->execute();
$result_courriel = $stmt_courriel->get_result();
if ($result_courriel->num_rows === 0) {
    echo "Erreur : client non trouvé.";
    exit();
}
$client = $result_courriel->fetch_assoc();
$courriel_client = $client['courriel'];
$sql_insert_rdv = "INSERT INTO rdv (id_agent, courriel_client, date, heure, duree) VALUES (?, ?, ?, ?, ?)";
$stmt_insert_rdv = $conn->prepare($sql_insert_rdv);
$stmt_insert_rdv->bind_param("issss", $id_agent, $courriel_client, $jour, $heure, $duree);
$sql_update_dispo = "UPDATE dispo_agents_heure_par_heure SET dispo = 0 WHERE id_agent = ? AND jour = ? AND heure = ?";
$stmt_update_dispo = $conn->prepare($sql_update_dispo);
$stmt_update_dispo->bind_param("iss", $id_agent, $jour, $heure);
$conn->begin_transaction();

if ($stmt_insert_rdv->execute() && $stmt_update_dispo->execute()) {
    $conn->commit();
    echo "<script>alert('Votre rendez-vous a été réservé. Vous recevrez une confirmation par SMS ou courriel.');</script>";
    header("Location: paiement.php?id_agent=$id_agent&jour=$jour&heure=$heure");
    exit();
} else {
    $conn->rollback();
    echo "Erreur lors de la réservation.";
}

$stmt_insert_rdv->close();
$stmt_update_dispo->close();
$conn->close();
?>
