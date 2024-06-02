<?php
session_start();
include 'db.php';

if (!isset($_SESSION['utilisateur']['id'])) {
    header("Location: form.php");
    exit();
}

$id_client = $_SESSION['utilisateur']['id'];

// Récupérer le courriel du client
$sql = "SELECT courriel FROM client WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id_client);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo "Erreur : client non trouvé.";
    exit();
}
$client = $result->fetch_assoc();
$courriel_client = $client['courriel'];

// on verifie si il n'y a pas deja une ligne dans la table pour ce client (lid est le courriel)
$sql_existing = "SELECT id FROM infos_financieres WHERE courriel_client = ?";
$stmt_existing = $conn->prepare($sql_existing);
$stmt_existing->bind_param("s", $courriel_client);
$stmt_existing->execute();
$result_existing = $stmt_existing->get_result();

if ($result_existing->num_rows > 0) {
    // si oui maj de la ligne 
    $sql_update = "UPDATE infos_financieres SET nom_carte = ?, prenom_carte = ?, adresse_ligne_1 = ?, adresse_ligne_2 = ?, ville = ?, code_postal = ?, pays = ?, numero_tel = ?, code_cb = ?, cvv = ? WHERE courriel_client = ?";
    $stmt_update = $conn->prepare($sql_update);
    $stmt_update->bind_param("sssssssssss", $nom_carte, $prenom_carte, $adresse_ligne_1, $adresse_ligne_2, $ville, $code_postal, $pays, $numero_tel, $code_cb_last4, $cvv, $courriel_client);
} else {
    // si non, requete sql d'insertion
    $sql_insert = "INSERT INTO infos_financieres (courriel_client, nom_carte, prenom_carte, adresse_ligne_1, adresse_ligne_2, ville, code_postal, pays, numero_tel, code_cb, cvv) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt_insert = $conn->prepare($sql_insert);
    $stmt_insert->bind_param("sssssssssss", $courriel_client, $nom_carte, $prenom_carte, $adresse_ligne_1, $adresse_ligne_2, $ville, $code_postal, $pays, $numero_tel, $code_cb_last4, $cvv);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // on prend les données du form
    $nom_carte = $_POST['nom_carte'];
    $prenom_carte = $_POST['prenom_carte'];
    $adresse_ligne_1 = $_POST['adresse_ligne_1'];
    $adresse_ligne_2 = $_POST['adresse_ligne_2'];
    $ville = $_POST['ville'];
    $code_postal = $_POST['code_postal'];
    $pays = $_POST['pays'];
    $numero_tel = $_POST['numero_tel'];
    $code_cb = $_POST['code_cb'];
    $cvv = $_POST['cvv'];

    // on prend kes 4 derniers chiffres de la cb et on masque le reste 
    $code_cb_last4 = substr($code_cb, -4);


    if (isset($stmt_update)) {
        if ($stmt_update->execute()) {
            echo "<script>
                alert('Informations financières mises à jour avec succès.');
                window.location.href = 'verif_paiement.php';
            </script>";
        } else {
            echo "Erreur lors de la mise à jour des informations financières : " . $stmt_update->error;
        }
    } elseif (isset($stmt_insert)) {
        if ($stmt_insert->execute()) {
            echo "<script>
                alert('Informations financières enregistrées avec succès.');
                window.location.href = 'verif_paiement.php';
            </script>";
        } else {
            echo "Erreur lors de l'enregistrement des informations financières : " . $stmt_insert->error;
        }
    }


    if (isset($stmt_insert)) {
        $stmt_insert->close();
    }
    if (isset($stmt_update)) {
        $stmt_update->close();
    }
}

$stmt->close();
$stmt_existing->close();
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations de Paiement</title>
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
        .payment-form {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
        }
        .payment-form h2 {
            margin-top: 0;
        }
        .payment-form label {
            display: block;
            margin-top: 10px;
        }
        .payment-form input {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        .payment-form button {
            background-color: #007bff;
            border: none;
            color: #fff;
            padding: 10px 15px;
            margin-top: 10px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        .payment-form button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
        <!--formulaire pour remplir les infos de paiement dans la bdd-->

    <div class="payment-form">
        <h2>Informations de Paiement</h2>
        <form method="POST" action="">
            <label for="nom_carte">Nom sur la carte</label>
            <input type="text" id="nom_carte" name="nom_carte" required>
            
            <label for="prenom_carte">Prénom sur la carte</label>
            <input type="text" id="prenom_carte" name="prenom_carte" required>
            
            <label for="adresse_ligne_1">Adresse Ligne 1</label>
            <input type="text" id="adresse_ligne_1" name="adresse_ligne_1" required>
            
            <label for="adresse_ligne_2">Adresse Ligne 2</label>
            <input type="text" id="adresse_ligne_2" name="adresse_ligne_2">
            
            <label for="ville">Ville</label>
            <input type="text" id="ville" name="ville" required>
            
            <label for="code_postal">Code Postal</label>
            <input type="text" id="code_postal" name="code_postal" required>
            
            <label for="pays">Pays</label>
            <input type="text" id="pays" name="pays" required>
            
            <label for="numero_tel">Numéro de Téléphone</label>
            <input type="text" id="numero_tel" name="numero_tel" required>
            
            <label for="code_cb">Numéro de Carte Bancaire</label>
            <input type="text" id="code_cb" name="code_cb" required pattern="\d{16}">
            
            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required pattern="\d{3}">
            
            <button type="submit">Enregistrer</button>
        </form>
    </div>
</body>
</html>