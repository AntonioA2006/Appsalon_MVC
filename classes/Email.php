<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email{
    public $email;
    public $nombre;
    public $token;


    public function __construct($email = '', $nombre = '', $token = '')
    {
        $this->email = $email;
        $this->nombre = $nombre;
        $this->token = $token;
    }
    public function enviarConfirmacion(){
        try {
            $email = new PHPMailer(true); // Habilita el manejo de excepciones
    
            // Configuración del servidor SMTP
            $email->isSMTP();
            $email->Host = $_ENV['EMAIL_HOST'];
            $email->SMTPAuth = true;
            $email->Port = $_ENV['EMAIL_PORT'];
            $email->Username = $_ENV['EMAIL_USER'];
            $email->Password = $_ENV['EMAIL_PASSWORD'];
    
            // Configuración del protocolo de seguridad
            if ($_ENV['EMAIL_PORT'] == 465) {
                $email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            } else {
                $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            }
    
            // Configuración del correo
            $email->setFrom('antoniotraderxd@gmail.com', 'Antonio AS');
            $email->addAddress($this->email, $this->nombre);
            $email->Subject = 'Confirma tu cuenta';
            
            $email->isHTML(true);
            $email->CharSet = 'UTF-8';
    
            $contenido = '<html>';
            $contenido .= "<p>Hola: " . htmlspecialchars($this->nombre) . "</p>";
            $contenido .= "<p>Has creado una cuenta en nuestra página. Confirma presionando el siguiente enlace:</p>";
            $contenido .= "<p>Presiona aquí: <a href='" . htmlspecialchars($_ENV['APP_URL']) . "/confirmar-cuenta?token=" . urlencode($this->token) . "'>Confirmar Cuenta</a></p>";
            $contenido .= "<p>Si tú no solicitaste este registro, solo ignóralo.</p>";
            $contenido .= '</html>';
            
            $email->Body = $contenido;
    
            // Habilita la depuración
            $email->SMTPDebug = 2;
    
            // Envía el correo
            if (!$email->send()) {
                echo 'El mensaje no pudo ser enviado. Error: ' . $email->ErrorInfo;
            } else {
                echo 'El mensaje ha sido enviado';
            }
        } catch (Exception $e) {
            debuguear ('Error: ' . $e->getMessage());
        }
    }
    
    public function enviarInstrucciones(){

        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['EMAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['EMAIL_PORT'];
        $email->Username = $_ENV['EMAIL_USER'];
        $email->Password = $_ENV['EMAIL_PASSWORD'];
        
        // Configuración del protocolo de seguridad
        if ($_ENV['EMAIL_PORT'] == 465) {
            $email->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        } else {
            $email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        }
        
        $email->setFrom('appsalon@gmail.com');
        $email->addAddress($this->email);
        $email->Subject = 'restablece tu password';

        $email->isHTML(true);
        $email->CharSet = 'UTF-8';

        $contenido = '<html> ';
        $contenido.= "<p>Hola: ". $this->nombre ." has solicitado restablecer tu password</p>";
        $contenido.= "<p>Presiona aqui: <a href = '".$_ENV['APP_URL']."/recuperar?token=".$this->token."'>Restablece tu password</a></p>";
        $contenido.= "<p>Si tu no solistaste este registro solo ignoralo</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;
        if (!$mail->send()) {
            debuguear ('Error al enviar el mensaje: ' . $mail->ErrorInfo);
        }



    }


}