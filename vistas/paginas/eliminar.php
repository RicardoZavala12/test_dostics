<?php
$usuarios = ControladorFormularios::ctrSeleccionarRegistros(null,null);
?>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<tbody id="tablaBody">
    <?php foreach ($usuarios as $key => $value): ?>
        <tr class="registro">
            <td><?php echo ($key + 1); ?></td>
            <td><?php echo $value["nombre"]; ?></td>
            <td>
                <form method="post" id="GLOWKITY">
                                <input type="hidden" name="eliminarRegistro" value="<?php echo $value["token"]; ?>">
                                <a class="btn btn-danger" onclick="confirmDelete('<?php echo $value['token']; ?>')">Delete</button></a>
                                <?php 
                                    $eliminar = new ControladorFormularios();
                                    $eliminar->ctrEliminarRegistro();
                                ?>
                            </form>
            </td>
        </tr>
    <?php endforeach ?>
</tbody>

<script>
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
</script>
