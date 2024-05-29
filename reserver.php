<?php
include 'db.php';
require 'C:\Users\victo\OneDrive\Bureau\TDG\twilio-php-main\twilio-php-main\src\Twilio\autoload.php';
use Twilio\Rest\Client;
$sid = 'AC44e06cd346b75c977839be284616bb57';
$token = 'dcd8dd6e4199d34f525a1ef51494234e';
$client = new Client($sid, $token);
$client->messages->create(
    '+330642131099',
    array(
        'from' => '+16815815884', 
        'body' => 'Votre rendez-vous a été confirmé.'
    )
);

$id_agent = $_GET['id_agent'];
$jour = $_GET['jour'];
$creneau = $_GET['creneau'];
$column = $creneau == 'AM' ? 'AM' : 'PM';
$sql = "UPDATE dispo_agents SET $column = 0 WHERE id_agent = $id_agent AND jour = '$jour'";
if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Votre rendez-vous a été réservé. Vous recevrez une confirmation par SMS ou courriel.');</script>";
    echo "<script>window.location.href = 'profil-agent.php?id=$id_agent';</script>";
} else {
    echo "Erreur lors de la réservation : " . $conn->error;
}

$conn->close();
?>
