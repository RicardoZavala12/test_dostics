<?php
require_once 'vendor/autoload.php'; // Ajusta la ruta según tu estructura

use Mpdf\Mpdf;

// Recibir el token de la URL
if (isset($_GET['token'])) {
    $token = $_GET['token'];
    
    // Obtener los datos del usuario asociados al token (puedes adaptar esto según tu lógica)
    // Por ejemplo, asumiendo que tienes un array llamado $usuarios con todos los usuarios
    $usuarios = ControladorFormularios::ctrSeleccionarRegistros(null,null);
    $userData = null;
    foreach ($usuarios as $usuario) {
        if ($usuario['token'] === $token) {
            $userData = $usuario;
            break;
        }
    }

    if ($userData) {
        // Crear una instancia de MPDF
        $mpdf = new Mpdf();

        // Crear el contenido del PDF con los datos del usuario
        $html = '<h1>Detalles del Usuario</h1>';
        $html .= '<p>Nombre: ' . $userData['nombre'] . '</p>';
        $html .= '<p>Apellido: ' . $userData['apellido'] . '</p>';
        // Agrega aquí los demás datos que deseas mostrar en el PDF

        // Agregar el contenido al PDF
        $mpdf->WriteHTML($html);

        // Generar el PDF y enviarlo al navegador para descarga
        $mpdf->Output('user_details.pdf', 'D');
        exit();
    } else {
        echo 'Usuario no encontrado';
    }
} else {
    echo 'Token no proporcionado';
}
?>