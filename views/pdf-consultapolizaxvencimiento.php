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

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../assets/logo.png',10,8,33);
    // Arial bold 15
    $this->SetFont('Arial','B',12);
    // Movernos a la derecha
    $this->Ln(5);
    $this->Cell(60);
    
    // Título
    $this->Cell(75,10,'Listado de Vencimientos de Polizas',1,0,'C');
    // Salto de línea
    $this->Ln(20);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

$txtAccion = (isset($_POST["accion"])) ? $_POST["accion"] : "";
$vencimientodesde = (isset($_POST["fechadesde"])) ? $_POST["fechadesde"] : "";
$vencimientohasta = (isset($_POST["fechahasta"])) ? $_POST["fechahasta"] : "";

$txPolizaModel = new PolizaModel();
$listapolizas = $txPolizaModel->BuscarporVigenciahasta($vencimientodesde, $vencimientohasta);

/* Impresion en Archivo PDF */

//PDF USING MULTIPLE PAGES

//Create new pdf file
//$pdf=new FPDF();
$pdf = new PDF();
//Disable automatic page break
$pdf->SetAutoPageBreak(false);
$pdf->AliasNbPages();
//Add first page
$pdf->AddPage();

//set initial y axis position per page
$y_axis_initial = 35;
$y_axis = 25;
$row_height = 16;

//print column titles
/*
    $pdf->SetFillColor(255,0,0);
    $pdf->SetTextColor(255);
    $pdf->SetDrawColor(128,0,0);
    $pdf->SetLineWidth(.3);
    $pdf->SetFont('','B');
*/

$pdf->SetFillColor(232,232,232);
$pdf->SetFont('Arial','B',8);
$pdf->SetY($y_axis_initial);
$pdf->SetX(10);
$pdf->Cell(25,6,'Poliza',1,0,'C',1);
$pdf->Cell(15,6,'Endoso',1,0,'C',1);
$pdf->Cell(45,6,'Asegurado',1,0,'C',1);
$pdf->Cell(20,6,'Emision',1,0,'C',1);
$pdf->Cell(20,6,'Vig.desde',1,0,'C',1);
$pdf->Cell(20,6,'hasta',1,0,'C',1);
$pdf->Cell(50,6,'Suma Asegurada',1,0,'C',1);

$y_axis = $y_axis + $row_height;

//initialize counter
$i = 0;

//Set maximum rows per page
$max = 25;

//Set Row Height
$row_height = 6;
$fill = false;
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
    if ($i == $max)
    {
        $pdf->AddPage();
        
        //print column titles for the current page
        $pdf->SetY($y_axis_initial);
        $pdf->SetX(10);
        $pdf->Cell(25,6,'Poliza',1,0,'C',1);
        $pdf->Cell(15,6,'Endoso',1,0,'C',1);
        $pdf->Cell(45,6,'Asegurado',1,0,'C',1);
        $pdf->Cell(20,6,'Emision',1,0,'C',1);
        $pdf->Cell(20,6,'Vig.desde',1,0,'C',1);
        $pdf->Cell(20,6,'hasta',1,0,'C',1);
        $pdf->Cell(30,6,'Suma Asegurada',1,0,'C',1);
        //Go to next row
        $y_axis = $y_axis + $row_height;
        
        //Set $i variable to 0 (first row)
        $i = 0;
    }
    $pdf->SetFillColor(224,235,255);
    $pdf->SetTextColor(0);
    $pdf->SetFont('');

    $pdf->SetY($y_axis);
    $pdf->SetX(10);
    $pdf->Cell(25,6,$polizanro,1,0,'C',$fill);
    $pdf->Cell(15,6,$endoso,1,0,'C',$fill);
    $pdf->Cell(45,6,$asegurado,1,0,'L',$fill);
    $pdf->Cell(20,6,$emision,1,0,'C',$fill);
    $pdf->Cell(20,6,$vigenciadesde,1,0,'C',$fill);
    $pdf->Cell(20,6,$vigenciahasta,1,0,'C',$fill);
    $pdf->Cell(50,6,$suma,1,0,'C',$fill);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
    $pdf->SetY($y_axis);
    $pdf->SetX(35);    
    $pdf->Cell(170,6,"Descripcion: ".$descripcion,1,0,'L',$fill);
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
    $pdf->SetY($y_axis);
    $pdf->SetX(35);        
    $pdf->Cell(170,6,"Cobertura: ".$cobertura,1,0,'L',$fill);
    //Go to next row
    $y_axis = $y_axis + $row_height;
    $i = $i + 1;
    //$pdf->Ln();
    $fill = !$fill;
}

//Send file
$pdf->Output();

?>