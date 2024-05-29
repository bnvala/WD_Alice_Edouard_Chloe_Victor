<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 18px;
        }
        #cadre {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            text-align: center;
        }
        #message {
            display: none;
            margin-top: 20px;
            color: #ff0000; /* Rouge */
        }
        #seConnecterBtn {
            font-size: 20px;
            color: white;
            background-color: #0056b3; /* Bleu plus foncé */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-top: 10px; /* Espace entre le champ "Mot de passe" et le bouton */
        }
        #seConnecterBtn:hover {
            background-color: #004080; /* Bleu foncé au survol */
        }
    </style>
</head>
<body>
    <div id="cadre">
        <h2>Connexion</h2>
        <form id="inscriptionForm" action="traitement_co.php" method="post">
            <label for="courriel">Identifiant :</label>
            <input type="email" id="courriel" name="courriel" required><br><br>

            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse" required><br><br>

            <button id="seConnecterBtn" type="submit">Se connecter</button>
        </form>

        <div id="message"></div>

        <button id="nouveauCompte">Vous n'avez pas encore de compte ?</button>
    </div>

    <script>
        var form = document.getElementById("inscriptionForm");
        var message = document.getElementById("message");
        var nouveauCompteBtn = document.getElementById("nouveauCompte");

        nouveauCompteBtn.addEventListener("click", function() {
            window.location.href = "inscription_client.php";
        });

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    message.innerHTML = response.message;
                    message.style.display = "block";

                    if (response.success) {
                        window.location.href = 'mon_compte.php';
                    }
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
