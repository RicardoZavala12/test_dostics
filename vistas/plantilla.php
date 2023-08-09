<?php 
session_start();
?>
<style>
.image-container {
    width: 100%;
    max-width: 100%;
    display: flex;
    justify-content: center;
}

img.carousel {
    width: 100%;
    height: auto;
}

.image-container {
    position: relative;
}

.button-overlay {
    position: absolute;
    top: 45%;
    left: 50%;
    transform: translate(-50%, -50%);
    display: flex; /* Establece el contenedor de botones como un flex container */
}

#boton_encima1:hover {
    padding: 10px 20px;
    margin-right: 55px; /* Agrega margen derecho entre los botones */
    border-radius: 20px;
    border: transparent;
        background: #051937;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
        width: 100%; 
        font-size: 50px;
}
#boton_encima2:hover {
    padding: 10px 20px;
    margin-left: 55px; /* Agrega margen derecho entre los botones */
    border-radius: 20px;
    border: transparent;
        background: #051937;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
        width: 150%; 
        font-size: 50px;
}

#boton_encima1 {
    padding: 10px 20px;
    margin-right: 85px; /* Agrega margen derecho entre los botones */
    border-radius: 20px;
    border: hidden;
        background: transparent;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
        width: 150px; 
        font-size: 40px;
}
#boton_encima2 {
    padding: 10px 20px;
    margin-left: 85px; /* Agrega margen derecho entre los botones */
    border-radius: 20px;
        border: hidden;
        background: transparent;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
        width: 150%; 
        font-size: 40px;
}

a{
        /*STYLE FOR THE FONT*/   
        color: rgba(255, 255, 255, 0.93);
        font-size: 2px;
        font-family: 'Rajdhani', sans-serif;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
      }
      #textAll{
        /*STYLE FOR THE FONT*/   
        color: rgba(255, 255, 255, 0.93);
        font-size: 36px;
        font-family: 'Rajdhani', sans-serif;
        font-style: normal;
        font-weight: 700;
        line-height: normal;
      }

      #header-fixed {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 999; 
        background-color: #ffffff;
        background: transparent;
      height: 100vh;
            height: 250px;
    }
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      user-select: none;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }

    body {
      background:linear-gradient(to right top, #051937, #004d7a, #008793, #00bf72, #a8eb12);
      height: 500px;
    }
    #boton_navbar_active,
#boton_navbar_active:hover,
#boton_navbar:hover {
        border-radius: 20px;
        border: 1px solid rgba(0, 0, 0, 0.45);
        background: #051937;
        box-shadow: 0px 4px 4px 0px rgba(0, 0, 0, 0.25) inset;
        width: 150px; /* Ancho fijo para los botones */
        
    }
    #presentacion {
    position: relative; /* Agregamos esta propiedad para crear un contexto de apilamiento */
    border-radius: 10px;
    overflow: hidden; /* Aseguramos que el contenido no se salga del contenedor */
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
    background-size: cover;
    filter: blur(10px); /* Ajusta el valor de desenfoque según tu preferencia */
    opacity: 0.8; /* Ajusta la opacidad según tu preferencia */
}

#presentacion::before {
    content: ''; /* Pseudo-elemento para crear el fondo con efecto borroso */
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-size: cover;
    filter: blur(10px); /* Ajusta el valor de desenfoque según tu preferencia */
    opacity: 0.8; /* Ajusta la opacidad según tu preferencia */
    z-index: -1; /* Colocamos el fondo detrás del contenido */
}


</style>


