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


    $menu = new ControladorFormularios();
    $usuarios = $menu->ctrSeleccionarRegistros(null,null);

    
    foreach ($usuarios as $key => $value) {
        echo $value["nombre"];
    }
    

    require_once $IncludTCPPDFPath;
    $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('Reportes IMC | Ricardo Zavala');
    $pdf->SetTitle('Reporte | Zona NORTE');

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
        <h1>SECRETARIA DE SALUD</h1>
        <h3>Reporte de personas por zona "NORTE"</h3>
        <br><br>
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
        </style>
        
        <table>
            <tr>
                <td>Nombre</td>
                <td>Apellido</td>
                <td>Edad</td>
                <td>Fecha de Nacimiento</td>
                <td>Peso (Kg)</td>
                <td>Altura (metros)</td>
                <td>Peso Ideal</td>
            </tr>';

            foreach ($usuarios as $row) {
                if ($row['zona'] === 'NORTE') {
                    $curpSubstring = substr($row['curp'], 4, 6);
                    $html .= 
                    '<tr>
                        <td>' . $row['nombre'] . '</td>
                        <td>' . $row['apellido'] . '</td>
                        <td>' . $row['edad'] . '</td>
                        <td>' . $curpSubstring . '</td>
                        <td>' . $row['peso'] . '</td>
                        <td>' . $row['altura'] . '</td>
                        <td>' . $row['peso_ideal'] . '</td>
                    </tr>';
                }
            }

    $html.=' 
            </table>';

    $pdf->writeHTML($html, true, false, false, false, 'C');

    // move pointer to last page
    $pdf->lastPage();
    ob_end_clean();
    // ---------------------------------------------------------

    //Close and output PDF document
    $pdf->Output('RT_ZonaNorte.pdf', 'I');

?>