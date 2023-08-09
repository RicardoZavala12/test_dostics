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
<br><br><br><br><br>
        <div style="width:auto;">
    <?php
            $ingreso = new ControladorFormularios();
            $ingreso->ctrIngreso();
        ?> 
    </div>
<div id="textAllForm" class="d-flex justify-content-center text-center signin-form">
    <form class="p-5 bg-light" method="POST" id="form_signin">
    <label id="textAllTitle"for="email">LOG IN</label>
    <br><br>
        <div class="form-group">
            <label for="email">Email</label>
            
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Email address"
                 id="email" name="ingresoEmail">
            </div>
        </div>
<br><br>
        <div class="form-group">
            <label for="pwd">Password</label>
            
            <div class="input-group">
                <input type="password" class="form-control" placeholder="Password"
                 id="pwd" name="ingresoPassword">
            </div>
          
        </div>
<br><br>
        <button type="submit" class="btn btn-primary">Go</button>
       
    </form>
</div>