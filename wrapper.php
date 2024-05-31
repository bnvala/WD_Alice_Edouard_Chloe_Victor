<?php session_start();?>

<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles_entete.css">
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
                    <?php
                    // Vérifier si quelqu'un est connecté et son type de compte
                    if (isset($_SESSION['utilisateur']['type'])) {
                        // Déterminer le type de compte
                        $type_compte = $_SESSION['utilisateur']['type'];
                        
                        // Afficher le lien approprié en fonction du type de compte
                        switch ($type_compte) {
                            case 'admin':
                                echo '<li><a href="rdv.php">Rendez-vous</a></li>';
                                echo '<li><a href="mon_compte_admin.php">Mon Compte</a></li>';

                                break;
                            case 'agent':
                                echo '<li><a href="rdv_agent.php?id_agent=<?php echo urlencode($id_agent); ?>">Rendez-vous</a></li>';
                                echo '<li><a href="mon_compte_agent.php">Mon Compte</a></li>';

                                break;
                            case 'client':
                                echo '<li><a href="rdv.php">Rendez-vous</a></li>';
                                echo '<li><a href="mon_compte_client.php">Mon Compte</a></li>';

                                break;
                            default:
                                // En cas de type de compte inconnu, afficher "Se Connecter"
                                echo '<li><a href="rdv.php">Rendez-vous</a></li>';
                                echo '<li><a href="form.php">Se Connecter</a></li>';

                                break;
                        }
                    } else {
                        // Personne n'est connecté, afficher "Se Connecter"
                        echo '<li><a href="rdv.php">Rendez-vous</a></li>';
                        echo '<li><a href="form.php">Se Connecter</a></li>';

                    }
                    ?>
                </ul>
            </nav>
        </header>
    </div>
</body>
</html>