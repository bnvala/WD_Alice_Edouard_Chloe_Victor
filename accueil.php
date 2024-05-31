<?php include 'wrapper.php'; ?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier - Accueil</title>
    <link rel="stylesheet" type="text/css" href="styles_accueil.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<section id="carrousel-container"> <!-- Ajout d'un conteneur pour le carrousel -->
    <h1><center>Bienvenue chez Omnes Immobilier</center></h1>
    <div id="content">
        <div class="intro">
            <h3>À propos de nous</h3>
            <p>Omnes Immobilier est dédié à la communauté Omnes Education. <br></br>Nous offrons une plateforme innovante pour explorer, acheter, louer des propriétés, avec des agents immobiliers qualifiés à votre service.</p>
        </div>
        <div id="carrousel">
            <ul>
                <li><img src="photos_biens/bien59.jpg" alt="Image 1"/></li>
                <li><img src="photos_biens/bien51.jpg" alt="Image 2"/></li>
                <li><img src="photos_biens/bien53.jpg" alt="Image 3"/></li>
                <li><img src="photos_biens/bien58.jpg" alt="Image 4"/></li>
                <li><img src="photos_biens/bien65.jpg" alt="Image 5"/></li>
                <li><img src="photos_biens/bien68.jpg" alt="Image 6"/></li>
                <li><img src="photos_biens/bien71.jpg" alt="Image 7"/></li>
            </ul>
        </div>
        <div class="bulletin">
            <h3>Bulletin immobilier de la semaine:</h3>
            <div class="offer-box">
                Cette semaine seulement, retrouvez des offres sur les terrains dans toute la France !
            </div>
        </div>
    </div>
</section>

<footer>
    <div class="footer-content">
        <p>Email: contact@omnesimmobilier.com</p>
        <p>Téléphone: 01 23 45 67 89</p>
        <p>Adresse: 12 rue Sextius Michel, 75015 Paris, France</p>
        <p>&copy; 2024 Omnes Immobilier. Tous droits réservés.</p>
    </div>
    <div class="footer-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d10501.54984724702!2d2.2854888397040134!3d48.850821493288315!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6701b377bfac1%3A0xccc4e62b16ff4998!2s12%20Rue%20Sextius%20Michel%2C%2075015%20Paris!5e0!3m2!1sfr!2sfr!4v1717088265269!5m2!1sfr!2sfr" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
</footer>

<script>
    $(document).ready(function () {
        var $carrousel = $('#carrousel ul');
        var $img = $carrousel.find('li');
        var indexImg = $img.length - 1;
        var i = 0;

        function slideImg() {
            setTimeout(function () {
                $carrousel.css('transform', 'translateX(-' + (i * 100) + '%)');
                if (i < indexImg) {
                    i++;
                } else {
                    i = 0;
                }
                slideImg();
            }, 4000);
        }

        slideImg();
    });
</script>
</body>
</html>
