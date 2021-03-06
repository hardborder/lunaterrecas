<?php
require_once('tcpdf-master/tcpdf.php');
require 'php/conexion.php';
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

$pdf->Write(0, 'Recibo de pagos extras', '', 0, 'C', true, 0, false, false, 0);

$consulta = "SELECT * FROM caja_chica ORDER BY idcajachica DESC";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$procesar = mysqli_fetch_assoc($ejecutar);
$concepto = $procesar['Concepto'];
$tipoconcepto = $procesar['Tipo_concepto'];
$monto = $procesar['Monto'];
$idcajachica = $procesar['idCajaChica'];
$firmadirectora = $procesar['FirmaDirectora'];

$consulta = "SELECT count(Monto) FROM caja_chica WHERE Concepto = '$concepto'";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$procesar = mysqli_fetch_assoc($ejecutar);
$numerodepagos  = $procesar['count(Monto)'];

// create some HTML content
$html = 
'<span style="text-align:justify;">
<p>N??mero de recibo: ' .$idcajachica.'</>
<p>Calle: San Agust??n N??mero 15</p>
<p>Colonia: Conventos II</p>
<p>Guadalupe, Zacatecas</p>
<p>Tel??fono: oficina (492) 154 35 68, cel 492 189 19 58</p>
<p>Fecha: D??a '.date('d').' de '.date('m').' del '.date('Y').'</p>
<p></p>
<p>Nombre de la empresa: Lunaterrecas A. C.</p>
<p>Entrega a: 
<p>'.$concepto.'</p>
<p>Por concepto de:</p>
<p>'.$tipoconcepto.'</p>

<p>Numero de pago: '.$numerodepagos.' </p>
<p>Monto: $'.$monto.'</p>
<p></p><p></p><p></p><p></p><p></p><p></p><p>

<p align="center">Firma de directora:</p>
<p align="center">'.$firmadirectora.'</p>
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