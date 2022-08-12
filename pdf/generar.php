<?php
require_once 'fpdf/fpdf.php';
//require_once 'library/conexion.php';
//require_once "library/configServer.php";
//require_once "library/consulSQL.php";
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetTitle("Ventas");
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(40,10,'Factura de Ventas');
//$config = mysqli_query($conexion, "SELECT * FROM pedido");
//$datos = mysqli_fetch_assoc($config);
/*$consultaC=ejecutarSQL::consultar("SELECT * FROM venta WHERE NIT='".$_SESSION['UserNIT']."'");
$datos = mysqli_fetch_assoc($consultaC);
$pdf->Cell(195, 5, utf8_decode($datos['nombre']), 0, 1, 'C');*/
//$pdf->Image("nuevologo.png", 180, 10, 30, 30);



$pdf->Output("ventas.pdf", "I");
?>
