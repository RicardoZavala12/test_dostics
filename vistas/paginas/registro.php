<style>
      #textAllTitle{
        /*STYLE FOR THE FONT*/   
        color: black;
        font-size: 36px;
        font-family: 'Rajdhani', sans-serif;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
      }
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
<br><br><br><br><br><br><br><br>

<div style="width:auto;">
<?php
        /******************************************
        Forma de instancia a un método no estactico
        *******************************************/
        /*
        $registro = new ControladorFormularios();
        $registro->ctrRegistro();
        */
        /******************************************
        Forma de instancia a un método estactico
        *******************************************/
        $registro = ControladorFormularios::ctrRegistro();
        if($registro == "ok"){
            echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>';

            echo '<div class="alert alert-success" style="text-align:center;">User sig in successfully</div>';
            //en 3 segundos se va ha cargar la página de inicio
            /*echo '<script>
            setTimeout(function(){
                window.location = "index.php";
            },3000);
            </script>';
            ==============================*/
        } else if ($registro == "error"){
            echo '<script>
                if(window.history.replaceState){
                    window.history.replaceState(null,null,window.location.href);
                }
            </script>';

            echo '<div class="alert alert-danger" style="text-align:center;">Error cant enter special caracter</div>';
        } else if ($registro != "") {
            echo '<div class="alert alert-danger" style="text-align:center;">Wrong to register</div>';
        }
        ?> 
    </div>
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
                    <input type="text" class="form-control" placeholder="Enter name" id="nombre" name="registroNombre">
                </div>

                <div class="form-group">
                    <label for="nombre">Last name</label>
                    <input type="text" class="form-control" placeholder="Last name" id="nombre" name="registroApp">
                </div>

                <div class="form-group">
                    <label for="nombre">CURP</label>
                    <input type="text" class="form-control" placeholder="CURP" id="nombre" name="registroCurp">
                </div>
            </div>

            <div class="col-md-6">
                <div class="form-group">
                    <label for="nombre">Kg</label>
                    <input type="number" class="form-control" placeholder="Kg" id="nombre" name="registroPeso">
                </div>

                <div class="form-group">
                    <label for="nombre">Height</label>
                    <input type="float" class="form-control" placeholder="Mts" id="nombre" name="registroAltura">
                </div>

                <div class="form-group">
                    <label for="activo">Gender</label>
                    <select class="form-control" id="activo" name="registroSex">
                        <option value=""></option>
                        <option value="MASCULINO">MASCULINO</option>
                        <option value="FEMENINO">FEMENINO</option>
                    </select>
                </div>              
            </div>
        </div>

        <div class="form-group" style="text align:center;">
                    <label for="activo">Place</label>
                    <select class="form-control" id="activo" name="registroZona">
                        <option value=""></option>
                        <option value="CENTRO">CENTRO</option>
                        <option value="NORTE">NORTE</option>
                        <option value="SUR">SUR</option>
                    </select>
                </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" placeholder="Email address" id="email" name="registroEmail">
        </div>

        <div class="form-group">
            <label for="pwd">Password</label>
            <input type="password" class="form-control" placeholder="Password" id="pwd" name="registroPassword">
        </div>

        <?php
        if (isset($_SESSION["validaringreso"]) && $_SESSION["validaringreso"]) {
            echo '<br><button type="submit" class="btn btn-success">Save user</button>';
        } else {
            echo '<br><button type="submit" class="btn btn-success">Sign in</button>';
        } ?>  
    </form>
</div>
