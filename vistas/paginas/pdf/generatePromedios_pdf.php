<?php

    // Obtener la ruta al directorio actual
$currentDirectory = dirname(__FILE__);

// Construir la ruta al archivo formularios.controlador.php
$formulariosControladorPath = $currentDirectory . '/../../../controladores/formularios.controlador.php';
$formulariosModeloPath = $currentDirectory . '/../../../modelos/formularios.modelo.php';
$IncludTCPPDFPath = $currentDirectory . '/../../../vistas/assets/tcpdf/tcpdf_include.php';

// Incluir el archivo formularios.controlador.php
require_once $formulariosControladorPath;
require_once $formulariosModeloPath;



// Llamar al controlador
    $menu = new ControladorFormularios();
    $usuarios = $menu->ctrSeleccionarRegistros(null,null);

    
   
    

    require_once $IncludTCPPDFPath;
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Reportes IMC | Ricardo Zavala');
    $pdf->SetTitle('Reporte | PROMEDIOS');

    $pdf->setPrintHeader(false);
    $pdf->setPrintFooter(false);

    $pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

    $pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

    $pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

    $pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
    $pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

    $pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

    $pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

    if (@file_exists(dirname(__FILE__) . '/lang/eng.php')) {
        require_once(dirname(__FILE__) . '/lang/eng.php');
        $pdf->setLanguageArray($l);
    }

    $pdf->SetFont('helvetica', '', 11);

    $pdf->AddPage();

    $html = '
        <style>
            h1{
                font-family: Arial, Helvetica, sans-serif;
            }
        </style>
    ';

    $html.='
        <style>
            table {
                border-collapse: collapse;
                margin-top: 100px;
            }
            th{
                vertical-align:middle;
            }

            table, th, td {
                border: 1px solid black;
            }
            table > tr > th {
                font-weight: bold; 
                text-align: center;
                vertical-align: middle;
                color: black;
                height: 40px;
            }

            table > tr > td {
                font-weight: bold; 
                text-align: center;
                color: black;
                height: 40px;
            }
        </style>';
        $totalPeso = 0; 

        $promediosPorZona = array(
            'NORTE' => array('total' => 0, 'contador' => 0),
            'CENTRO' => array('total' => 0, 'contador' => 0),
            'SUR' => array('total' => 0, 'contador' => 0)
        );
        
        foreach ($usuarios as $row) {
            // Agregar el peso al total correspondiente a la zona
            $promediosPorZona[$row['zona']]['total'] += $row['peso'];
            // Incrementar el contador de registros para la zona
            $promediosPorZona[$row['zona']]['contador']++;
        }
        
        $html = '
        
        <h1>SECRETARIA DE SALUD</h1>
        <h3>Promedio de peso de Cada Zona</h3>
        <br>
        <table>
        <tr style="color:red;">
        <td style="color: red;">ZONA</td>
        <td style="color: red;">PROMEDIO</td>
        </tr>  ';
   /*************************************** PROMEDIO POR CADA ZONA *************************/     
        foreach ($promediosPorZona as $zona => $promedio) {
            // Calcular el promedio para la zona actual
            if ($promedio['contador'] > 0) {
                $promedioPeso = $promedio['total'] / $promedio['contador'];
            } else {
                $promedioPeso = 0;
            }
        
            // Agregar una fila a la tabla con la zona y el promedio
            $html .= '<tr>
                <td>' . $zona . '</td>
                <td style="color: green;">' . $promedioPeso . '</td>
            </tr>';
        }

/*************************************** PROMEDIO CON MAYOR SOBREPESO **************************************/   

$html.=' 
</table>
<h3>Zona con mayor sobrepeso</h3>
<br><br>';

            $zonasConSobrepeso = array(
                'NORTE' => 0,
                'CENTRO' => 0,
                'SUR' => 0
            );
            foreach ($usuarios as $row) {
                if ($row['nivel_peso'] === 'SOBREPESO') {
                    $zonasConSobrepeso[$row['zona']]++;
                }
            }
            foreach ($zonasConSobrepeso as $zona => $cantidadSobrepeso) {
                if ($cantidadSobrepeso > $maxSobrepeso) {
                    $maxSobrepeso = $cantidadSobrepeso;
                    $zonaMaxSobrepeso = $zona;
                }
            }
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">ZONA</td>
        <td style="color: red;">NÚMERO DE PERSONAS</td>
        </tr>
       
        <tr>
            <td>'.$zonaMaxSobrepeso.'</td>
            <td style="color: green;">'.$maxSobrepeso .'</td>
        </tr>';
        
/***************************************** PROMEDIO CON BAJO PESO *******************************************/   

$html.=' 
</table><br>
<h3>Zona de Personas con más Bajo peso</h3>
<br><br>';

            $zonasConBajopeso = array(
                'NORTE' => 0,
                'CENTRO' => 0,
                'SUR' => 0
            );
            foreach ($usuarios as $row) {
                if ($row['nivel_peso'] === 'BAJO PESO') {
                    $zonasConBajopeso[$row['zona']]++;
                }
            }
            foreach ($zonasConBajopeso as $zona => $cantidadBajopeso) {
                if ($cantidadBajopeso > $maxBajopeso) {
                    $maxBajopeso = $cantidadBajopeso;
                    $zonaMaxBajopeso = $zona;
                }
            }
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">ZONA</td>
        <td style="color: red;">NÚMERO DE PERSONAS</td>
        </tr>
       
        <tr>
            <td>'.$zonaMaxBajopeso.'</td>
            <td style="color: green;">'.$maxBajopeso .'</td>
        </tr>';
        
