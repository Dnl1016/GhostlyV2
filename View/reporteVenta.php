<?php
require('../Lib/fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Arial bold 15
    $this->SetFont('Arial','B',18);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(60,10,'REPORTE DE VENTAS',0,0,'C');
    // Salto de línea
    $this->Ln(20);

    $this-> cell(20, 10, '#', 1, 0, 'C', 0);
    $this-> cell(80, 10, 'Nombre Venta', 1, 0, 'C', 0);
    $this-> cell(40, 10, 'Fecha Venta', 1, 0, 'C', 0);
    $this-> cell(25, 10, 'Valor', 1, 0, 'C', 0);
    
    $this-> cell(25, 10, 'Persona', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10, utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}

require_once("../Controller/ConexionDB.php");
$consulta= "SELECT * FROM ventas";
$resultado= $ConexionDB->query($consulta);

$pdf = new PDF();
$pdf-> AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);

while ($row= $resultado->fetch()) {
    $pdf-> cell(20, 10, $row['idVenta'], 1, 0, 'C', 0);
    $pdf-> cell(80, 10, $row['nombre'], 1, 0, 'C', 0);
    $pdf-> cell(40, 10, $row['fechaVenta'], 1, 0, 'C', 0);
    $pdf-> cell(25, 10, $row['valor'], 1, 0, 'C', 0);
  
    $pdf-> cell(25, 10, $row['idPersona'], 1, 1, 'C', 0);
}

$pdf->Output();
?>