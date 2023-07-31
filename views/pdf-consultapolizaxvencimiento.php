<?php
include_once("../controller/conexion.php");
include_once("../model/poliza.php");
include_once("../controller/polizacontroller.php");
include_once("../model/compania.php");
include_once("../controller/companiacontroller.php");
include_once("../model/seccion.php");
include_once("../controller/seccioncontroller.php");
include_once("../model/asegurado.php");
include_once("../controller/aseguradocontroller.php");
require("../controller/fpdf.php");

// datos 
$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$vencimientodesde = (isset($_POST["fechadesde"])) ? $_POST["fechadesde"] : "";
$vencimientohasta = (isset($_POST["fechahasta"])) ? $_POST["fechahasta"] : "";
$titulo = (isset($_POST["titulo"])) ? $_POST["titulo"] : "";

$txPolizaModel = new PolizaModel();
$listapolizas = $txPolizaModel->BuscarporVigenciahasta($vencimientodesde, $vencimientohasta);


class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        $this->Image('../assets/logo.png', 10, 8, 33);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 12);
        // Movernos a la derecha
        $this->Ln(5);
        $this->Cell(60);

        // Título
        $titulo = "Vencimientos de Polizas";
        $this->Cell(55, 10, $titulo, 1, 0, 'C');
        $this->Cell(60);
        $this->SetFont('Arial', '', 8);
        $this->Cell(5, 10, date("d/m/Y"), 0, 0, 'C');
        // Salto de línea
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Número de página
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}


/* Impresion en Archivo PDF */

$pdf = new PDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
$pdf->AliasNbPages();

//set initial y axis position per page
$y_axis_initial = 45;
$y_axis = 25;
$row_height = 16;
$y_axis = $y_axis + $row_height;

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;
$fill = false;

$companiacorte = " ";
$seccioncorte = " ";

