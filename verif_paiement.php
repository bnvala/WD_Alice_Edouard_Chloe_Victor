<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification de paiement</title>
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
    <script>
        function redirectToProfile() {
            window.location.href = 'accueil.php';
        }
    </script>
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
            <strong>Montant :</strong> 96,00 €<br>
            <strong>Date :</strong> 07/09/2021 12:45:43 GMT<br>
            <strong>N° de carte :</strong> xxxxxxxx1234</p>
            <p>Cette authentification est obligatoire pour vérifier que vous êtes bien le titulaire de la carte. Si vous ne souhaitez pas vous authentifier, la transaction en cours sera annulée.</p>
        </div>
        <div class="auth-footer">
            <button type="button">Je ne souhaite pas m'authentifier et j'annule ma transaction</button>
            <button type="button" onclick="redirectToProfile()">Authentification réussie : Retour vers le site marchand</button>
        </div>
    </div>
</body>
</html>
