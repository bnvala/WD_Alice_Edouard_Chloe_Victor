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
    $agent_id = isset($_POST['agent_id']) ? $_POST['agent_id'] : null;

    // Vérifier dans la table 'agent'
    $sql = "SELECT * FROM agent WHERE courriel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $courriel);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($motdepasse === $row['mot_de_passe']) {
            // Connexion réussie pour un agent
            $_SESSION['utilisateur'] = $row;
            $_SESSION['agent_id'] = $agent_id; // Enregistrer l'ID de l'agent
            $redirect = 'mon_compte_agent.php'; // Redirection vers le compte de l'agent
            echo json_encode(['success' => true, 'message' => 'Connexion réussie. Redirection en cours...', 'redirect' => $redirect]);
            exit;
        }
    }
    
    // Vérifier dans la table 'admin'
    $sql = "SELECT * FROM admin WHERE courriel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $courriel);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if ($motdepasse === $row['mot_de_passe']) {
            // Connexion réussie pour un administrateur
            $_SESSION['utilisateur'] = $row;
            $_SESSION['agent_id'] = $agent_id; // Enregistrer l'ID de l'agent
            $redirect = 'mon_compte_admin.php'; // Redirection vers le compte de l'administrateur
            echo json_encode(['success' => true, 'message' => 'Connexion réussie. Redirection en cours...', 'redirect' => $redirect]);
            exit;
        }
    }
    
    // Vérifier dans la table 'client'
    $sql = "SELECT * FROM client WHERE courriel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $courriel);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($motdepasse, $row['mot_de_passe'])) {
            // Connexion réussie pour un client
            $_SESSION['utilisateur'] = $row;
            $_SESSION['agent_id'] = $agent_id; // Enregistrer l'ID de l'agent
            $redirect = 'mon_compte_client.php'; // Redirection vers le compte du client
            echo json_encode(['success' => true, 'message' => 'Connexion réussie. Redirection en cours...', 'redirect' => $redirect]);
            exit;
        }
    }
    
    // Identifiant ou mot de passe incorrect
    echo json_encode(['success' => false, 'message' => 'Votre identifiant ou votre mot de passe est incorrect.']);
    exit;
} else {
    echo json_encode(['success' => false, 'message' => 'Méthode de requête non valide.']);
    exit;
}

$conn->close();
?>