foreach ($listapolizas as $poliza) {

    $compania = $poliza['nombre_compania'];
    $seccion = $poliza['nombre_seccion'];
    $polizanro = $poliza['poliza_nro'];
    $endoso = $poliza['endoso_nro'];
    $emision = date('d/m/Y', strtotime($poliza['fecha_emision']));
    $asegurado = $poliza['apellido_y_nombre_asegurado'];
    $vigenciadesde = date('d/m/Y', strtotime($poliza['vigencia_desde']));
    $vigenciahasta = date('d/m/Y', strtotime($poliza['vigencia_hasta']));
    $descripcion = $poliza['descripcion_asegurado'];
    $cobertura = $poliza['cobertura_asegurado'];
    $suma = $poliza['suma_asegurada'];

    //If the current row is the last one, create new page and print column title
    if ($i == $max || $i == 0) {
        $pdf->AddPage();
        //print column titles for the current page
        if ($companiacorte <> $compania || $seccioncorte <> $seccion) {
            $pdf->SetX(10);
            $pdf->SetFont('Arial','', 10);
            $pdf->Cell(20, 10, iconv("UTF-8", "ISO-8859-1", "Compañia: "), 0, 0, 'C');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(55, 10, iconv("UTF-8", "ISO-8859-1", $compania), 0, 0, 'L');
            $pdf->SetFont('Arial','', 10);
            $pdf->Cell(15, 10, iconv("UTF-8", "ISO-8859-1", "Sección: "), 0, 0, 'C');
            $pdf->SetFont('Arial', 'B', 10);
            $pdf->Cell(35, 10, iconv("UTF-8", "ISO-8859-1", $seccion), 0, 0, 'L');
            $companiacorte = $compania;
            $seccioncorte = $seccion;
            $y_axis = $y_axis + $row_height;
            $i = $i + 1;
            $pdf->SetY($y_axis);

            $pdf->SetFillColor(232, 232, 232);
            $pdf->SetLineWidth(.2);
            $pdf->SetFont('Arial', 'B', 8);
            $pdf->SetY($y_axis);
            $pdf->Cell(25, 6, 'Poliza', 1, 0, 'C', 1);
            $pdf->Cell(15, 6, 'Endoso', 1, 0, 'C', 1);
            $pdf->Cell(45, 6, 'Asegurado', 1, 0, 'C', 1);
            $pdf->Cell(20, 6, 'Emision', 1, 0, 'C', 1);
            $pdf->Cell(20, 6, 'Vig.desde', 1, 0, 'C', 1);
            $pdf->Cell(20, 6, 'hasta', 1, 0, 'C', 1);
            $pdf->Cell(50, 6, 'Suma Asegurada', 1, 0, 'C', 1);
            //Go to next row
            $y_axis = $y_axis + $row_height;
            //Set $i variable to 0 (first row)
            $i = 0;
            $fill = false;
        }
    }

    if ($companiacorte <> $compania || $seccioncorte <> $seccion) {
        $y_axis = $y_axis + $row_height;
        $pdf->SetY($y_axis);
        $pdf->SetX(10);
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(20, 10, iconv("UTF-8", "ISO-8859-1", "Compañia: "), 0, 0, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(55, 10, iconv("UTF-8", "ISO-8859-1", $compania), 0, 0, 'L');
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(15, 10, iconv("UTF-8", "ISO-8859-1", "Sección: "), 0, 0, 'C');
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(35, 10, iconv("UTF-8", "ISO-8859-1", $seccion), 0, 0, 'L');
        $companiacorte = $compania;
        $seccioncorte = $seccion;
        $y_axis = $y_axis + $row_height;
        $y_axis = $y_axis + $row_height;        
        $i = $i + 1;
        $pdf->SetY($y_axis);
        $pdf->SetFillColor(232, 232, 232);
        $pdf->SetLineWidth(.2);
        $pdf->SetFont('Arial', 'B', 8);
        $pdf->SetY($y_axis);
        $pdf->Cell(25, 6, 'Poliza', 1, 0, 'C', 1);
        $pdf->Cell(15, 6, 'Endoso', 1, 0, 'C', 1);
        $pdf->Cell(45, 6, 'Asegurado', 1, 0, 'C', 1);
        $pdf->Cell(20, 6, 'Emision', 1, 0, 'C', 1);
        $pdf->Cell(20, 6, 'Vig.desde', 1, 0, 'C', 1);
        $pdf->Cell(20, 6, 'hasta', 1, 0, 'C', 1);
        $pdf->Cell(50, 6, 'Suma Asegurada', 1, 0, 'C', 1);
        //Go to next row
        $y_axis = $y_axis + $row_height;        
        $fill = false;

    }

    $pdf->SetFillColor(224, 235, 255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');

    $pdf->SetY($y_axis);
    $pdf->SetX(10);    
    $pdf->Cell(25, 6, iconv("UTF-8", "ISO-8859-1", $polizanro), 1, 0, 'C', $fill);
    $pdf->Cell(15, 6, iconv("UTF-8", "ISO-8859-1", $endoso), 1, 0, 'C', $fill);
    $pdf->Cell(45, 6, iconv("UTF-8", "ISO-8859-1", $asegurado), 1, 0, 'L', $fill);
    $pdf->Cell(20, 6, iconv("UTF-8", "ISO-8859-1", $emision), 1, 0, 'C', $fill);
    $pdf->Cell(20, 6, iconv("UTF-8", "ISO-8859-1", $vigenciadesde), 1, 0, 'C', $fill);
    $pdf->Cell(20, 6, iconv("UTF-8", "ISO-8859-1", $vigenciahasta), 1, 0, 'C', $fill);
    $pdf->Cell(50, 6, iconv("UTF-8", "ISO-8859-1", $suma), 1, 0, 'C', $fill);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
    $pdf->SetY($y_axis);
    $pdf->SetX(35);
    $pdf->Cell(170, 6, "Descripcion: " . iconv("UTF-8", "ISO-8859-1", $descripcion), 1, 0, 'L', $fill);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
    $pdf->SetY($y_axis);
    $pdf->SetX(35);
    $pdf->Cell(170, 6, "Cobertura: " . iconv("UTF-8", "ISO-8859-1", $cobertura), 1, 0, 'L', $fill);
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
    //$pdf->Ln();
    $fill = !$fill;
}

//Send file
$pdf->Output();
