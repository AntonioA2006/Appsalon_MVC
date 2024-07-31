<?php

namespace Model;
class Usuario extends ActiveRecord{

    protected static $tabla = 'usuarios';
    protected static $columnasDB = ['id', 'nombre', 'apellido', 'email', 'password', 'telefono', 'admin', 'confirmado', 'token'];

    public $id;
    public $nombre;
    public $apellido;
    public $email;
    public $telefono;
    public $admin;
    public $confirmado;
    public $token;
    public $password;
    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->admin = $args['admin'] ?? '0';
        $this->confirmado = $args['confirmado'] ?? '0';
        $this->token = $args['token'] ?? '';
        $this->password = $args['password'] ?? '';
    }
    public function validarNuevaCuenta(){
        if(!$this->nombre){
             self::$alertas['error'][] = 'el nombre es obligatorio';
        }
        if(!$this->apellido){
             self::$alertas['error'][] = 'el apellido es obligatorio';
        }
        if(!$this->email){
             self::$alertas['error'][] = 'el email es obligatorio';
        }
        if(!$this->password){
             self::$alertas['error'][] = 'el email es obligatorio';
        }
        if(strlen($this->password) < 5){
            self::$alertas['error'][] = 'el password debe contener 6 caracteres como minimo';
        }
        if(!preg_match('/^\d{10}$/',$this->telefono)){
            self::$alertas['error'][] = 'el formato del numero telefonico no es valido';
        }
        return self::$alertas;
       
    }
    public function existeUsuario(){
        $query = "SELECT email FROM " . self::$tabla . " WHERE email = '"  . $this->email . "' LIMIT 1;" ;
        $resultado = self::$db->query($query);

        if ($resultado->num_rows) {
            # code..
            self::$alertas['error'][] = 'el usuario ya existe';
        }

        return $resultado;
    }
    public function hasPassword(){
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    public function crearToken(){
        $this->token = uniqid();
    }
    public function validarLogin(){
        if (!$this->email) {
           self::$alertas['error'][] = 'el email es oblgatorio';
        }
        if (!$this->password) {
           self::$alertas['error'][] = 'el password es oblgatorio';
        }
        return self::$alertas;
    }
    public function verificar_Usuario($password){
        $resultado =  password_verify($password,$this->password );
       if (!$resultado || !$this->confirmado) {
            self::$alertas['error'][] = 'Password incorrecto o tu cuenta no a sido confirmada';
       }else{
          return true;
       }
    }
    public function validarEmail(){
        if (!$this->email) {
            self::$alertas['error'][] = 'el email es obligatorio';
     }
     return self::$alertas;

    }
    public function validarPassword(){
        if (!$this->password) {
            self::$alertas['error'][] = 'el password es obligatorio';
        }
        if(strlen($this->password) < 6){
            self::$alertas['error'][] = 'el password debe contener al menos 6 caracteres';

        }
        return self::$alertas;
    }



}