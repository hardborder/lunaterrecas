<?php
 include 'php/conexion.php';
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
        <h2>Buscar pagos de un cliente</h2>       
                <form class="formulario">
                        <input type="hidden" name="action" value="insert">
                        <label for="">Nombre<input type="text" name="nombre"  minlength="1" maxlength="15" pattern="^[A-Z]{1}[a-záéíóú]+[\s]*$" type="text" placeholder="Ej: Juan" title="Ingresa el nombre empezando con mayúscula"  required ></label>
                        <label for="">Apellido paterno<input type="text" name="apellidopaterno" minlength="2" maxlength="15" pattern="^[A-Z]{1}[a-záéíóú]+[\s]*$" type="text" placeholder="Ej: Lara" title="Ingresa el apellido paterno empezando con letra mayúscula, no se admiten números" required></label>
                        <label for="">Apellido materno<input type="text" name="apellidomaterno" minlength="2" maxlength="15" pattern="^[A-Z]{1}[a-záéíóú]+[\s]*$" type="text" placeholder="Ej: Briceño" title="Ingresa el apellido materno empezando por una letra mayúscula" required></label>
                        <input type="submit" value="Buscar">
                </form>
        </div>
        <?php            
        try 
        {  //Acciones sobre la base de datos
            $action = filter_input(INPUT_GET, 'action');
            $nombre = filter_input(INPUT_GET, 'nombre', FILTER_SANITIZE_STRING);
            $apellidopaterno = filter_input(INPUT_GET, 'apellidopaterno', FILTER_SANITIZE_STRING);
            $apellidomaterno = filter_input(INPUT_GET, 'apellidomaterno', FILTER_SANITIZE_STRING);
            $idventa = '';
            $idterreno = '';
            $penalizacion = '';
            $entrega = '';
            $formatop = '';
            $formatoe = '';

            if ($action == 'insert' && !empty($nombre) && !empty($apellidopaterno) && !empty($apellidomaterno)) 
            {
                $SELECT= "SELECT * FROM  ventas INNER JOIN clientes WHERE (clientes.Nombre = '$nombre') AND (clientes.ApellidoPaterno = '$apellidopaterno') AND (clientes.ApellidoMaterno = '$apellidomaterno')";
                $db = conectar();
                $ejecutar = mysqli_query($db, $SELECT);
                $procesar = mysqli_fetch_assoc($ejecutar);
                if($procesar)
                {
                    $idventa = $procesar['idVenta'];
                    $idterreno = $procesar['idTerreno']; 
                }
                else
                {
                    echo"<script> alert ('No se encuentra el cliente ingresado en una venta');
                                                </script>";
                }
                                                        
            }       
        }
        catch (Exception $ex) {
            echo "Ha ocurrido un error<br/>" . $ex->getMessage();
        } 
        ?>
        <?php
            $consulta = "SELECT * FROM pagos WHERE idVenta = '$idventa'";  
            $db = conectar();
            $ejecutar = mysqli_query($db, $consulta);
        ?>       
        <div class="divdiv">            
            <div class="divtable">                     
                <table class="table">
                    <thead>
                        <th colspan="5">Pagos encontrados por nombre del cliente</th>
                    </thead> 
                    <tbody>
                        <tr>
                            <td>Id pagos</td>
                            <td>Id venta</td>
                            <td>Fecha</td>                                               
                            <td>Firma directora</td>
                            <td>Monto</td> 
                        </tr>
                    </tbody>
                    <?php  while ($proceso = mysqli_fetch_assoc($ejecutar)) { ?>
                    <tr>
                            <td><?php echo"$proceso[idPagos]"; ?></td>
                            <td><?php echo"$proceso[idVenta]"; ?></td>
                            <td><?php echo"$proceso[Fecha]"?></td>                                                
                            <td><?php echo"$proceso[FirmaDirectora]"; ?></td>
                            <td>$<?php echo"$proceso[Monto]"; ?></td>
                    </tr>
                    <?php  }?>
                    <?php                     
                        $consulta = "SELECT sum(Monto) FROM pagos WHERE idVenta = '$idventa' ";            
                        $db = conectar();
                        $ejecutar = mysqli_query($db, $consulta);
                        $procesar = mysqli_fetch_assoc($ejecutar);
                        $total = $procesar["sum(Monto)"]; 
                        $formato = number_format($total, 2)
                        //$totalformato = number_format($total, 2);
                    ?>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total:</td><td colspan="1">$<?php echo"$formato"?></td>
                        </tr>
                    </tfoot>      
                </table>  
            </div>
        </div> 
            <?php
                if($idterreno)
                {
                    $sentencia = "SELECT * FROM terrenos WHERE idTerreno = $idterreno"; 
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $sentencia);
                    $procesar = mysqli_fetch_assoc($ejecutar);
                    $precio = $procesar['Precio'];
                    $multiplicacion = $precio * 15;                   
                    $penalizacion = $multiplicacion / 100;  
                    $formatop = number_format($penalizacion, 2);
                    $entrega = $total - $penalizacion; 
                    $formatoe = number_format($entrega, 2);  
                }
            ?>
        <div class="div">
                <div class="divformularioNOMINA">
                <form class="formulario"  id='formCanvas' method='post' action='#' ENCTYPE='multipart/form-data'> 
                                <input type="hidden" name="action" value="insert">      
                                <label for="">Fecha<input type="text" name="fecha" placeholder="Fecha" value="<?php echo date("Y-m-d");?>" readonly></label>                 
                                <label for="">Id de la venta<input type="text" name="idventa" value="<?php echo "$idventa"?>" readonly></label>                                 
                                <label for="">Penalización:<input type="text" name="penalizacion" value="<?php echo "$$formatop"?>" readonly></label>
                                <label for="">Se entrega:<input type="text" name="entrega" value="<?php echo "$$formatoe"?>" readonly></label>                                                       
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
                                     $path= $_SERVER['DOCUMENT_ROOT'].'/firmas/'.$name;                            
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
                                 
                                $action = $_POST['action'];                     
                                $fecha = $_POST['fecha'];                    
                                $idventa = $_POST['idventa']; 
                                $penalizacion = $_POST['penalizacion']; 
                                $entrega = $_POST['entrega'];                    
                                $firma = $_POST['imagen'];                
                                 try 
                                 {               
                                     if ($action == 'insert' && !empty($idventa) && !empty($penalizacion)) 
                                     {                           
                                         $sentencia = "INSERT INTO contratoscancelados (id_venta, Penalizacion, Firma_cliente, Fecha, CantidadEntregada) VALUES ('$idventa', '$penalizacion', '$firma', '$fecha', '$entrega')";
                                         $db = conectar();
                                         $ejecutar = mysqli_query($db, $sentencia);           
                                             if ($ejecutar)
                                             {
                                                 echo"<script> alert('El contrato cancelado ha sido almacenado'); </script> ";
                                             }
                                             $sentencia = "UPDATE terrenos SET Estatus='Disponible' WHERE idTerreno  = '$idterreno'";
                                             $db = conectar();
                                             $ejecutar = mysqli_query($db, $sentencia);  
                                             if ($ejecutar)
                                             {
                                                 echo"<script> alert('Terreno actualizado');</script>";
                                             }  
                                            $consulta = "DELETE FROM pagos WHERE idVenta = '$idventa'";
                                            $db = conectar();
                                            $ejecutar = mysqli_query($db, $consulta);                                                                
                                            if($ejecutar)
                                            {
                                                echo"<script> alert ('Pagos del cliente eliminados');
                                                </script>";
                                                   
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
                        <script src="canvascancelados.js"></script> 
                    </div>
            </div>
           
        
    </main>
    <footer class="footer">
        <p>Lunaterrecas A. C.</p>
    </footer>
</body>
</html>