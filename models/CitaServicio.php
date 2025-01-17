<?php
namespace Model;
use Model\ActiveRecord;

class CitaServicio extends ActiveRecord{
    protected static $tabla = 'citasservicios';
    protected static $columnasDB = ['citas_id', 'servicios_id', 'id'];
    public $citas_id;
    public $servicios_id;
    public $id;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->citas_id = $args['citas_id'] ?? '';
        $this->servicios_id = $args['servicios_id'] ?? '';
    }


}