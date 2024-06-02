<?php


require 'PHPMailer-master\src\Exception.php';
require 'PHPMailer-master\src\PHPMailer.php';
require 'PHPMailer-master\src\SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;  
use PHPMailer\PHPMailer\Exception;
if (isset($_POST['mailform'])) {
    $mail = new PHPMailer(true);

    try {
        
        $mail->SMTPDebug = 2; 
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'omnesimmobilier75@gmail.com'; // Votre adresse email Gmail
        $mail->Password   = '64493331'; // Votre mot de passe d'application
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // Destinataires
        $mail->setFrom('omnesimmobilier75@gmail.com', 'Omnes Immobilier');
        $mail->addAddress('victor11.laine@gmail.com'); // Destinataire

        // Contenu de l'email
        $mail->isHTML(true);
        $mail->Subject = 'Salut tout le monde !';
        $mail->Body    = '
        <html>
            <body>
                <div align="center">
                    <br />
                    J\'ai envoyé ce mail avec PHP !
                    <br />
                </div>
            </body>
        </html>';

        $mail->send();
        echo 'Email envoyé avec succès.';
    } catch (Exception $e) {
        echo "Échec de l'envoi de l'email. Erreur: {$mail->ErrorInfo}";
    }
}
?>

<form method="POST" action="">
    <input type="submit" value="Recevoir un mail !" name="mailform"/>
</form>
