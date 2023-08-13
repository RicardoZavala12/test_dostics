<?php

class ControladorFormularios{

    /*****************************
     * Registro usuario estáctico
     ******************************/
    static public function ctrRegistro(){
        #verificar si viene del formulario
        if(isset($_POST["registroNombre"])){
            //Filtrar la información que no tengo inyección de código
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["registroNombre"]) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["registroEmail"])&&
               preg_match('/^[0-9a-zA-Z]+$/',$_POST["registroPassword"]) ){

                $tabla = "users";

                //crear token
                $token = md5($_POST["registroNombre"] . "+" . $_POST["registroEmail"]);

                /************************** OBTENER EDAD DEL CURP ******************/
                $curp = $_POST["registroCurp"];
                $fechaNaci = substr($curp, 4, 6);
                $yearNacimiento = substr($fechaNaci, 0, 2);

                // Asegurarse de que el año de nacimiento esté en el formato correcto (2 dígitos)
                if ($yearNacimiento >= 40) {
                    // Agregar el siglo correspondiente al año de nacimiento
                    $fechaNaci = "19" . $fechaNaci;
                } else {
                    // Si el año de nacimiento es menor que 40, suponer que es del siglo 21
                    $fechaNaci = "20" . $fechaNaci;
                }

                $fechaNaciObj = DateTime::createFromFormat('Ymd', $fechaNaci);
                $fechaActual = new DateTime();
                $edad = $fechaNaciObj->diff($fechaActual)->y;

                 /***************** CALCULO PESO IDEAL M y F *******************/
                if($_POST["registroSex"] == 'MASCULINO'){
                    $altura = $_POST["registroAltura"];

                    $pesoIdeal = 50 + 0.555 * ($altura - 152.4);
                } else {
                    $altura = $_POST["registroAltura"];

                    $pesoIdeal = 45.5 + 0.535 * ($altura - 152.4);
                }
                //$pesoIdeal = 45.5;

                /************************* CALCULO IMC ************************/
                    $altura = $_POST["registroAltura"];
                    $peso = $_POST["registroPeso"];
                    $alturaMetros = $altura / 100;
                    $calculoIMC = $peso / ($alturaMetros ** 2);
                    $IMC = number_format($calculoIMC, 2);

                /************************* NIVEL DE PESO ************************/
                if($IMC <= 18.5){
                    $nivelPeso = "BAJO PESO";
                }if($IMC >= 18.5 AND $IMC <= 24.9){
                    $nivelPeso = "PESO NORMAL";
                }if($IMC >= 25 AND $IMC <= 29.9){
                    $nivelPeso = "SOBREPESO";
                }if($IMC >= 30){
                    $nivelPeso = "OBECIDAD";
                }

                /***************************** ENCRIPTAR EL PASSWORD ************************/
                $encriptarPassword = crypt($_POST["registroPassword"],'$2a$07$MarteJupiterDatosSabado20$');

                /********************************* FIN ENCRIPTAR ****************************/
                #la información del formulario
                $datos = array("token" => $token,
                            "nombre" => $_POST["registroNombre"],
                            "apellido" => $_POST["registroApp"],
                            "curp" => $_POST["registroCurp"],
                            "edad" => $edad,
                            "peso" => $_POST["registroPeso"],
                            "peso_ideal" => $pesoIdeal,
                            "nivel_peso" => $nivelPeso,
                            "imc" => $IMC,
                            "altura" => $_POST["registroAltura"],
                            "sexo" => $_POST["registroSex"],
                            "zona" => $_POST["registroZona"],
                            "email" => $_POST["registroEmail"],
                            "password" => $encriptarPassword);
                
                $respuesta = ModeloFormularios::mdlRegistro($tabla, $datos);
                
                return $respuesta;
            }  else {
                $respuesta = "error";
                return $respuesta;
            }
        }
        
    }

    /*****************************
     * Seleccionar usuarios
     ******************************/
    static public function ctrSeleccionarRegistros($item,$valor){
        $tabla = "users";

        $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla,$item,$valor);

        return $respuesta;
    }

    /*********************************
     * Ingreso
     *********************************/
    public function ctrIngreso(){
        if(isset($_POST["ingresoEmail"])){
            //Filtrar la información que no tengo inyección de código
            if(preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["ingresoEmail"])&&
               preg_match('/^[0-9a-zA-Z]+$/',$_POST["ingresoPassword"]) ){
                $tabla = "users";
                $item = "email";
                $valor = $_POST["ingresoEmail"];
                //LLamar la consulta
                $respuesta = ModeloFormularios::mdlSeleccionarRegistros($tabla,$item,$valor);
                
                /***************************** ENCRIPTAR EL PASSWORD ************************/
                $encriptarPassword = crypt($_POST["ingresoPassword"],'$2a$07$MarteJupiterDatosSabado20$');

                /********************************* FIN ENCRIPTAR ****************************/

                if ($respuesta != null){
                    //echo "Existe";
                    //Validar si esta registrado y son correctas las crendenciales
                    if ($respuesta["email"] == $_POST["ingresoEmail"] &&
                        $respuesta["password"] == $encriptarPassword){
                            $_SESSION["validaringreso"] = "ok";
                            echo '<script>
                                if(window.history.replaceState){
                                    window.history.replaceState(null,null,window.location.href);
                                }

                                window.location = "index.php?pagina=inicio";
                            </script>';
                        echo "Correcto";
                    } else {
                        echo '<script>
                            if(window.history.replaceState){
                                window.history.replaceState(null,null,window.location.href);
                            }
                        </script>';
                        echo '<div class="alert alert-danger">
                            Error al ingresar al sistema, email o contraseña incorrecta
                            </div>';
                    }
                    
                } else {
                    echo '<script>
                        if(window.history.replaceState){
                            window.history.replaceState(null,null,window.location.href);
                        }
                    </script>';
                    echo '<div class="alert alert-danger">
                        Error al ingresar al sistema, email o contraseña incorrecta
                        </div>';
                }
            } else {
                echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
                </script>';
                echo '<div class="alert alert-danger">
                    No se permiten caracteres especiales
                    </div>';
            } 

        }
    }

    /*********************************
     * Actualizar registro
     *********************************/
    static public function ctrActualizarRegistro(){
        if(isset($_POST["actualizarNombre"])){

            //Filtrar la información que no tengo inyección de código
            if(preg_match('/^[a-zA-ZñÑáéíóúÁÉÍÓÚ0-9 ]+$/',$_POST["actualizarNombre"]) &&
               preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["actualizarEmail"])
                ){

                //Validar el token
                $tabla = "users";
                $item = "token";
                $valor = $_POST["token"];
                $usuario = ModeloFormularios::mdlSeleccionarRegistros($tabla,$item,$valor);
                $compararToken = md5($usuario["nombre"] . "+" . $usuario["email"]);
                if($compararToken == $_POST["token"] && 
                    $_POST["idUsuario"] == $usuario["id"]){

                        //Validar si se va actualizar el password
                        if($_POST["actualizarPassword"] != ""){
                            $password = $_POST["actualizarPassword"];
                        } else {
                            $password = $_POST["passwordActual"];
                        }
                        //datos para el modelo
                        $actualizarToken = md5($_POST["actualizarNombre"] . "+" . $_POST["actualizarEmail"]);
                        $tabla = "users";

                         /******************* OBTENER EDAD DEL CURP ******************/
                         $curp = $_POST["actualizarCurp"];
                         $fechaNaci = substr($curp, 4, 6);
                         $yearNacimiento = substr($fechaNaci, 0, 2);
                         // Asegurarse de que el año de nacimiento esté en el formato correcto (2 dígitos)
                            if ($yearNacimiento >= 40) {
              
                              // Agregar el siglo correspondiente al año de nacimiento
                              $fechaNaci = "19" . $fechaNaci;
                            } else {
                                // Si el año de nacimiento es menor que 40 suponer que es del siglo 21
                                $fechaNaci = "20" . $fechaNaci;
                            }

                            $fechaNaciObj = DateTime::createFromFormat('Ymd', $fechaNaci);
                            $fechaActual = new DateTime();
                            $edad = $fechaNaciObj->diff($fechaActual)->y;

                        /***************** CALCULO PESO IDEAL M y F *******************/
                            if($_POST["actualizarSexo"] == 'MASCULINO'){
                                $altura = $_POST["actualizarAltura"];

                                $pesoIdeal = 50 + 0.555 * ($altura - 152.4);
                            } else {
                                $altura = $_POST["actualizarAltura"];

                                $pesoIdeal = 45.5 + 0.535 * ($altura - 152.4);
                            }
                            //$pesoIdeal = 45.5;

                            /************************* CALCULO IMC ************************/
                                $altura = $_POST["actualizarAltura"];
                                $peso = $_POST["actualizarPeso"];
                                $alturaMetros = $altura / 100;
                                $calculoIMC = $peso / ($alturaMetros ** 2);
                                $IMC = number_format($calculoIMC, 2);

                            /************************* NIVEL DE PESO ************************/
                            if($IMC <= 18.5){
                                $nivelPeso = "BAJO PESO";
                            }if($IMC >= 18.5 AND $IMC <= 24.9){
                                $nivelPeso = "PESO NORMAL";
                            }if($IMC >= 25 AND $IMC <= 29.9){
                                $nivelPeso = "SOBREPESO";
                            }if($IMC >= 30){
                                $nivelPeso = "OBECIDAD";
                            }
                            /**************************************************************/

                        $datos = array("id" => $_POST["idUsuario"],
                                    "token" => $actualizarToken,
                                    "nombre" => $_POST["actualizarNombre"],
                                    "apellido" => $_POST["actualizarApp"],
                                    "curp" => $_POST["actualizarCurp"],
                                    "edad" => $edad,
                                    "peso" => $_POST["actualizarPeso"],
                                    "peso_ideal" => $pesoIdeal,
                                    "nivel_peso" => $nivelPeso,
                                    "imc" => $IMC,
                                    "peso" => $_POST["actualizarPeso"],
                                    "altura" => $_POST["actualizarAltura"],
                                    "sexo" => $_POST["actualizarSexo"],
                                    "zona" => $_POST["actualizarZona"],
                                    "email" => $_POST["actualizarEmail"],
                                    "password" => $password);
                        $respuesta = ModeloFormularios::mdlActualizarRegistro($tabla,$datos);
                        return $respuesta;
                } else {
                    $respuesta = "error";
                    return $respuesta;
                }
            } else {
                $respuesta = "error";
                return $respuesta;
            }
        }
    }
 
    /*********************************
     * Eliminar registro
     *********************************/
    public function ctrEliminarRegistro(){
        //verificar el parámetro
        if(isset($_POST["eliminarRegistro"])){
            //los datos para el módelo
            $tabla = "users";
            $item = "token";
            $valor = $_POST["eliminarRegistro"];

            //Validar el token
            $usuario = ModeloFormularios::mdlSeleccionarRegistros($tabla,$item,$valor);
            $compararToken = md5($usuario["nombre"] . "+" . $usuario["email"]);

            if($compararToken == $_POST["eliminarRegistro"]){

            
                $respuesta = ModeloFormularios::mdlEliminarRegistro($tabla, $valor); 
                //verificar si fue exitoso
                if($respuesta == "ok"){
                    //limpiar el cache
                    echo '<script>
                        if (window.history.replaceState){
                            window.history.replaceState(null,null,window.location.href);
                        }
                        
                        window.location = "index.php?pagina=inicio";
                        </script>';
                }
            }
        }
    }

}

