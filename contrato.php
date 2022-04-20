<?php
//============================================================+
// File name   : example_039.php
// Begin       : 2008-10-16
// Last Update : 2014-01-13
//
// Description : Example 039 for TCPDF class
//               HTML justification
//
// Author: Nicola Asuni
//
// (c) Copyright:
//               Nicola Asuni
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

// Include the main TCPDF library (search for installation path).
require_once('tcpdf-master/tcpdf.php');
include ('php/conexion.php');

// create new PDF document
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator('LUNATERRECAS A. C.');
$pdf->SetAuthor('LUNATERRECAS A. C.');
$pdf->SetTitle('Contrato privado de compra-venta');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 039', PDF_HEADER_STRING);

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

$pdf->Write(0, 'Contrato de compraventa', '', 0, 'C', true, 0, false, false, 0);

//consulta para fecha e idcliente
$fecha = '';
$consulta = "SELECT * FROM ventas ORDER BY idVenta DESC";
$db = conectar();
$ejecutar = mysqli_query($db,$consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$dia = $proceso['Fecha'];
$idcliente = $proceso['idCliente'];
$idterreno = $proceso['idTerreno'];
$enganche = $proceso['Enganche'];
$mensualidades = $proceso['Mensualidades'];

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

$consulta = "SELECT * FROM  testigos WHERE idCliente = $idcliente";
$db = conectar();
$ejecutar = mysqli_query($db, $consulta);
$proceso = mysqli_fetch_assoc($ejecutar);
$nombretestigo = $proceso['Nombre'];
$apellidopaternotestigo = $proceso['apellidoPaterno'];
$apellidomaternotestigo = $proceso['apellidoMaterno'];





// create some HTML content
$html = '<span style="text-align:justify;">Que celebran en el municipio de Guadalupe, Zacatecas, el dia '.date('d').' de '.date('n').' del '. date('Y').', y 
ante los testigos que al final se mencionarán, por un lado con el carácter de vendedora la C. Georgina Luna Ramírez 
en calidad de presidenta de la asociación Civil "LUNA TERRECAS, A. C.", y el C. Roberto Pacheco Aranda como secretario 
de la Asociación Civil "LUNA TERRECAS, A. C." y el apoderado legal C. Jorge Martinez Perez y por la otra en calidad de 
comprador el C. '.$nombrecliente.' '.$apellidopaterno.' '.$apellidomaterno.' , cuyo contrato se consigna al tenor de las siguientes declaraciones y clausulas:
<p>------------------------------------------------DECLARACIONES---------------------------------------------------</p>
<p>
Bajo protesta de decir verdad, la C. Georgina Luna Ramírez, en su calidad de presidenta de la Asociación Civil "LUNA TERRECAS, A. C.", delcara:
------------------------------------------------------</p> UNO - Que es propietaria legal para realizar todos los trámites para la subdivisión, y 
venta por fracciones y/o lotes, de la parcela número 723 Z1 P 1/2 la  cual se encuentra ubicada en el ejido de San Jerónimo del municipio de  
Guadalupe, en el estado de Zacatecas, según lo demuestra con el titulo  de propiedad y/o certificado parcelario número 000000226604 la cual con
una superficie de 3-47-07.00 ha. 

<p>DOS - Que con el caracter de propietaria vende al el C. '.$nombrecliente.' '.$apellidopaterno.' '.$apellidomaterno.' el lote o fracción '.$fraccion.' manzana '.$manzana.' 
del fraccionamiento '.$fraccionamiento.' con una superficie de '.$superficie.' con las siguientes medidas y colindancias:</p>
<p>AL NORESTE '.$alnoreste.' m</p>
<p>AL NOROESTE '.$alnoroeste.' m</p>
<p>AL SURESTE '.$alsureste.' m</p>
<p>AL SUROESTE '.$alsuroeste.' m</p>

<p>TRES - Que el inmueble objeto del presente contrato, se encuentra libre de todo gravamen y al corriente en pago de impuesto predial.</p>
<p>CUATRO - Declara que la parte compradora que conoce perfectamente la fracción (lote) objeto de la adquisición, ubicación medidas y colindancias
así como los antecedentes registrales y la situación jurídica que actualmente guarda y las  que se describen en este contrato</p>

<p>Con fundamento en lo  expuesto,  se otorgan: </p>

<p>-------------------------------------------------------CLAUSULAS----------------------------------------------------</p>

<p>PRIMERA - La C. Georgina Luna Ramírez, como propietaria y presidenta de la asociación civil "LUNATERRECAS A. C." vende a el C. '.$nombrecliente.' '.$apellidopaterno.' '.$apellidomaterno.' , quien compra y 
adquiere para si el inmueble descrito en la declaración.</p>

<p>SEGUNDA - Del presente contrato privado de compraventa, cuyos datos se dejan aqui por reproducidos en forma  integra como si se insertaran a la letra,
así como con todo cuanto le corresponda de hecho y por derecho y deba considerarse inmovilizado dentro de sus linderos</p>

<p>TERCERA - El precio convenido para la celebración de esta operación, lo es en la cantidad de $'.$precio.' , la cual cubrirá la parte compradora de la siguiente
manera, a la firma del presente contrato privado de compraventa entregará la cantidad de $'.$enganche.' de enganche, estando a '.date("d").' del '.date("m").' del '.date("Y").' y el  resto es la cantidad 
de $'.$restante.' la cubrirá en '.$mensualidades.' mensualidades de  $'.$pagosmensuales.' los dias '.date('d').' de cada mes.</p>

<p>CUARTA - Ambas partes convienen en  que si la parte  compradora deja de dar pagos en un  término de tres meses, se le dará por rescindido el contrato 
de compra-venta por lo que perderá la fracción y/o lote convenido, o no paga el precio total del adeudo a la fecha indicada, la parte venderora dará por
rescindido el contrato de compra-venta y se le hará efectiva a la parte compradora una penalización equivalente del 15% del precio  total  del inmueble 
adquirido estipulado en el contrato.</p>

<p>QUINTA - Ambas partes convienen que en caso de que la parte compradora decida cancelar el contrato de compra-venta se le hará efectiva una penalización 
equivalente del 15% del precio total del inmueble adquirido estipulado  en el contrato.</p>

<p>SEXTA - Ambas partes convienen que, una vez que se  liquide el total del precio de la operación, se procederá a tramitar la escritura correspondiente
ante la notaria publica que se designe para este fin, o ante la dependencia estatal o municipal según sea el caso (llámese, ORETZA, CORET, Fraccionamientos
 Rurales Territorial, etc) y los gastos, impuestos, derechos y honorarios que  originen por este concepto, serán cubiertos por la parte compradora. Así mismo,
 la parte compradora se compromete a proporcionar todos los documentos necesarios cuando se le requiera para la transición  de la escritura correspondiente.</p>

 <p>SEPTIMA - Ambas partes convienen que una vez liquidado el terreno se procederá a hacer  los  trámites correspondientes para obtener los servicios como luz,
 agua, drenaje y alcantarillado, así como, los requisitos que solicite presidencia y  las instituciones correspondientes para la regularización del terreno 
 cumpliendo con el código urbano y los gastos impuestos, derechos y honorarios que originen por este concepto, serán cubiertos por la parte compradora. Así mismo
 la parte compradora se compromete a proporcionar todos los documentos necesarios, cuando se requiera para la  transición de los servicios correspondientes. </p>

 <p>OCTAVA - Ambas partes manifiestan tener capacidad legal y estar en pleno uso de sus facultades mentales para firmar el presente contrato privado de compraventa 
 en el cual no existe error, dolo, mala fe, ni violencia de ningún tipo que pudiera invalidar, renunciando al pago por evicción la parte compradora para con la parte
 vendedora y someten a los tribunales jurisdiccionales del estado de Zacatecas para en caso de su incumplimiento de cualquiera de las dos partes. </p> 

 <p>NOVENA - Leído que fue el presente contrato privado de compraventa y conociendo su alcance legal, lo firman y ratifican ante la presencia de los dos testigos que se 
 mencionan.-CONSTE.-</p>

 <p align="center">Generales de los contratantes </p>
 <p>Manifestaron bajo protesta de decir verdad, ser mexicano por nacimiento y de ascendencia, mayores de edad, la vendedora, que es propietaria legal y presidenta 
 de la asociación civil "LUNA TERRECAS A. C. casada, mayor de edad", originaria del D.F. y vecina de Guadalupe, Zacatecas, con domicilio en calle Conventos San Agustin
 número 13, colonia conventos 2, Guadalupe, Zacatecas; la parte compradora, el C. '.$nombrecliente.' '.$apellidopaterno.' '.$apellidomaterno.' , mayor de edad, originario de '.$municipio.', '.$estado.' 
 y vecino de este municipio de Guadalupe, Zacatecas
 con domicilio en calle '.$calle.' número '.$numero.' Fraccionamiento '.$fraccionamiento.' Código postal '.$cp.', '.$estado.' quien se identifica con credencial para votar con fotografia con clave  de elector '.$identificacion.' </p>
 <p align="center">Atentamente</p>
 <p align="center">Guadalupe, Zacatecas, a '.date('d').' de '.date('m').' del '.date('Y').' </p>
 <br><br>
 <p>La parte compradora &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; La parte vendedora</p><p>'.$nombrecliente.' '.$apellidopaterno.' '.$apellidomaterno.'
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Georgina Luna Ramírez</p>
 <br>
 <br>
 <br>
 
 
 <p align="center">Testigos</p>
 <p>'.$nombretestigo.' '.$apellidopaternotestigo.' '.$apellidomaternotestigo.'</p>
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
$pdf->Output('example_039.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+