<?php
if (isset($_SESSION["validaringreso"]) && $_SESSION["validaringreso"]) {
    echo '<div class="sep" id="header-fixed">
    <h3 id="textAll" style="font-size:26px;">I M C</h3>
    <h3 id="textAll">REPORTES</h3>
              <nav class="navbar navbar-expand-lg navbar-dark" aria-label="Tenth navbar example">
                  <div class="container-fluid">
                      <div class="collapse navbar-collapse justify-content-md-center" id="navbarsExample08">
                          <div class="btn-line" style="display: flex; gap: 10px;">';
                              
    // Determinar la clase activa para la página seleccionada
    $activeClass = 'btn btn-lg btn text-white';
    $inactiveClass = 'btn btn-lg btn text-white';

    // Determinar la página activa y establecer la clase correspondiente
    $activePage = $_GET["pagina"];
    $usersListClass = ($activePage == "inicio") ? 'active' : '';
    $newUserClass = ($activePage == "registro" && !isset($_GET["user"])) ? 'active' : '';
    $newEventClass = ($activePage == "registroEvents" && !isset($_GET["event"])) ? 'active' : '';

    // Mostrar los botones con la clase apropiada dependiendo de cada interfaz
                              /************************/
if ($activePage == "inicio") {
  echo '<div class="dropdown">
            <a id="boton_navbar_active" class="' . $newUserClass . ' btn btn-lg btn text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LIST</a>
            <div class="dropdown-menu" aria-labelledby="boton_navbar" style="border-radius:20px;">
              <a style="font-size: 22px;" class="dropdown-item " id="user" href="index.php?pagina=inicio">LIST USER</a>
            </div>
        </div>';

} else {
  echo '<div class="dropdown">
            <a id="boton_navbar" class="' . $inactiveClass . ' btn btn-lg btn text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">LIST</a>
            <div class="dropdown-menu" aria-labelledby="boton_navbar" style="border-radius:20px;">
            <a style="font-size: 22px;" class="dropdown-item " id="user" href="index.php?pagina=inicio">LIST USER</a>
            </div>
        </div>';
}

    if ($activePage == "registro") {
        echo '<div class="dropdown">
                  <a id="boton_navbar_active" class="' . $newUserClass . ' btn btn-lg btn text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADD USER</a>
                  <div class="dropdown-menu" aria-labelledby="boton_navbar" style="border-radius:20px;">
                    <a style="font-size: 22px;" class="dropdown-item " id="user" href="index.php?pagina=registro">NEW USER</a>
                  </div>
              </div>';
    } else{
        echo '<div class="dropdown">
                  <a id="boton_navbar" class="' . $inactiveClass . ' btn btn-lg btn text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">ADD</a>
                  <div class="dropdown-menu" aria-labelledby="boton_navbar" style="border-radius:20px;">
                    <a style="font-size: 22px;" class="dropdown-item " id="user" href="index.php?pagina=registro">NEW USER</a>
                  </div>
              </div>';
    }

    echo '<div class="dropdown">
                  <a id="boton_navbar" class="' . $inactiveClass . ' btn btn-lg btn text-white dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">OPTIONS</a>
                  <div class="dropdown-menu" aria-labelledby="boton_navbar" style="border-radius:20px;">
                    <a style="font-size: 22px;" class="dropdown-item" href="index.php?pagina=contacto">CONTACTO</a>
                    <a style="font-size: 22px;" class="dropdown-item" href="index.php?pagina=aboutus">ABOUT US</a>
                    <a style="font-size: 22px;" class="dropdown-item" href="index.php?pagina=salir">EXIT</a>
                  </div>
              </div>';

    echo '</div></div></div></div></nav></div>';
} else {
    echo '<div class="sep" id="header-fixed">
              <br>
            <a href="index.php"></a>
            <h3 id="textAll" style="font-size:26px;">I M C</h3>
            <h3 id="textAll">REPORTES</h3>
        </div>
        
        <main class="container-fluid" style="background: transparent;">
        <div class="container py-5"><br><br><br>      
        <div class="row p-4 pb-0 pe-lg-0 pt-lg-5 align-items-center shadow-lg">
            <div class="col-lg-7 p-3 p-lg-5 pt-lg-3">
                <h1 class="display-4 fw-bold lh-1">Border hero with cropped image and shadows</h1>
                <p class="lead">Quickly design and customize responsive mobile-first sites with Bootstrap, the world’s most popular front-end open source toolkit, featuring Sass variables and mixins, responsive grid system, extensive prebuilt components, and powerful JavaScript plugins.</p>
                <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4 mb-lg-3">
                    <a id="boton_encima1" class="btn btn-lg btn-primary" href="index.php?pagina=registro">SIGNUP</a>
                    <a id="boton_encima2" class="btn btn-lg btn-primary" href="index.php?pagina=ingreso">LOGIN</a>
                </div>
            </div>
            <div class="col-lg-4 offset-lg-1 p-0 overflow-hidden shadow-lg">
                <img class="rounded-lg-3" src="./vistas/css/img/home.jpg"  width="700" >
            </div>
        </div>
    </div>';
}

?>   
          <?php 
          #isset: isset() Determinar si una variable esta definida y no es NULL
          if(isset($_GET["pagina"])){
            #Filtrar las página blancas
            if($_GET["pagina"] == "registro" ||
            $_GET["pagina"] == "ingreso" ||
            $_GET["pagina"] == "registroEvents" ||
            $_GET["pagina"] == "inicio" ||
            $_GET["pagina"] == "inicioEvents" ||
            $_GET["pagina"] == "editar" ||
            $_GET["pagina"] == "editarUsers" ||
            $_GET["pagina"] == "salir"
              ){
                include "paginas/" . $_GET["pagina"] . ".php";
              } else {
                include "paginas/error404.php";
              }
              if (isset($_GET["pagina"]) && $_GET["pagina"] === "registro" ||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "ingreso"||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "registroEvents"||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "inicio"||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "inicioEvents"||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "editar"||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "editarUsers"||  
                  isset($_GET["pagina"]) && $_GET["pagina"] === "salir") {
                // Si $_GET["pagina"] es igual a "registro", establecemos una variable JavaScript para ocultar el botón
                echo '<script>document.addEventListener("DOMContentLoaded", function() { 
                  document.getElementById("boton_encima1").style.display = "none";
                  document.getElementById("boton_encima2").style.display = "none";
              });</script>';
            }          
          } 
          ?>
        </div>
    </div>
</main>
<?php
include_once 'vistas/layouts/footer.php';
?>