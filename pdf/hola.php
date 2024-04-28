<?php
require('fpdf.php');

$pdf=new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'¡Hola, Mundo!');
$pdf->Cell(60,10,'Hecho con FPDF.',0,1,'C');
$pdf->Cell(60,10,'Hecho con FPDF.',0,1,'C');
$pdf->Output();

// $pdf=new FPDF('L','mm','A4');
//SetMargins( );
//$pdf->Cell(40,10,'¡Hola, Mundo!',1);
//$pdf->Cell(60,10,'Hecho con FPDF.',0,1,'C');
//Ln( )

?>