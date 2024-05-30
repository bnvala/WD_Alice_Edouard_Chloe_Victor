<?php
session_start();
include 'db.php';

// Vérifier si le client est connecté
if (!isset($_SESSION['utilisateur']['id'])) {
    header("Location: form.php");
    exit();
}

// Récupérer l'adresse e-mail de l'utilisateur connecté
$email_utilisateur = $_SESSION['utilisateur']['courriel'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les informations financières du client en utilisant l'adresse e-mail
    $sql_infos_financieres = "SELECT code_cb, cvv FROM infos_financieres WHERE courriel_client = ?";
    $stmt_infos_financieres = $conn->prepare($sql_infos_financieres);
    $stmt_infos_financieres->bind_param("s", $email_utilisateur);
    $stmt_infos_financieres->execute();
    $result_infos_financieres = $stmt_infos_financieres->get_result();

    if ($result_infos_financieres->num_rows > 0) {
        // Récupérer les données financières de l'utilisateur
        $row = $result_infos_financieres->fetch_assoc();
        $code_cb_client = $row['code_cb'];
        $cvv_client = $row['cvv'];
         echo $code_cb_client; 
         echo $cvv_client; 

        // Vérifier si les informations correspondent à celles attendues
        if ($code_cb_client == '1203' && $cvv_client == '122') {
            // Authentification réussie
            header("Location: autentification_good.php");
            exit();
        }
    }

    // Authentification échouée
    header("Location: autentification_bad.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification de paiement</title>
    <style>
 <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .auth-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            padding: 20px;
            text-align: center;
        }
        .auth-header {
            background-color: #FFA500;
            color: #fff;
            padding: 15px;
            border-radius: 10px 10px 0 0;
            font-size: 18px;
            font-weight: bold;
        }
        .auth-body {
            padding: 20px;
            font-size: 14px;
            color: #333;
        }
        .auth-body p {
            margin: 10px 0;
        }
        .auth-footer {
            background-color: #f4f4f4;
            padding: 10px;
            border-radius: 0 0 10px 10px;
        }
        .auth-footer button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px 5px;
        }
        .auth-footer button:hover {
            background-color: #0056b3;
        }
        .logo-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .logo-container img {
            height: 40px;
        }
    </style>
    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-header">
            En attente d’authentification
        </div>
        <div class="auth-body">
            <div class="logo-container">
                <img src="banque_populaire_logo.png" alt="Banque Populaire">
                <img src="visa_logo.png" alt="Visa">
            </div>
            <p>Bonjour, bienvenue sur la page de sécurisation des paiements par Internet de votre Banque Populaire.</p>
            <p>Vous avez demandé à effectuer le paiement suivant :</p>
            <p><strong>Marchand :</strong> Omnes Immobilier<br>
            <strong>Montant :</strong> 26,80 €<br>
            <strong>Date :</strong> 07/09/2021 12:45:43 GMT<br>
            <strong>N° de carte :</strong> xxxxxxxx1234</p>
            <p>Cette authentification est obligatoire pour vérifier que vous êtes bien le titulaire de la carte. Si vous ne souhaitez pas vous authentifier, la transaction en cours sera annulée.</p>
        </div>
        <div class="auth-footer">
            <button type="button">Je ne souhaite pas m'authentifier et j'annule ma transaction</button>
            <form method="POST" action="">
                <button type="submit">S'authentifier</button>
            </form>
        </div>
    </div>

</body>
</html>
