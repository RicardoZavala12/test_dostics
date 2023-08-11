
<?php 
//Validar la existencia de la variable de sesión
if(!isset($_SESSION["validaringreso"])){
    echo '<script>window.location = "index.php?pagina=ingreso";</script>';
    return;
} else {
    if($_SESSION["validaringreso"] != "ok"){
        echo '<script>window.location = "index.php?pagina=ingreso";</script>';
        return;
    }
}

if(!isset($_GET["token"])){
    session_destroy();

    echo '<script>
        window.location="index.php?pagina=ingreso";
    </script>';

    return;
} else {
    //tomar el dato para la consulta
    $item = "token";
    $valor = $_GET["token"];

    $usuario = ControladorFormularios::ctrSeleccionarRegistros($item,$valor);
}
?>
<style>
          #textAllForm{
        /*STYLE FOR THE FONT*/   
        color: black;
        font-size: 20px;
        font-family: 'Rajdhani', sans-serif;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
      }
      #form_signin{
            background-color: rgba(255, 255, 255, 0.8); /* Opacidad del formulario */
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6); /* Sombra para resaltar el formulario */
            opacity: 0.87; /* Opacidad del fondo borroso */
            /*z-index: 12;  Coloca el fondo borroso detrás del contenido */
        }
</style>
<br><br><br><br><br><br><br><br><br>
<?php
            $actualizar = ControladorFormularios::ctrActualizarRegistro();
            //validar si se realizó la actualización
            if($actualizar == "ok"){
                //limpiar el cache
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                    </script>';
                //informar que se actualizó
                echo '<div class="alert alert-success" style="text-align:center;">User update successfully</div>';
                //en 3 segundos se va ha cargar la página de inicio
                echo '<script>
                    setTimeout(function(){
                        window.location = "index.php?pagina=inicio";
                    },1000);
                    </script>';

            }
            if($actualizar == "error"){
                //limpiar el cache
                echo '<script>
                    if(window.history.replaceState){
                        window.history.replaceState(null,null,window.location.href);
                    }
                    </script>';
                echo '<div class="alert alert-danger"style="text-align:center;">Error to update user</div>';
            }
        ?> 
<label for="data_table" id="textAll" style="text-align:center;">UPDATE USER: <?php echo $usuario["nombre"]; ?></label>

<div id="textAllForm" class="d-flex justify-content-center text-center signin-form">
    <form class="p-5 bg-light" method="POST" id="form_signin">
        <?php
        if (isset($_SESSION["validaringreso"]) && $_SESSION["validaringreso"]) {
            echo '<label id="textAllTitle" for="email">NEW USER</label>';
        } else {
            echo '<label id="textAllTitle" for="email">SIGN UP</label>';
        } ?>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Name</label>
                    <input type="text" class="form-control" placeholder="Enter name" id="nombre" name="actualizarNombre"
                    value="<?php echo $usuario["nombre"]; ?>">
                </div>

                <div class="form-group">
                    <label for="nombre">Last name</label>
                    <input type="text" class="form-control" placeholder="Last name" id="apellido" name="actualizarApp"
                    value="<?php echo $usuario["apellido"]; ?>">
                </div>

                <div class="form-group">
                    <label for="nombre">CURP</label>
                    <input type="text" class="form-control" placeholder="CURP" id="curp" name="actualizarCurp"
                    value="<?php echo $usuario["curp"]; ?>">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Kg</label>
                    <input type="number" class="form-control" placeholder="Kg" id="peso" name="actualizarPeso"
                    value="<?php echo $usuario["peso"]; ?>">
                </div>

                <div class="form-group">
                    <label for="nombre">Height</label>
                    <input type="number" class="form-control" placeholder="Mts" id="altura" name="actualizarAltura"
                    value="<?php echo $usuario["altura"]; ?>">
                </div>

                <div class="form-group">
                    <label for="activo">Gender</label>
                    <select class="form-control" id="activo" name="actualizarSexo">
                    <option <?php echo $usuario["sexo"] == 'M' ? 'selected' : ''; ?>>MASCULINO</option>
                    <option <?php echo $usuario["sexo"] == 'F' ? 'selected' : ''; ?>>FEMENINO</option>
                    </select>
                </div>              
            </div>
        </div>

        <div class="form-group" style="text align:center;">
                    <label for="activo">Place</label>
                    <select class="form-control" id="activo" name="actualizarZona">
                        <option <?php echo $usuario["zona"] == 'NORTE' ? 'selected' : ''; ?>>NORTE</option>
                        <option <?php echo $usuario["zona"] == 'CENTRO' ? 'selected' : ''; ?>>CENTRO</option>
                        <option <?php echo $usuario["zona"] == 'SUR' ? 'selected' : ''; ?>>SUR</option>
                    </select>
                </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="Email address" id="email" name="actualizarEmail"
            value="<?php echo $usuario["email"]; ?>">
        </div>

        <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" placeholder="Password" id="pwd" name="actualizarPassword">
        </div>

        <input type="hidden" name="passwordActual"
            value="<?php echo $usuario["password"]; ?>">

            <input type="hidden" name="token" 
            value="<?php echo $usuario["token"]; ?>">

            <input type="hidden" name="idUsuario"
            value="<?php echo $usuario["id"]; ?>">
            
            <br><button type="submit" class="btn btn-success">Update</button>
    </form>
</div>