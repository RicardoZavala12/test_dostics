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
        #form_signin{
            background-color: rgba(255, 255, 255, 0.8); /* Opacidad del formulario */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.6); /* Sombra para resaltar el formulario */
            opacity: 0.87; /* Opacidad del fondo borroso */
            /*z-index: 12;  Coloca el fondo borroso detrás del contenido */
        }
</style>
<br><br><br><br><br><br><br><br><br><br>
<table id="data_table" class="table table-striped">
    <thead>
        <tr>
        <label for="data_table" id="textAll" style="text-align:center;">USUARIOS</label>
        
        <div class="d-flex justify-content-center align-items-center">
    <div class="mb-3 me-4" style="width: 100px; text-align: center;">
        <label for="categoria" class="text-white">Category</label>
        <select id="categoria" class="form-control">
            <option>Select</option>
            <option value="zona">Place</option>
            <option value="peso">Overweight</option>
            <option value="MujerSobrePeso">Women with underweight</option>
            <option value="Niñ@sSobrePeso">Childrens with obesity</option>
        </select>
    </div>
    <div class="mb-3" id="loop">
        <label for="busqueda" class="text-white">Search</label>
        <input type="text" id="busqueda" class="form-control">
    </div>
    <div class="mb-3" id="placeSelect" style="display: none;">
        <label for="placeOptions" class="text-white">Place Options</label>
        <select id="placeOptions" class="form-control">
            <option value="Select">Select</option>
            <option value="NORTE">NORTE</option>
            <option value="CENTRO">CENTRO</option>
            <option value="SUR">SUR</option>
        </select>
    </div>
</div>

<script>
    document.getElementById('categoria').addEventListener('change', function() {
        const selectedValue = this.value;
        const placeSelect = document.getElementById('placeSelect');
        const loopDiv = document.getElementById('loop');

        if (selectedValue === 'zona') {
            placeSelect.style.display = 'block';
            loopDiv.style.display = 'none';
        } else {
            placeSelect.style.display = 'none';
            loopDiv.style.display = 'block';
        }
    });
</script>



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
                        <a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>" class="btn btn-success">PDF</a>
                    </div>
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
