
<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\AdminController;
use Controllers\ApiController;
use Controllers\LoginController;
use MVC\Router;
use Controllers\CitaController;
use Controllers\ServicioController;

$router = new Router();

//iniciar sesion
$router->get('/',[LoginController::class, 'index']);
$router->post('/',[LoginController::class, 'index']);

$router->get('/logout',[LoginController::class, 'logout']);

//recuperar password
$router->get('/olvide',[LoginController::class, 'olvide']);
$router->post('/olvide',[LoginController::class, 'olvide']);

$router->get('/recuperar',[LoginController::class, 'recuperar']);
$router->post('/recuperar',[LoginController::class, 'recuperar']);

$router->get('/crear-cuenta',[LoginController::class, 'crear']);
$router->post('/crear-cuenta',[LoginController::class, 'crear']);

$router->get('/confirmar-cuenta',[LoginController::class, 'confirmar']);
$router->get('/mensaje',[LoginController::class, 'mensaje']);

//AREA privada
    //rutas de usuarios admni 0  clientes
    $router->get('/admin', [AdminController::class, 'index']);
    $router->get('/cita', [CitaController::class, 'index']);
    //api para servicios exceptuando la de eliminar que es solo para admins
    $router->get('/api/servicios',[ApiController::class, 'index'] );
    $router->post('/api/citas',[ApiController::class, 'guardar']);
    $router->post('/api/eliminar',[ApiController::class, 'eliminar']);
    
    //CRUD para crear nuevos servicios
    
    $router->get('/servicios',[ServicioController::class, 'index']);

    $router->get('/servicios/crear',[ServicioController::class, 'crear']);
    $router->post('/servicios/crear',[ServicioController::class, 'crear']);

    $router->get('/servicios/actualizar',[ServicioController::class, 'actualizar']);
    $router->post('/servicios/actualizar',[ServicioController::class, 'actualizar']);
    
    $router->post('/servicios/eliminar',[ServicioController::class, 'eliminar']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();