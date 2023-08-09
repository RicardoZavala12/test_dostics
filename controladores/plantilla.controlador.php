<?php
class ControladorPlantilla{

    /***************************
    Llamada a la plantilla
    ****************************/
    public function ctrTraerPlantilla(){
        #include() para cargar algún archivo
        include 'vistas/plantilla.php';
    }
    
}