<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
        #inscriptionBtn {
            font-size: 20px;
            color: white;
            background-color: #0056b3; /* Bleu */
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        #inscriptionBtn:hover {
            background-color: #0056b3; /* Bleu plus foncé au survol */
        }
    </style>
</head>
<body>
<?php include 'wrapper.php'; ?>
    <div id="cadre">
        <h2>Inscription</h2>
        <form action="traitement_inscription.php" method="post">
            <label for="nom">Nom :</label>
            <input type="text" id="nom" name="nom" required><br><br>

            <label for="prenom">Prénom :</label>
            <input type="text" id="prenom" name="prenom" required><br><br>

            <label for="adresse">Adresse :</label>
            <textarea id="adresse" name="adresse" rows="4" required></textarea><br><br>

            <label for="courriel">Identifiant :</label>
            <input type="email" id="courriel" name="courriel" required><br><br>

            <label for="motdepasse">Mot de passe :</label>
            <input type="password" id="motdepasse" name="motdepasse" required><br><br>

            <button id="inscriptionBtn" type="submit">S'inscrire</button>
        </form>

        <div id="message"></div>

        <button id="dejaCompte">Vous avez déjà un compte ?</button>
    </div>

    <script>
        var form = document.querySelector("form");
        var message = document.getElementById("message");
        var dejaCompteBtn = document.getElementById("dejaCompte");

        dejaCompteBtn.addEventListener("click", function() {
            window.location.href = "form.php";
        });

        form.addEventListener("submit", function(event) {
            event.preventDefault();

            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    message.textContent = xhr.responseText;
                    message.style.display = "block";
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
