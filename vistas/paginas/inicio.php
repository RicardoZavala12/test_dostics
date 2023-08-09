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

$usuarios = ControladorFormularios::ctrSeleccionarRegistros(null,null);
?>

<style>
          #data_table{
            background-color: rgba(255, 255, 255, 1.5); /* Opacidad del formulario */
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6); /* Sombra para resaltar el formulario */
            opacity: 0.9; /* Opacidad del fondo borroso */
            /*z-index: 12;  Coloca el fondo borroso detrás del contenido */
        }
</style>
<br><br><br><br><br><br><br><br><br><br>
<table id="data_table" class="table table-striped">
    <thead>
        <tr>
        <label for="data_table" id="textAll" style="text-align:center;">USUARIOS</label>
            <th>#</th>
            <th>Nombre</th>
            <th>Appellido</th>
            <th>Edad</th>
            <th>CURP</th>
            <th>Peso</th>
            <th>Altura</th>
            <th>Sexo</th>
            <th>Zona</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
    <?php foreach($usuarios as $key => $value): ?>
        <tr>
            <td><?php echo ($key + 1); ?></td>
            <td><?php echo $value["nombre"]; ?></td>
            <td><?php echo $value["apellido"]; ?></td>
            <td><?php echo $value["edad"]; ?></td>
            <td><?php echo $value["curp"]; ?></td>
            <td><?php echo $value["peso"]; ?></td>
            <td><?php echo $value["altura"]; ?></td>
            <td><?php echo $value["sexo"]; ?></td>
            <td><?php echo $value["zona"]; ?></td>
            <td><?php echo $value["email"]; ?></td>
            <td><?php echo $value["fecha"]; ?></td>
            <td>
                <div class="btn-group">
                    <div class="px-1">
                        <a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>" class="btn btn-warning">ð</a>
                    </div>

                    <form method="post">
                        <input type="hidden" name="eliminarRegistro" 
                        value="<?php echo $value["token"]; ?>">
                        <button type="submit" class="btn btn-danger">
                        -

                        </button>
                        <?php 
                            $eliminar = new ControladorFormularios();
                            $eliminar->ctrEliminarRegistro();
                        ?>
                    </form>
                    
                </div>
            </td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>
