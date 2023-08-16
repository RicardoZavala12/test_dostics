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
            <option value="all">All</option>
            <option value="zona">Place</option>
            <option value="peso">Overweight</option>
            <option value="MujerBajoPeso">Women with underweight</option>
            <option value="KidsSobrePeso">Childrens with obesity</option>
        </select>
    </div>
    <div class="mb-3 me-4" id="placeSelect" style="display: none;">
        <label for="placeOptions" class="text-white">Place Options</label>
        <select id="placeOptions" class="form-control">
            <option value="Select">Select</option>
            <option value="NORTE">NORTE</option>
            <option value="CENTRO">CENTRO</option>
            <option value="SUR">SUR</option>
        </select>
    </div>

    <div class="mb-1">
    <a href="vistas/paginas/pdf/generatePromedios_pdf.php" target="_blank" class="btn"><button class="btn btn-success">Generate averages</button></a>
    </div>
</div>

    <table id="data_table" class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Appellido</th>
                <th>Edad</th>
                <th>CURP</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>Peso ideal</th>
                <th>Nivel de peso</th>
                <th>IMC</th>
                <th>Sexo</th>
                <th>Zona</th>
                <th>Email</th>
                <th>Fecha</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody id="tablaBody">
        <?php foreach($usuarios as $key => $value): ?>
                <tr class="registro">
                    <td><?php echo ($key + 1); ?></td>
                    <td><?php echo $value["nombre"]; ?></td>
                    <td><?php echo $value["apellido"]; ?></td>
                    <td><?php echo $value["edad"]; ?></td>
                    <td><?php echo $value["curp"]; ?></td>
                    <td><?php echo $value["peso"]; ?></td>
                    <td><?php echo $value["altura"]; ?></td>
                    <td><?php echo $value["peso_ideal"]; ?></td>
                    <td><?php echo $value["nivel_peso"]; ?></td>
                    <td><?php echo $value["imc"]; ?></td>
                    <td><?php echo $value["sexo"]; ?></td>
                    <td><?php echo $value["zona"]; ?></td>
                    <td><?php echo $value["email"]; ?></td>
                    <td><?php echo $value["fecha"]; ?></td>
                    <td>
                        <div class="btn-group">
                            <div class="px-1">
                                <a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>" class="btn btn-success">n</a>
                            </div>
                            <div class="px-1">
                                <a href="index.php?pagina=editar&token=<?php echo $value["token"]; ?>" class="btn btn-warning">Edit</a>
                            </div>
                            <div class="px-1">
                                <a href="index.php?pagina=eliminar&token=<?php echo $value["token"]; ?>" class="btn btn-warning">Edit</a>
                            </div>
                            <form method="post" id="GLOWKITY">
                                <input type="hidden" name="eliminarRegistro" value="<?php echo $value["token"]; ?>">
                                <button class="btn btn-danger" onclick="confirmDelete('<?php echo $value['token']; ?>')">Delete</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const categoriaSelect = document.getElementById('categoria');
        const placeSelect = document.getElementById('placeSelect');
        const placeOptionsSelect = document.getElementById('placeOptions');
        const tablaBody = document.getElementById('tablaBody');
        const usuarios = <?php echo json_encode($usuarios); ?>;
        

        categoriaSelect.addEventListener('change', function() {
            if (categoriaSelect.value === 'all') {
                updateTable(usuarios);
                placeSelect.style.display = 'none';
            } else if (categoriaSelect.value === 'zona') {
                placeSelect.style.display = 'block';
            } else {
                placeSelect.style.display = 'none';
                filterAndDisplay(categoriaSelect.value);
            }
        });

        placeOptionsSelect.addEventListener('change', function() {

            if (placeOptionsSelect.value === 'NORTE') {
                filterAndDisplay(placeOptionsSelect.value);

            } if (placeOptionsSelect.value === 'CENTRO') {
                filterAndDisplay(placeOptionsSelect.value);
                
            } if (placeOptionsSelect.value === 'SUR') {
                filterAndDisplay(placeOptionsSelect.value);
            }
        });

        //let selectedValue = '';
        function filterAndDisplay(selectedValue) {
            
            let filteredUsers = [];

            if (selectedValue === 'peso') {
                filteredUsers = usuarios.filter(user => user.nivel_peso === 'SOBREPESO');
            } else if (selectedValue === 'MujerBajoPeso') {
                filteredUsers = usuarios.filter(user => user.sexo === 'FEMENINO' && user.nivel_peso === 'BAJO PESO');
            } else if (selectedValue === 'KidsSobrePeso') {
                filteredUsers = usuarios.filter(user => user.edad <= 12 && user.nivel_peso === 'OBECIDAD');
            } else if (selectedValue === 'SUR') {
                filteredUsers = usuarios.filter(user => user.zona === 'SUR');
            } else if (selectedValue === 'CENTRO') {
                filteredUsers = usuarios.filter(user => user.zona === 'CENTRO');
            } else if (selectedValue === 'NORTE') {
                filteredUsers = usuarios.filter(user => user.zona === 'NORTE');
            } 

            updateTable(filteredUsers, selectedValue);
            //selectedValue = selectedValue;
            createActionButtonPDF(selectedValue);
        }


        function updateTable(data,selectedValue) {
            const selectedPlace = placeOptionsSelect.value;
            tablaBody.innerHTML = '';

            data.forEach(function(value, key) {
                if (selectedPlace === 'Select' || value.zona === selectedPlace) {
                const newRow = createTableRow(key + 1, value);
                tablaBody.appendChild(newRow);
                }else { const newRow = createTableRow(key + 1, value);
                tablaBody.appendChild(newRow);}
            });
        }

        function createTableRow(index, data, selectedValue) {
            const row = document.createElement('tr');
            row.className = 'registro';

            const tableData = [
                index,
                data.nombre,
                data.apellido,
                data.edad,
                data.curp,
                data.peso,
                data.altura,
                data.peso_ideal,
                data.nivel_peso,
                data.imc,
                data.sexo,
                data.zona,
                data.email,
                data.fecha
            ];

            tableData.forEach(function(value) {
                const cell = document.createElement('td');
                cell.textContent = value;
                row.appendChild(cell);
            });

            const actionsCell = document.createElement('td');
            const actionsDiv = document.createElement('div');
            actionsDiv.className = 'btn-group';

            const pdfButton = createActionButtonPDF('PDF', 'btn-success', data.token, selectedValue);
            const editButton = createActionButton('Edit', 'btn-warning', 'index.php?pagina=editar&token=' + data.token);
            const deleteButton = createActionButtonDelete('x','btn-danger', data.token);


            actionsDiv.appendChild(pdfButton);
            actionsDiv.appendChild(editButton);
            actionsDiv.appendChild(deleteButton);
            actionsCell.appendChild(actionsDiv);
            row.appendChild(actionsCell);

            return row;
        }


         /*************************************************************/
            function createActionButtonPDF(text, className, token, selectedValue) {
                const button = document.createElement('button');
                button.textContent = text;
                button.className = 'btn ' + className;
                button.addEventListener('click', function() {
                    //selectedValue = 'CENTRO';
                    let pdfFile;
                    if (categoriaSelect.value === 'all') {
                        pdfFile = "generate_pdf.php";
                    } else if (categoriaSelect.value === 'peso') {
                        pdfFile = "generatePeso_pdf.php";
                    } else if (categoriaSelect.value === 'MujerBajoPeso') {
                        pdfFile = "generateMujerBajoPeso_pdf.php";
                    }else if (categoriaSelect.value === 'KidsSobrePeso') {
                        pdfFile = "generateNinoSobrePeso_pdf.php";
                    } else if (placeOptionsSelect.value === 'NORTE') {
                        pdfFile = "generateNORTE_pdf.php";
                    }else if (placeOptionsSelect.value === 'SUR') {
                        pdfFile = "generateSUR_pdf.php";
                    }else if (placeOptionsSelect.value === 'CENTRO') {
                        pdfFile = "generateCENTRO_pdf.php";
                    } else {
                        pdfFile = "generate_pdf.php";
                    }
                    window.open("vistas/paginas/pdf/" + pdfFile +  "?token=" + token, '_blank');
                });
                return button;
            }

                $(document).on("click", ".btn-successs", function() {
                    const token = $(this).data("token");
                    window.open("index.php?pagina=generatePromedios_pdf.php?token=" + token, '_blank');
                });
            /*************************************************************/


        function createActionButtonDelete(text, className, token) {
            const form = document.getElementById('GLOWKITY'); // Obtener el formulario por su ID
            const button = document.createElement('button');
            button.textContent = text;
            button.type = 'submit'; // Establecer el tipo de botón como "submit"
            button.className = 'btn ' + className;
            button.addEventListener('click', () => confirmDelete(token));
            //form.appendChild(button); // Agregar el botón al formulario
            return button;
        }
        
        function confirmDelete(token) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this user!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.createElement('form');
                form.method = 'post';
                form.id = 'GLOWKITY';
                //form.action = 'delete.php';

                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'eliminarRegistro';
                input.value = token;

                form.appendChild(input);
                document.body.appendChild(form);
                form.submit();
            }
        });
    }

        function createActionButton(text, className, link) {
            const button = document.createElement('a');
            button.textContent = text;
            button.className = 'btn ' + className;
            button.href = link;
            button.setAttribute('role', 'button');
            return button;
        }


        updateTable(usuarios);
    </script>




