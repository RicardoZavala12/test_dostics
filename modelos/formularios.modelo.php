<?php

require_once "conexion.php";

class ModeloFormularios{

    /**********************
     * Registro
     ********************/
    static public function mdlRegistro($tabla, $datos){
        #statement --- declaración del sql
        #prepare() --- Pararar la sensencia

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla (token,nombre,apellido,curp,edad,peso,peso_ideal,nivel_peso,imc,altura,sexo,zona,email, password) 
            VALUES (:token,:nombre,:apellido,:curp,:edad,:peso,:peso_ideal,:nivel_peso,:imc,:altura,:sexo,:zona, :email, :password) ");
        
        #bindParam() vincular los parámetros

        $stmt->bindParam(":token",$datos["token"],PDO::PARAM_STR);
        $stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
        $stmt->bindParam(":apellido",$datos["apellido"],PDO::PARAM_STR);
        $stmt->bindParam(":curp",$datos["curp"],PDO::PARAM_STR);
        $stmt->bindParam(":edad",$datos["edad"],PDO::PARAM_STR);
        $stmt->bindParam(":peso",$datos["peso"],PDO::PARAM_STR);
        $stmt->bindParam(":peso_ideal",$datos["peso_ideal"],PDO::PARAM_STR);
        $stmt->bindParam(":nivel_peso",$datos["nivel_peso"],PDO::PARAM_STR);
        $stmt->bindParam(":imc",$datos["imc"],PDO::PARAM_STR);
        $stmt->bindParam(":altura",$datos["altura"],PDO::PARAM_STR);
        $stmt->bindParam(":sexo",$datos["sexo"],PDO::PARAM_STR);
        $stmt->bindParam(":zona",$datos["zona"],PDO::PARAM_STR);
        $stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
        $stmt->bindParam(":password",$datos["password"],PDO::PARAM_STR);

        #Ejecutar y verificar
        if ($stmt->execute()){
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
        //cerrar la conexión
        $stmt->close();
        $stmt = null();
    }

    /************************
     * Seleccionar Registros
     ************************/
    static public function mdlSeleccionarRegistros($tabla,$item,$valor){
        if($item == null && $valor == null){
            $sql = "SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla ORDER BY id DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll();
        } else {
            $sql = "SELECT *, DATE_FORMAT(fecha, '%d/%m/%Y') AS fecha FROM $tabla WHERE $item = :$item ORDER BY id DESC";
            $stmt = Conexion::conectar()->prepare($sql);
            $stmt->bindParam(":".$item, $valor, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetch();
        }

    }

    /************************
     * Actualizar Registros
     ************************/
    static public function mdlActualizarRegistro($tabla, $datos){  
        $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET token=:token, nombre=:nombre, apellido=:apellido,curp=:curp, edad=:edad,peso=:peso,peso_ideal=:peso_ideal,
        nivel_peso=:nivel_peso,imc=:imc,altura=:altura,sexo=:sexo,zona=:zona, email=:email, password=:password WHERE id=:id");
        //pasar los parámetros
        $stmt->bindParam(":token", $datos["token"], PDO::PARAM_STR);
        $stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
        $stmt->bindParam(":apellido", $datos["apellido"], PDO::PARAM_STR);
        $stmt->bindParam(":curp", $datos["curp"], PDO::PARAM_STR);
        $stmt->bindParam(":edad", $datos["edad"], PDO::PARAM_STR);
        $stmt->bindParam(":peso", $datos["peso"], PDO::PARAM_STR);
        $stmt->bindParam(":peso_ideal", $datos["peso_ideal"], PDO::PARAM_STR);
        $stmt->bindParam(":nivel_peso", $datos["nivel_peso"], PDO::PARAM_STR);
        $stmt->bindParam(":imc", $datos["imc"], PDO::PARAM_STR);
        $stmt->bindParam(":altura", $datos["altura"], PDO::PARAM_STR);
        $stmt->bindParam(":sexo", $datos["sexo"], PDO::PARAM_STR);
        $stmt->bindParam(":zona", $datos["zona"], PDO::PARAM_STR);
        $stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
        $stmt->bindParam(":password", $datos["password"], PDO::PARAM_STR);
        $stmt->bindParam(":id", $datos["id"], PDO::PARAM_STR);

        if($stmt->execute()){
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }

    /************************
     * Eliminar Registro
     ************************/
    static public function mdlEliminarRegistro($tabla, $valor){

        

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE token=:token");
        $stmt->bindParam(":token", $valor, PDO::PARAM_INT);
        if($stmt->execute()){
            return "ok";
        } else {
            print_r(Conexion::conectar()->errorInfo());
        }
    }

}
