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
        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['EMAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['EMAIL_PORT'];
        $email->Username = $_ENV['EMAIL_USER'];
        $email->Password = $_ENV['EMAIL_PASS'];


        $email->setFrom('antoniopro69@gmail.com');
        $email->addAddress('appsalon@app.com', 'Appsalon.com');
        $email->Subject = 'Confirma tu cuenta';

        $email->isHTML(true);
        $email->CharSet = 'UTF-8';

        $contenido = '<html> ';
        $contenido.= "<p>Hola: ". $this->nombre ." Has creado una cuenta en nuestra pagina confirma presionando el siguiente enlace</p>";
        $contenido.= "<p>Presiona aqui: <a href = '".$_ENV['APP_URL']."/confirmar-cuenta?token=".$this->token."'>Confimar Cuenta</a></p>";
        $contenido.= "<p>Si tu no solistaste este registro solo ignoralo</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        $email->send();
    }
    public function enviarInstrucciones(){

        $email = new PHPMailer();
        $email->isSMTP();
        $email->Host = $_ENV['EMAIL_HOST'];
        $email->SMTPAuth = true;
        $email->Port = $_ENV['EMAIL_PORT'];
        $email->Username = $_ENV['EMAIL_USER'];
        $email->Password = $_ENV['EMAIL_PASS'];

        $email->setFrom('antoniopro69@gmail.com');
        $email->addAddress('appsalon@app.com', 'Appsalon.com');
        $email->Subject = 'Restablece tu password';

        $email->isHTML(true);
        $email->CharSet = 'UTF-8';

        $contenido = '<html> ';
        $contenido.= "<p>Hola: ". $this->nombre ." has solicitado restablecer tu password</p>";
        $contenido.= "<p>Presiona aqui: <a href = '".$_ENV['APP_URL']."/recuperar?token=".$this->token."'>Restablece tu password</a></p>";
        $contenido.= "<p>Si tu no solistaste este registro solo ignoralo</p>";
        $contenido .= '</html>';

        $email->Body = $contenido;

        $email->send();



    }


}