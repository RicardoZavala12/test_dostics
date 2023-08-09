
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
                echo '<div class="alert alert-success">El usuario ha sido actualizado</div>';
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
                echo '<div class="alert alert-danger">Error al actualizar el usuario</div>';
            }
        ?> 
<label for="data_table" id="textAll" style="text-align:center;">UPDATE USER: <?php echo $usuario["nombre"]; ?></label>
<div class="d-flex justify-content-center text-center">
    <form class="p-5 bg-light" method="POST">

        <div class="form-group">
            <label for="nombre">Name</label>
            
            <div class="input-group">
                <input type="text" class="form-control" 
                    placeholder="Introduce el nombre"
                    value="<?php echo $usuario["nombre"]; ?>"
                    id="nombre" name="actualizarNombre">
            </div>
            
        </div>
        <div class="form-group">
            <label for="nombre">Last name</label>
            
            <div class="input-group">
                <input type="text" class="form-control" 
                    placeholder="Introduce el apellido"
                    value="<?php echo $usuario["apellido"]; ?>"
                    id="nombre" name="actualizarApp">
            </div>
            
        </div>

        <div class="form-group">
            <label for="nombre">Curp</label>
            
            <div class="input-group">
                <input type="text" class="form-control" 
                    placeholder="Introduce curp"
                    value="<?php echo $usuario["curp"]; ?>"
                    id="curp" name="actualizarCurp">
            </div>
            
        </div>

        <div class="form-group">
            <label for="nombre">Age</label>
            
            <div class="input-group">
                <input type="text" class="form-control" 
                    placeholder="Introduce el nombre"
                    value="<?php echo $usuario["edad"]; ?>"
                    id="nombre" name="actualizarEdad">
            </div>
            
        </div>

        <div class="form-group">
            <label for="nombre">Kg</label>
            
            <div class="input-group">
                <input type="text" class="form-control" 
                    placeholder="Introduce el nombre"
                    value="<?php echo $usuario["peso"]; ?>"
                    id="nombre" name="actualizarPeso">
            </div>
            
        </div>

        <div class="form-group">
            <label for="nombre">Heigh</label>
            
            <div class="input-group">
                <input type="text" class="form-control" 
                    placeholder="Introduce el nombre"
                    value="<?php echo $usuario["altura"]; ?>"
                    id="nombre" name="actualizarAltura">
            </div>  
        </div>

        <div class="form-group">
            <label for="activo">Gender</label>
            
            <div class="input-group">
                 <select class="form-control" id="activo" name="actualizarSexo">
                 <option value=""><?php 
                 if($usuario["sexo"] == 'M'){
                    echo'MASCULINO';
                 }else{echo'FEMENINO';}
                 ?></option>
                    <option value="M">MASCULINO</option>
                    <option value="F">FEMENINO</option>
                </select>
            </div>
        </div>

        <div class="form-group">
            <label for="nombre">Place</label>
            <div class="input-group">
                 <select class="form-control" id="activo" name="actualizarZona">
                 <option value=""><?php echo $usuario["zona"]; ?></option>
                    <option value="CENTRO">CENTRO</option>
                    <option value="NORTE">NORTE</option>
                    <option value="NORTE">SUR</option>
                </select>
            </div> 
        </div>

        
        <div class="form-group">
            <label for="email">Email</label>
            
            <div class="input-group">
                <input type="email" class="form-control" 
                    placeholder="email"
                    value="<?php echo $usuario["email"]; ?>"
                    id="email" name="actualizarEmail">
            </div>
            
        </div>

        <div class="form-group">
            <label for="pwd">Password</label>
            
            <div class="input-group">
                <input type="password" class="form-control" 
                    placeholder=" password"
                    id="pwd" name="actualizarPassword">
            </div>

            <input type="hidden" name="passwordActual"
            value="<?php echo $usuario["password"]; ?>">

            <input type="hidden" name="token" 
            value="<?php echo $usuario["token"]; ?>">

            <input type="hidden" name="idUsuario"
            value="<?php echo $usuario["id"]; ?>">
            
        </div>


        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>