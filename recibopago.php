<?php
// Include the main TCPDF library (search for installation path).
require_once('tcpdf-master/tcpdf.php');
require 'php/conexion.php';
//consulta  para idVenta
$consulta = "SELECT * FROM pagos ORDER BY idPagos DESC";
$db= conectar();
$ejecutar = mysqli_query($db, $consulta);
$procesar = mysqli_fetch_assoc($ejecutar);
$idventa = $procesar ['idVenta'];
$pagomensual = $procesar['Monto'];
$img = $procesar['FirmaDirectora'];

//consulta para fecha e idcliente
$fecha = '';
$consulta = "SELECT * FROM ventas WHERE idVenta = $idventa";
$db = conectar();
$ejecutar = mysqli_query($db,$consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$dia = $proceso['Fecha'];
$idcliente = $proceso['idCliente'];
$idterreno = $proceso['idTerreno'];
$enganche = $proceso['Enganche'];
$mensualidades = $proceso['Mensualidades'];
$idventa = $proceso['idVenta'];

//consulta para nombre del cliente
$consulta = "SELECT * FROM clientes WHERE idCliente = $idcliente";
$ejecutar = mysqli_query($db,$consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$nombrecliente = $proceso['Nombre'];
$apellidopaterno =  $proceso['ApellidoPaterno'];
$apellidomaterno = $proceso['ApellidoMaterno'];
$municipio = $proceso['Municipio'];
$estado = $proceso['Estado'];
$calle =  $proceso['Calle'];
$numero = $proceso['Numero'];
$fraccionamiento = $proceso['Fraccionamiento'];
$cp = $proceso['CP'];
$identificacion = $proceso['Identificacion'];
$telefono =  $proceso['Telefono'];


//consulta para terreno
$consulta = "SELECT * FROM terrenos WHERE idTerreno = $idterreno";
$ejecutar = mysqli_query($db,$consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$fraccion = $proceso['Fraccion'];
$manzana = $proceso['Manzana'];
$fraccionamiento = $proceso['Fraccionamiento'];
$superficie = $proceso['Superficie'];
$alnoreste = $proceso['alNoreste'];
$alnoroeste = $proceso['alNoroeste'];
$alsureste = $proceso['alSureste'];
$alsuroeste = $proceso['alSuroeste'];
$precio = $proceso['Precio'];

$restante = $precio - $enganche;
$pagosmensuales = $restante / $mensualidades;

$consulta = "SELECT * FROM  testigos WHERE idCliente = $idcliente ";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$nombretestigo = $proceso['Nombre'];
$apellidopaternotestigo = $proceso['apellidoPaterno'];
$apellidomaternotestigo = $proceso['apellidoMaterno'];

//consulta para contar los pagos de un cliente
$consulta =  "SELECT count(idPagos) FROM pagos WHERE idVenta = $idventa";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$pagos = $proceso["count(idPagos)"];

//Consulta para sumar los pagos de un cliente 
$consulta  = "SELECT SUM(Monto) FROM pagos WHERE idVenta = $idventa";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$monto =  $proceso["SUM(Monto)"];

//============================================================+
// File name   : recibopago.php
// Begin       : 2008-10-16
// Last Update : 2014-01-13
//
// Description : LUNATERRECAS A. C.
//               HTML justification
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               LUNATERRECAS A. C.
//               Tecnick.com LTD
//               www.tecnick.com
//               info@tecnick.com
//============================================================+

/**
 * Creates an example PDF TEST document using TCPDF
 * @package Lunaterrecas.org
 * @abstract TCPDF - Example: HTML justification
 * @author Nicola Asuni
 * @since 2008-10-18
 */



// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('LUNATERRECAS A. C.');
$pdf->SetAuthor('LUNATERRECAS A. C.');
$pdf->SetTitle('Recibo de pago');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data

$pdf->SetHeaderData($lg = 'img/logo.png', 0, 'LUNATERRECAS '.'A. C.', ' ');

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// add a page
$pdf->AddPage();

// set font
$pdf->SetFont('helvetica', 'B', 18);

$pdf->Write(0, 'Pago de mensualidad', '', 0, 'C', true, 0, false, false, 0);




// create some HTML content
$html = 
'<span style="text-align:justify;">
<p>Calle: San Agustín Número 15</p>
<p>Colonia: Conventos II</p>
<p>Guadalupe, Zacatecas</p>
<p>Teléfono: oficina (492) 154 35 68, cel 492 189 19 58</p>
<p>Fecha: Día '.date('d').' de '.date('m').' del '.date('Y').'</p>
<p></p>
<p>Nombre: '.$nombrecliente.' '.$apellidopaterno.' '.$apellidomaterno.'</p>
<p>Teléfono: '.$telefono.'</p>
<p>Fraccionamiento: '.$fraccionamiento.'</p>
<p>Lote: '.$fraccion.'</p>
<p>Manzana: '.$manzana.'</p>

<p>Numero de pago: '.$pagos.' </p>
<p>Monto: $'.$pagomensual.'</p>
<p align="center">Firma de directora:</p>

<p align="center">'.$img.'</p>
<p align="center">-----------------------------------------</p>
</span>';



// set core font
$pdf->SetFont('helvetica', '', 12);

// output the HTML content
$pdf->writeHTML($html, true, 0, true, true);

$pdf->Ln();

// set UTF-8 Unicode font
$pdf->SetFont('dejavusans', '', 10);



// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('recibopago.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+