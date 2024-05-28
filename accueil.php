<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier - Accueil</title>
    <link rel="stylesheet" href="styles_accueil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div id="wrapper">
        <header>
            <h1>Omnes Immobilier</h1>
            <nav>
                <ul>
                    <li><a href="accueil.php">Accueil</a></li>
                    <li><a href="toutparcourir.php">Tout Parcourir</a></li>
                    <li><a href="recherche.php">Recherche</a></li>
                    <li><a href="rendez-vous.php">Rendez-vous</a></li>
                    <li><a href="form.php">Votre Compte</a></li>
                </ul>
            </nav>
        </header>
        
        <section>
            <h2>Bienvenue sur Omnes Immobilier</h2>
            <p>Votre plateforme pour trouver les meilleures propriétés immobilières en ligne.</p>
        <div id="carrousel">
            <ul>
                <li><img src="image_acceuil_1.jpg" alt="Image 1"/></li>
                <li><img src="image_acceuil_2.jpg" alt="Image 2"/></li>
                <li><img src="image_acceuil_3.jpg" alt="Image 3"/></li>
            </ul>
        </div>
            <div class="intro">
                <h3>À propos de nous</h3>
                <p>Omnes Immobilier est dédié à la communauté Omnes Education. Nous offrons une plateforme innovante pour explorer et acheter des propriétés, avec des agents immobiliers qualifiés à votre service.</p>
            </div>

            <div class="features">
                <h3>Fonctionnalités</h3>
                <ul>
                    <li>Voir toutes les propriétés en vente</li>
                    <li>Sélectionner et contacter un agent immobilier</li>
                    <li>Prendre des rendez-vous pour des visites</li>
                    <li>Communiquer avec les agents en temps réel via chat ou visioconférence</li>
                </ul>
            </div>
        </section>

        <footer>
            <p>&copy; 2024 Omnes Immobilier. Tous droits réservés.</p>
        </footer>
    </div>

    <script>
        $(document).ready(function () {
            var $carrousel = $('#carrousel ul');
            var $img = $carrousel.find('li');
            var indexImg = $img.length - 1;
            var i = 0;

            $img.hide();
            $img.eq(i).show();

            function slideImg() {
                setTimeout(function () {
                    $img.eq(i).hide();
                    if (i < indexImg) {
                        i++;
                    } else {
                        i = 0;
                    }
                    $img.eq(i).show();
                    slideImg();
                }, 4000);
            }

            slideImg();
        });
    </script>
</body>
</html>
