<?php

//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class Mail {
    public static function sendConfirmationMail($destinataire,$url){
        $sujet = 'Sujet de l\'email';
        $message = "
            <html style='width: 100vw; height: 100vh; padding: 0; margin: 0;'>
                    <head>
                        <meta charset='utf-8'>
                    </head>
                    <body style='display: flex; flex-direction: column; justify-content: center; align-items: center;'> 
                        <div>
                            <h1>Confirmation de création de compte</h1>
                            <p><a href='$url' style='color: blue;'>Cliquez ici</a> pour valider la création de votre compte</p>
                        </div>
                    </body>
            </html>
            
        ";
        $headers = "From: \"expediteur moi\"<moi@domaine.com>\n";
        $headers .= "Reply-To: contact@bottle-trick-shop.com\n";
        $headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
        return mail($destinataire, $sujet, $message, $headers);
    }
}