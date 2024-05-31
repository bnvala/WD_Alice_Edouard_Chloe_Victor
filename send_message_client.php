<?php
// Informations de connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

// Connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Traitement de la soumission du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_agent = $_POST['id_agent'];
    $id_client = $_POST['id_client'];
    $message = $_POST['message'];

    // Requête SQL pour insérer la communication dans la base de données
    $stmt = $conn->prepare("INSERT INTO communication (ID_client, ID_agent, message, envoyeur) VALUES (?, ?, ?, 'client')");
    $stmt->bind_param("iis", $id_client, $id_agent, $message);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true,
            'message' => $message,
            'timestamp' => date('Y-m-d H:i:s') // Vous pouvez utiliser le timestamp réel de la base de données si nécessaire
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
