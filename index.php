<?php
#index, es la puerta de entrada a la aplicación
#require() requerido
#include() incluir

require_once "controladores/plantilla.controlador.php";

#para el controlador de los formularios
require_once "controladores/formularios.controlador.php";
require_once "modelos/formularios.modelo.php";

//crear una instancia
$plantilla = new ControladorPlantilla();
$plantilla->ctrTraerPlantilla();


