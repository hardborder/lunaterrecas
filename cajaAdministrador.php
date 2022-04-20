<?php
include "php/conexion.php";
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/juery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="#" ></script>
    <script src="https://cdn.jsdelivr.net/npm/signature_pad@2.3.2/dist/signature_pad.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>   
    <?php   
        include "Menu.php";    
    ?>    
    <?php                     
                    $consulta = "SELECT sum(Monto) FROM caja_chica WHERE Concepto != 'Retiro'";            
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $consulta);
                    $procesar = mysqli_fetch_assoc($ejecutar);
                    $total = $procesar["sum(Monto)"]; 
                    $totalformato = number_format($total, 2);

                    $consulta = "SELECT sum(Monto) FROM caja_chica WHERE Concepto = 'Retiro'";            
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $consulta);
                    $procesar = mysqli_fetch_assoc($ejecutar);
                    $totalnegativo = $procesar["sum(Monto)"]; 

                    $cajachica = $total - $totalnegativo;                
    ?>
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
                $monto = $_POST['monto']; 
                $concepto = $_POST['concepto']; 
                $tipoconcepto = $_POST['tipoconcepto'];
                $firma = $_POST['imagen'];  
                try 
                {  //Acciones sobre la base de datos
                    
                    if($cajachica>0)
                    {
                    if ($action == 'insert' && !empty($monto) && !empty($concepto)) 
                    {
                        
                        $sentencia = "INSERT INTO caja_chica(Fecha, Monto, Concepto, Tipo_concepto, FirmaDirectora) VALUES ('$fecha','$monto','$concepto','$tipoconcepto','$firma')";
                        $db = conectar();
                        $ejecutar =  mysqli_query($db, $sentencia);    
                        if($ejecutar)
                        {
                           echo"<script>
                                window.open(pagoextraADMIN.php);
                                </script>";
                        
                        }
                    }
                    }  
                    else
                    {
                    echo"<script> alert('Fondos insuficientes'); </script>";
                    }          
                }
                catch (Exception $ex) {
                    echo "Ha ocurrido un error<br/>" . $ex->getMessage();
                }
                // funcion para gusrfdar la imagen base64 en el servidor
                // el nombre debe tener la extension                    
            }
    ?>
    <main>     
            <div class="div">
                <div class="divformularioPAGOEXTRADMIN">
                    <h2>Registro de pagos extra</h2>
                    <form class="formulario" id='formCanvas' method='post' action='#' ENCTYPE='multipart/form-data'>     
                        <input type="hidden" name="action" value="insert">         
                        <input name="fecha" type="text" name="fecha" placeholder="Fecha" value="<?php echo date('Y-m-d');?>">
                        <label>Monto<input required pattern="[0-9]+" name="monto" id="monto" maxlength="10" type="text" placeholder="Ej. $05,000.00"></label>               
                        <label>Concepto<input required pattern="^[A-Za-z\s]+" name="concepto" type="text" placeholder="EJ. Pago de luz" title="No se admiten números" ></label>                      
                        <label>Tipo de concepto</label><input name="tipoconcepto" type="text" placeholder="EJ. Gastos de oficina" title="No se admiten números">                       
                        
                        <button type='button' onclick='guardar()'>Guardar</button>
                        <input type='hidden' name='imagen' id='imagen' /> 
                    </form>
                    <div class="wrapper">
                        <img src="https://i.ibb.co/0mg7WrJ/Design-and-Soft-Wallpapers.jpg" alt="Design-and-Soft-Wallpapers" border="0" width=400 height=200 />
                        <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                    </div>                        
                    <div>                          
                        <button id="clear">Clear</button>
                    </div>
                        <script src="pagoextradmin.js"></script> 
                    </div>
                </div>
            </div> 
            <?php
            $consulta = "SELECT * FROM caja_chica ORDER BY idCajaChica";  
            $db = conectar();
            $ejecutar = mysqli_query($db, $consulta);
            $proceso = mysqli_fetch_assoc($ejecutar);
        ?>
        <div class="divtable">
            <table class="table">
                <thead>
                    <th colspan="6">Datos de la caja chica</th>
                </thead> 
                <tbody>
                    <tr>
                        <td>Id caja chica</td>
                        <td>Fecha</td>                        
                        <td>Concepto</td>
                        <td>Tipo de concepto</td>
                        <td>Firma directora</td>
                        <td>Monto</td>
                    </tr>
                </tbody>
                <?php  while ($proceso = mysqli_fetch_assoc($ejecutar)) { ?>
                <tr>
                        <td><?php echo"$proceso[idCajaChica]"; ?></td>
                        <td><?php echo"$proceso[Fecha]"; ?></td>                        
                        <td><?php echo"$proceso[Concepto]"; ?></td>
                        <td><?php echo"$proceso[Tipo_concepto]"; ?></td>
                        <td><?php echo"$proceso[FirmaDirectora]"; ?></td>
                        <td>$<?php echo"$proceso[Monto]"?></td>
                </tr>
                <?php  }?>      
               
               <tfoot>
                   <tr>
                      <td colspan="5" >Total:</td>
                      <td>$<?php echo"$cajachica"?></td>
                   </tr>
               </tfoot>         
            </table>  
        </div> 
    </main>
    <footer class="footer">
        <p>Lunaterrecas A. C.</p>
    </footer>
</body>
</html>