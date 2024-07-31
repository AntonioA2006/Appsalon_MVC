<?php

namespace Controllers;

use Model\CitaServicio;
use Model\Cita;
use Model\Servicio;

class ApiController{
    public static function index(){
       $servicios =  Servicio::all();

       echo json_encode($servicios);
    }
    public static function guardar(){
        
              $cita = new Cita($_POST);
             $resultado = $cita->guardar();

           $id = $resultado['id'];
            
            $idServicios = explode(',',$_POST['servicios']);

            foreach ($idServicios as $idServicio) {
                $args = [
                    'citas_id' => $id,
                    'servicios_id' => $idServicio
                ];
                $citaServicio = new CitaServicio($args);
                $resultado = $citaServicio->guardar();
            }   



            $respuesta = [
                'resultado' => $resultado
            ];

             echo json_encode($respuesta);
            # code...
    }
    public static function eliminar(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $cita = Cita::find($id);
            $cita->eliminar();
            header("Location:". $_SERVER["HTTP_REFERER"]);
        }
    }
}