<?php
    session_start();
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria')
    {
       
    }
    else
    {
        header('Location:cerrar.php');
    }
?>
<?php
include 'php/conexion.php';
//variables iniciadas
$idventaconsulta = ''; 
$idventa = '';
$fecha = '';
$monto = '';
$firmadirectora = '';
$fraccionamiento = '';
$fraccion = '';
$manzana = '';
$totalformato='';
$restanteformato='';
$restante = '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>    
</head>
<body>
    <?php
        include 'menuSecretaria.php';   
    ?>
    <main>                            
        <div class="div">
            <div class="divformulario">    
                <h2>
                    Registrar pago mensual de un cliente
                </h2> 
                <form class="formulario">
                    <input type="hidden" name="action" value="buscar">
                    <label>Nombre del cliente<input name="nombre" type="text"></input></label>
                    <label>Apellido paterno<input name="apellidop" type="text"></input></label>
                    <label>Apellido materno<input name="apellidom" type="text"></input></label>                    
                    <input type="submit" value="Buscar"> 
                </form>
                <?php                    
                    $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); 
                    $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
                    $apellidop = filter_input(INPUT_GET, 'apellidop', FILTER_SANITIZE_STRING);
                    $apellidom = filter_input(INPUT_GET, 'apellidom', FILTER_SANITIZE_STRING);
                    try 
                    {  //Acciones sobre la base de datos                     
                        if ($action == 'buscar' && !empty($nombre) && !empty($apellidop)) 
                        {      
                            $SELECT= "SELECT * FROM  ventas INNER JOIN clientes WHERE (clientes.Nombre = '$nombre') AND (clientes.ApellidoPaterno = '$apellidop') AND (clientes.ApellidoMaterno = '$apellidom')";
                            $db = conectar();
                            $ejecutar = mysqli_query($db, $SELECT);
                            $procesar = mysqli_fetch_assoc($ejecutar);        
                            if ($procesar)
                            {
                                $idventaconsulta = $procesar['idVenta'];  
                                $idterreno = $procesar['idTerreno'];
                                $select = "SELECT * FROM terrenos WHERE idTerreno = $idterreno";
                                $db = conectar();
                                $ejecutar = mysqli_query($db, $select);
                                $procesar = mysqli_fetch_assoc($ejecutar);
                                $fraccionamiento = $procesar['Fraccionamiento'];
                                $fraccion = $procesar['Fraccion'];
                                $manzana = $procesar['Manzana'];
                                $costo = $procesar['Precio'];

                                $consulta = "SELECT sum(Monto) FROM pagos WHERE idVenta = '$idventaconsulta'";            
                                $db = conectar();
                                $ejecutar = mysqli_query($db, $consulta);
                                $procesar = mysqli_fetch_assoc($ejecutar);
                                $total = $procesar["sum(Monto)"]; 
                                $totalformato = number_format($total, 2);
                                
                                $restante = $costo - $total;
                                $restanteformato = number_format($restante, 2);
                                if($total >= $costo)
                                {        

                                   echo "<a href='cartaasignacion.php?id=<?= $idventa ?>' >Abrir carta de asignación</a>";
                                                                       
                                }

                            }
                            else
                            {
                                echo"<script>alert ('Cliente no encontrado');</script>";
                            }                                           
                        }                         
                    }
                    catch (Exception $ex) 
                    {
                        echo "Ha ocurrido un error<br/>" . $ex->getMessage();
                    }                        
                ?>
                <form class="formulario"  id='formCanvas' method='post' action='#' ENCTYPE='multipart/form-data'>   
                    <input type="hidden" name="action" value="insert">                                                                                        
                    <label >Fraccionamiento:<label> <?php echo"$fraccionamiento"; ?></label>  </label>                           
                    <label >Fracción:<label "> <?php echo"$fraccion"; ?></label></label>                        
                    <label >Manzana:<label "> <?php echo"$manzana"; ?></label> </label>    
                    <label >Total pagado:<label ">$<?php  echo"$totalformato"; ?></label> </label>     
                    <label >Falta por pagar:<label ">$<?php  echo"$restanteformato"; ?></label> </label>                    
                    <label >Id de la venta<input name="idventa" type="text"  value="<?php echo"$idventaconsulta";?>"> </label>                                 
                    <label >Fecha del pago<input name="fecha" type="date" readonly value="<?php echo date("Y-m-d");?>"></label>                   
                    <label >Cuanto va a pagar<input name="monto" type="text" placeholder="Monto del pago"></label>                                            
                    <button type='button' onclick='guardar()'>Guardar</button>
                    <input type='hidden' name='imagen' id='imagen' />          
                </form>                 
                <?php    
                             
                    if (isset($_POST['imagen']))                
                    {   
                        
                        function uploadImgBase64 ($base64, $name)
                        {                           
                            // decodificamos el base64
                            $datosBase64 = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $base64));
                            // definimos la ruta donde se guardara en el server
                            $path= $_SERVER['DOCUMENT_ROOT'].'/Lunaterrecas/firmas/'.$name;                            
                            // guardamos la imagen en el server

                            
                            if(!file_put_contents($path, $datosBase64)){
                                // retorno si falla
                                return false;
                            }
                            else{
                                // retorno si todo fue bien
                                return true;
                            }                            
                        }
                        // llamamos a la funcion uploadImgBase64( img_base64, nombre_fina.png) 
                        uploadImgBase64($_POST['imagen'], 'mi_imagen_'.date('d_m_Y_H_i_s').'.png'); 
                        
                        $firma = $_POST['imagen'];                     
                        $action = $_POST['action'];                    
                        $idventa = $_POST['idventa']; 
                        $fecha = $_POST['fecha']; 
                        $monto = $_POST['monto'];                     
                        $concepto = 'Cliente realizó un pago mensual';
                        $tipoconcepto = 'No. venta: '.$idventa.'';                     
                        try 
                        {               
                            if ($action == 'insert' && !empty($idventa) && !empty($monto)) 
                            {                           
                                $sentencia = "INSERT INTO pagos (idVenta, Fecha, Monto, FirmaDirectora) VALUES ('$idventa', '$fecha', '$monto', '$firma')";
                                $db = conectar();
                                $ejecutar = mysqli_query($db, $sentencia);           
                                    if ($ejecutar)
                                    {
                                        echo"<script> alert('Pago guardado'); </script> ";
                                    }
                                $sentencia = "INSERT INTO caja_chica(Fecha, Monto, Concepto, Tipo_concepto, FirmaDirectora) VALUES ('$fecha', '$monto', '$concepto', '$tipoconcepto', '$firma')"; 
                                $db = conectar();
                                $ejecutar =  mysqli_query($db, $sentencia);
                                if ($ejecutar)
                                {
                                    echo"<script> alert('Registro guardado en caja chica'); </script>";
                                }                                                      
                            }                          
                        }
                        catch (Exception $ex) 
                        {
                            echo "Ha ocurrido un error<br/>" . $ex->getMessage();
                        }    
                        // funcion para gusrfdar la imagen base64 en el servidor
                        // el nombre debe tener la extension                    
                    }                            
                ?>
                        <div class="wrapper">
                            <img src="https://i.ibb.co/0mg7WrJ/Design-and-Soft-Wallpapers.jpg" alt="Design-and-Soft-Wallpapers" border="0" width=400 height=200 />
                            <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                        </div>                        
                        <div>                          
                            <button id="clear">Clear</button>
                        </div>
                        <script src="scriptcanvas.js"></script>                                         
            </div>
        </div>          
        
    </main>
    <footer class="footer">
        <p>
            Lunaterrecas A. C.
        </p>
    </footer>
</body>
</html>