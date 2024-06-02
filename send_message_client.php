<?php
// mot de passe identifiant bdd 
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// connexion bdd
$conn = new mysqli($servername, $username, $password, $dbname);

// verification de connection à la bdd 
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}
// requete sql pour ajouter un message 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_agent = $_POST['id_agent'];
    $id_client = $_POST['id_client'];
    $message = $_POST['message'];

    $stmt = $conn->prepare("INSERT INTO communication (ID_client, ID_agent, message, envoyeur) VALUES (?, ?, ?, 'client')");
    $stmt->bind_param("iis", $id_client, $id_agent, $message);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s')
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'error' => $stmt->error
        ]);
    }

    $stmt->close();
}

$conn->close();
?>
