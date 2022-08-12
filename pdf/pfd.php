<?php
require_once '../conexion.php';
require_once 'fpdf/fpdf.php';
$pdf = new FPDF('P', 'mm', 'letter');
$pdf->AddPage();
$pdf->SetMargins(10, 10, 10);
$pdf->SetTitle("Ventas");
$pdf->SetFont('Arial', 'B', 12);
$id=1;$idp=1;
$idcliente="0301200100990";
$dato='Bella Cosmetics';
$datost="2772-1020";$datosd="Comayagua";$datosc="bellacosmetics@gmail.com";
$clientes = mysqli_query($conexion, "SELECT  NombreCompleto,Apellido, Telefono, Direccion FROM cliente WHERE NIT = $idcliente");
$ventas = mysqli_query($conexion, "SELECT * FROM venta WHERE NumPedido='$idp'");
$detalle=mysqli_query($conexion, "SELECT  detalle.CodigoProd,NombreProd,Marca,CantidadProductos,PrecioProd
from producto,detalle,venta where detalle.NumPedido=venta.NumPedido and detalle.CodigoProd=producto.CodigoProd and venta.NumPedido ='$idp'");
$datosV=mysqli_fetch_assoc($ventas);
$datosC = mysqli_fetch_assoc($clientes);
//$row = mysqli_fetch_assoc($detalle);
$pdf->Cell(195, 5, utf8_decode($dato), 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Teléfono: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datost, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Dirección: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datosd, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, "Correo: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datosc, 0, 1, 'L');
$pdf->Ln();
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFillColor(0, 0, 0);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Datos del cliente", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(90, 5, utf8_decode('Nombre'), 0, 0, 'L');
$pdf->Cell(50, 5, utf8_decode('Teléfono'), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode('Dirección'), 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(90, 5, utf8_decode($datosC['NombreCompleto']." ".$datosC['Apellido']), 0, 0, 'L');
$pdf->Cell(50, 5, utf8_decode($datosC['Telefono']), 0, 0, 'L');
$pdf->Cell(56, 5, utf8_decode($datosC['Direccion']), 0, 1, 'L');
$pdf->Ln(3);


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->Cell(196, 5, "Detalle de Producto", 1, 1, 'C', 1);
$pdf->SetTextColor(0, 0, 0);
$pdf->Cell(14, 5, utf8_decode('N°'), 0, 0, 'L');
$pdf->Cell(90, 5, utf8_decode('Descripción'), 0, 0, 'L');
$pdf->Cell(25, 5, 'Cantidad', 0, 0, 'L');
$pdf->Cell(32, 5, 'Precio', 0, 0, 'L');
$pdf->Cell(35, 5, 'Sub Total.', 0, 1, 'L');
$pdf->SetFont('Arial', '', 10);
$contador = 1;
/*$row = mysqli_fetch_assoc($detalle);
$pdf->Cell(14, 5, $contador, 0, 0, 'L');
$pdf->Cell(90, 5, $row['NombreProd'], 0, 0, 'L');
$pdf->Cell(25, 5, $row['CantidadProductos'], 0, 0, 'L');
$pdf->Cell(32, 5, $row['PrecioProd'], 0, 0, 'L');
$pdf->Cell(35, 5, number_format($row['CantidadProductos'] * $row['PrecioProd'], 2, '.', ','), 0, 1, 'L');
//$pdf->Cell(35, 5, number_format($row['CantidadProductos'] * $row['PrecioProd'], 2, '.', ','), 0, 1, 'L');*/
while ($row = mysqli_fetch_assoc($detalle)) {
    $pdf->Cell(14, 5, $contador, 0, 0, 'L');
    $pdf->Cell(90, 5, $row['NombreProd'], 0, 0, 'L');
    $pdf->Cell(25, 5, $row['CantidadProductos'], 0, 0, 'L');
    $pdf->Cell(32, 5, $row['PrecioProd'], 0, 0, 'L');
    $pdf->Cell(35, 5, number_format($row['CantidadProductos'] * $row['PrecioProd'], 2, '.', ','), 0, 1, 'L');
    $contador++;
}


$pdf->SetFont('Arial', 'B', 10);
$pdf->SetTextColor(255, 255, 255);
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(196, 5, "TOTAL A PAGAR", 1, 1, 'C', 1);
$pdf->Cell(196, 5, "             ", 1, 1, 'C', 1);
$pdf->Cell(196, 5, utf8_decode($datosV['TotalPagar']), 1, 1, 'C', 1);


//$pdf->Cell(196, 5, "Datos de la Factura", 1, 1, 'C', 1);
//$pdf->Cell(20, 5, utf8_decode("Datos de la Factura: "), 0, 0, 'L');
$pdf->SetTextColor(0, 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Fecha: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5,$datosV['Fecha'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, utf8_decode("Estado: "), 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datosV['Estado'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, "Envio: ", 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datosV['TipoEnvio'], 0, 1, 'L');
$pdf->Ln();

//$pdf->Image("logo.png",60,50, 100, 70,'PNG',"http://evilnapsis.com/");

$pdf->Output("ventas.pdf", "I");

?>