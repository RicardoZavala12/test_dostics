<?php

class Conexion {

    static public function conectar(){
        #PDO ("nombre del servidor, nombre bd", usuario, password)

        $link = new PDO("mysql:host=localhost;dbname=db_5tsm1", "root", "");

        $link->exec("set names utf8");

        return $link;
    }
}