<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "pj_piscine";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("La connexion a échoué: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $courriel = $_POST['courriel'];
    $motdepasse = $_POST['motdepasse'];

    $sql = "SELECT * FROM client WHERE courriel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $courriel);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($motdepasse, $row['mot_de_passe'])) {
            // Connexion réussie, stocker les informations de l'utilisateur dans la session
            $_SESSION['utilisateur'] = $row;
            echo json_encode(['success' => true, 'message' => 'Connexion réussie. Redirection en cours...']);
        } else {
            // Identifiant ou mot de passe incorrect
            echo json_encode(['success' => false, 'message' => 'Votre identifiant ou votre mot de passe est incorrect.']);
        }
    } else {
        // Identifiant ou mot de passe incorrect
        echo json_encode(['success' => false, 'message' => 'Votre identifiant ou votre mot de passe est incorrect.']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode de requête non valide.']);
}

$conn->close();
?>