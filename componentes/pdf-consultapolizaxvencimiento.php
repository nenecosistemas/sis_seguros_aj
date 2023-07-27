<?php
include_once("../clases/conexion.php");
include_once("../clases/poliza.php");
include_once("../clases/polizamodel.php");
include_once("../clases/compania.php");
include_once("../clases/companiamodel.php");
include_once("../clases/seccion.php");
include_once("../clases/seccionmodel.php");
include_once("../clases/asegurado.php");
include_once("../clases/aseguradomodel.php");
require("../clases/fpdf.php");

$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$vencimientodesde = (isset($_POST["fechadesde"])) ? $_POST["fechadesde"] : "";
$vencimientohasta = (isset($_POST["fechahasta"])) ? $_POST["fechahasta"] : "";

$txPolizaModel = new PolizaModel();
$listapolizas = $txPolizaModel->BuscarporVigenciahasta($vencimientodesde, $vencimientohasta);

/* Impresion en Archivo PDF */

//PDF USING MULTIPLE PAGES

//Create new pdf file
$pdf=new FPDF();

//Disable automatic page break
$pdf->SetAutoPageBreak(false);

//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 25;
$y_axis = 0;
$row_height = 0;

//print column titles
$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',12);
$pdf->SetY($y_axis_initial);
$pdf->SetX(25);
$pdf->Cell(30,6,'Poliza',1,0,'L',1);
$pdf->Cell(100,6,'Endoso',1,0,'L',1);
$pdf->Cell(30,6,'Emision',1,0,'R',1);

$y_axis = $y_axis + $row_height;

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;

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
    
    //If the current row is the last one, create new page and print column title
    if ($i == $max)
    {
        $pdf->AddPage();
        
        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(25);
        $pdf->Cell(30,6,'Poliza',1,0,'L',1);
        $pdf->Cell(100,6,'Endoso',1,0,'L',1);
        $pdf->Cell(30,6,'Emision',1,0,'R',1);
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }

    $pdf->SetY($y_axis);
    $pdf->SetX(25);
    $pdf->Cell(30,6,$txtAccion,1,0,'L',1);
    $pdf->Cell(100,6,$endoso,1,0,'L',1);
    $pdf->Cell(30,6,$emision,1,0,'R',1);

    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
}

//Send file
$pdf->Output();

?>