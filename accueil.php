<?php include 'wrapper.php'; ?>  
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Omnes Immobilier - Accueil</title>
    <style>
        #content {
            display: flex;
            flex-direction: column; /* Organiser les éléments en colonne */
            align-items: center; /* Centrer les éléments horizontalement */
            margin: 20px; /* Marge autour du conteneur */
        }

        #carrousel {
            width: 40%;
            height: 400px; /* Ajustez la hauteur selon vos besoins */
            overflow: hidden;
            margin: 20px 0; /* Marge autour du carrousel */
        }
        
        #carrousel ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
            transition: transform 1s ease-in-out;
        }
        
        #carrousel ul li {
            flex: 0 0 100%;
            overflow: hidden; /* Pour recadrer les images */
        }

        #carrousel ul li img {
            width: 100%;
            height: 100%;
            object-fit: cover; /* Recadrage des images */
            object-position: center; /* Positionnement au centre */
        }

        .intro, .bulletin {
            width: 60%; /* Ajustez la largeur selon vos besoins */
            margin: 20px 0; /* Marge autour des sections */
            text-align: center;
        }

        .offer-box {
            border: 2px solid #000; /* Bordure noire de 2 pixels */
            padding: 10px; /* Espace intérieur */
            margin-top: 20px; /* Espace au-dessus du cadre */
            text-align: center; /* Centrer le texte */
            background-color: #f9f9f9; /* Couleur de fond */
            font-weight: bold; /* Texte en gras */
        }

        footer {
            display: flex; /* Utiliser flexbox pour aligner les enfants */
            justify-content: space-between; /* Espacer les enfants également */
            border-top: 2px solid #000; /* Bordure noire en haut de 2 pixels */
            padding: 20px; /* Espace intérieur */
            background-color: #376b8c; /* Couleur de fond bleue */
            color: white; /* Couleur du texte en blanc */
            bottom: 0; /* Positionne le footer en bas de la page */
            left: 0; /* Positionne le footer à gauche de la page */
            right: 0; /* Positionne le footer à droite de la page */
            width: 100%; /* Assure que le footer s'étend sur toute la largeur */
            width: 1200px; /* Largeur fixe */
        }

        h3{
            text-align: center;
        }
        .footer-content {
    flex: 1; /* Permet à la section de prendre tout l'espace disponible */
    max-width: 50%; /* La moitié de l'espace disponible */
}

.footer-map {
    flex: 1; /* Permet à la section de prendre tout l'espace disponible */
    max-width: 50%; /* La moitié de l'espace disponible */
    height: 200px; /* Ajuster la hauteur selon vos besoins */
}
        .footer-map iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
<section id="carrousel-container"> <!-- Ajout d'un conteneur pour le carrousel -->
    <h2><center>Bienvenue chez Omnes Immobilier</center></h2>
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
