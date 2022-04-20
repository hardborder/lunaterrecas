<?php
require_once('tcpdf-master/tcpdf.php');
require 'php/conexion.php';

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('LUNATERRECAS A. C.');
$pdf->SetAuthor('LUNATERRECAS A. C.');
$pdf->SetTitle('Carta de asignación');
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

$pdf->Write(0, 'Carta de asignación unica para escrituración', '', 0, 'C', true, 0, false, false, 0);

$idCliente="";
$SENTENCIA = "SELECT * FROM pagos ORDER BY idPagos DESC";
$db = conectar();
$ejecutar = mysqli_query($db, $SENTENCIA);
$procesar = mysqli_fetch_assoc($ejecutar);
$idventa = $procesar['idVenta'];
$firma  = $procesar['FirmaDirectora'];



$consulta = "SELECT * FROM ventas WHERE idVenta = $idventa";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$procesar = mysqli_fetch_assoc($ejecutar);
$idcliente = $procesar['idCliente'];
$idterreno = $procesar['idTerreno'];


$consulta = "SELECT * FROM clientes WHERE idCliente = $idcliente";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$procesar = mysqli_fetch_assoc($ejecutar);
$nombre = $procesar['Nombre'];
$apellidop = $procesar['ApellidoPaterno'];
$apellidom = $procesar['ApellidoMaterno'];


$SELECT="SELECT * FROM terrenos WHERE idTerreno = $idterreno";
$db = conectar();
$ejecutar = mysqli_query($db, $SELECT);
$procesar = mysqli_fetch_assoc($ejecutar); 
$fraccion = $procesar['Fraccion'];
$manzana = $procesar['Manzana'];
$fraccionamiento = $procesar['Fraccionamiento'];
$superficie = $procesar['Superficie']; 
$alnoreste = $procesar['alNoreste'];
$alnoroeste = $procesar['alNoroeste'];
$alsureste = $procesar['alSureste'];
$alsuroeste = $procesar['alSuroeste'];
//imagen png codificada en base64

 
//eliminamos data:image/png; y base64, de la cadena que tenemos
//hay otras formas de hacerlo                   
//list(, $Base64Img) = explode(';', $Base64Img);
//list(, $Base64Img) = explode(',', $Base64Img);
//Decodificamos $Base64Img codificada en base64.

//escribimos la información obtenida en un archivo llamado 
//unodepiera.png para que se cree la imagen correctamente




// create some HTML content
$html = 
'<span style="text-align:justify;">
<p>Fecha: Día '.date('d').' de '.date('m').' del '.date('Y').'</p>
<p>Asigna a: '.$nombre.' '.$apellidop.' '.$apellidom.'</>
<p>El lote '.$fraccion.', manzana '.$manzana.' , ubicado en el fraccionamiento  '.$fraccionamiento.', que se localiza en el estado de Zacatecas
, el lote tiene una superficie de '.$superficie.'  , y consta de las siguientes medidas</p>
<p>Al noreste: '.$alnoreste.'</p>
<p>Al noroeste: '.$alnoroeste.'</p>
<p>Al sureste: '.$alsureste.'</p>
<p>Al suroeste: '.$alsuroeste.'</p>
<p></p>
<p>La asociación civil denominada: Lunaterrecas A. C.</p>
<p></p><p></p><p></p><p></p><p></p><p></p><p>

<p align="center">Presidente</p>

<p align="center">'.$firma.'</p>
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
$pdf->Output('cartaasignacion.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+