/******************************* PROMEDIO POR ADULTOS DE LA TERCERA EDAD CON SOBREPESO ***************************/   

$html.=' 
</table><br>
<h3>Zona con más Personas de la Tercera edad con Sobrepeso</h3>
<br><br>';

            $zonasSobrePesoTrEdad = array(
                'NORTE' => 0,
                'CENTRO' => 0,
                'SUR' => 0
            );
            foreach ($usuarios as $row) {
                if ($row['edad'] >= 65 AND $row['nivel_peso'] === 'SOBREPESO') {
                    $zonasSobrePesoTrEdad[$row['zona']]++;
                }
            }
            foreach ($zonasSobrePesoTrEdad as $zona => $cantidadSobrePesoTrEdad) {
                if ($cantidadSobrePesoTrEdad > $maxSobrePesoTrEdad) {
                    $maxSobrePesoTrEdad = $cantidadSobrePesoTrEdad;
                    $zonaSobrePesoTrEdad = $zona;
                }
            }
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">ZONA</td>
        <td style="color: red;">TOTAL DE PERSONAS</td>
        </tr>
       
        <tr>
            <td>'.$zonaSobrePesoTrEdad.'</td>
            <td style="color: green;">'.$maxSobrePesoTrEdad .'</td>
        </tr>';
        
/**************************************** PROMEDIO POR ADULTOS CON SOBREPESO ****************************************/   

$html.=' 
</table><br>
<h3>Zona con más Adultos con Sobrepeso</h3>
<br><br>';

            $zonasAdultosSobrepeso = array(
                'NORTE' => 0,
                'CENTRO' => 0,
                'SUR' => 0
            );
            foreach ($usuarios as $row) {
                if ($row['edad'] >= 30 AND $row['edad'] <= 59 AND $row['nivel_peso'] === 'SOBREPESO') {
                    $zonasAdultosSobrepeso[$row['zona']]++;
                }
            }
            foreach ($zonasAdultosSobrepeso as $zona => $cantidadAdultosSobrepeso) {
                if ($cantidadAdultosSobrepeso > $maxAdultosSobrepeso) {
                    $maxAdultosSobrepeso = $cantidadAdultosSobrepeso;
                    $zonaAdultosSobrepeso = $zona;
                }
            }
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">ZONA</td>
        <td style="color: red;">NÚMERO DE PERSONAS</td>
        </tr>
       
        <tr>
            <td>'.$zonaAdultosSobrepeso.'</td>
            <td style="color: green;">'.$maxAdultosSobrepeso .'</td>
        </tr>';
        
/*************************************** TOTAL DE PERSONAS CON PESO NORMAL *********************************************/   
$html.=' 
</table><br>
<h3>Total de Personas con PESO NORMAL</h3>
<br><br>';

$totalPersonasPesoNormal = 0;

foreach ($usuarios as $row) {
    if ($row['nivel_peso'] === 'PESO NORMAL') {
        $totalPersonasPesoNormal++;
    }
}
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">TOTAL</td>
        <td style="color: green;">'.$totalPersonasPesoNormal .'</td>
        </tr> ';
/***************************************** TOTAL DE PERSONAS CON SOBREPESO *******************************************/   

$html.='
</table>
<h3>Total de Personas con SOBREPESO</h3>
<br><br>';

$totalPersonasSobrePeso = 0;

foreach ($usuarios as $row) {
    if ($row['nivel_peso'] === 'SOBREPESO') {
        $totalPersonasSobrePeso++;
    }
}
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">TOTAL</td>
        <td style="color: green;">'.$totalPersonasSobrePeso .'</td>
        </tr>';
/****************************************** TOTAL DE PERSONAS CON BAJO PESO ***************************************/  
$html.=' 
</table><br>
<h3>Total de Personas con BAJO PESO</h3>
<br><br>';

$totalPersonasBajoPeso = 0;

foreach ($usuarios as $row) {
    if ($row['nivel_peso'] === 'BAJO PESO') {
        $totalPersonasBajoPeso++;
    }
}
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">TOTAL</td>
        <td style="color: green;">'.$totalPersonasBajoPeso .'</td>
        </tr>';
/**************************************** TOTAL DE PERSONAS CON OBECIDAD ***************************************/  
$html.=' 
</table><br>
<h3>Total de Personas con OBECIDAD</h3>
<br><br>';

$totalPersonasObecidad = 0;

foreach ($usuarios as $row) {
    if ($row['nivel_peso'] === 'OBECIDAD') {
        $totalPersonasObecidad++;
    }
}
            $html.='

        
        <table>
        <tr>
        <td style="color: red;">TOTAL</td>
        <td style="color: green;">'.$totalPersonasObecidad .'</td>
        </tr>';
/**********************************************************************************************************/  
            $html.='
        <style>
            table {
                border-collapse: collapse;
                margin-top: 100px;
            }
            th{
                vertical-align:middle;
            }

            table, th, td {
                border: 1px solid black;
            }
            table > tr > th {
                font-weight: bold; 
                text-align: center;
                vertical-align: middle;
                color: black;
                height: 40px;
            }

            table > tr > td {
                font-weight: bold; 
                text-align: center;
                color: black;
                height: 40px;
            }
        </style>';
    $html.=' 
            <h3 style="color:blue;"> Created by Ricardo Zavala · © 2023 </h3>
            </table>';
/***************************************************************************************/

    $pdf->writeHTML($html, true, false, false, false, 'C');

    // move pointer to last page
    $pdf->lastPage();
    ob_end_clean();
    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('EjemploTCPDF.pdf', 'I');

?>