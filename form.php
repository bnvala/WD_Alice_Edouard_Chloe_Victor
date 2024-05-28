<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Inscription</title>
</head>
<body>
    <h2>Formulaire d'Inscription</h2>
    <form id="inscriptionForm" action="traitement_co.php" method="post">
        <label for="courriel">Identifiant :</label>
        <input type="email" id="courriel" name="courriel" required><br><br>

        <label for="motdepasse">Mot de passe :</label>
        <input type="password" id="motdepasse" name="motdepasse" required><br><br>

        <button type="submit">Connexion</button>
    </form>

    <!-- Section pour afficher le message -->
    <div id="message" style="display: none;"></div>

    <!-- Bouton "Vous n'avez pas encore de compte ?" -->
    <button id="nouveauCompte">Vous n'avez pas encore de compte ?</button>

    <!-- Script JavaScript pour afficher le message -->
    <script>
        // Récupérer le formulaire, le message et le bouton
        var form = document.getElementById("inscriptionForm");
        var message = document.getElementById("message");
        var nouveauCompteBtn = document.getElementById("nouveauCompte");

        // Ajouter un événement click au bouton "Vous n'avez pas encore de compte ?"
        nouveauCompteBtn.addEventListener("click", function() {
            // Rediriger vers la page d'inscription
            window.location.href = "inscription_client.php";
        });

        // Ajouter un événement submit au formulaire
        form.addEventListener("submit", function(event) {
            event.preventDefault(); // Empêcher l'envoi du formulaire

            // Effectuer une requête AJAX pour soumettre le formulaire
            var formData = new FormData(form);
            var xhr = new XMLHttpRequest();
            xhr.open("POST", form.action, true);
            xhr.onload = function() {
                if (xhr.status === 200) {
                    // Afficher le message de réponse
                    message.innerHTML = xhr.responseText;
                    message.style.display = "block";
                }
            };
            xhr.send(formData);
        });
    </script>
</body>
</html>
