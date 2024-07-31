<?php
namespace Controllers;

use Model\AdminCita;
use MVC\Router;
class AdminController{
    public static function index(Router $router){
        session_start();
        isAdmin();
        $fecha = $_GET['fecha'] ?? date('Y-m-d', strtotime("-1 day")) ;
        $fechas = explode('-',$fecha);

        if(!checkdate($fechas[1],$fechas[2], $fechas[0] )){
            header("Location /404");
        }

        
        $nombre = $_SESSION['nombre'];

        $sql = "SELECT
                citas.id,
                citas.hora,
                CONCAT(usuarios.nombre, ' ', usuarios.apellido) as cliente,
                usuarios.email,
                usuarios.telefono,
                servicios.nombre as servicio,
                servicios.precio
            FROM
                citas
                LEFT OUTER JOIN usuarios ON citas.usuarios_id = usuarios.id
                LEFT OUTER JOIN citasservicios ON citasservicios.citas_id = citas.id
                LEFT OUTER JOIN servicios ON servicios.id = citasservicios.servicios_id WHERE fecha = '${fecha}';";//TODO: falta el where de 
                                                                                           //fecha
           
           $cita =  AdminCita::SQL($sql);


        $router->render('admin/index',[
            'nombre' => $nombre,
            'citas' => $cita,
            'fecha' => $fecha

        ]);

    }
}