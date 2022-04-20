<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
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
    <?php include('php/conexion.php'); 
          include('menuSecretaria.php');
          
    ?>
        <?php  $consulta = "SELECT * FROM nomina  WHERE idNomina > 0";
          $db = conectar();                        
          $ejecutar = mysqli_query($db, $consulta);
        ?>
    <main>
        <div class="divtable">
            <table  class="table">
                    <thead>
                        <th colspan="6" >Datos de los pagos a los trabajadores</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Id nomina</td>
                            <td>Id empleado</td>
                            <td>Terrenos vendidos</td>
                            <td>Fecha</td>
                            <td>Pago final</td>
                            <td>Firma</td>                       
                        </tr>                             
                    </tbody>     
                    <?php while ($proceso = mysqli_fetch_assoc($ejecutar)){ ?>                  
                    <tr>
                        <td> <?php echo "$proceso[idNomina]"; ?> </td> 
                        <td> <?php echo "$proceso[id_Empleado]"; ?> </td>
                        <td> <?php echo "$proceso[Dias_laborados]"; ?> </td>
                        <td> <?php echo "$proceso[fecha]";?> </td>
                        <td> <?php echo "$proceso[pago_final]";?> </td>   
                        <td> <?php echo "$proceso[Firma]";?> </td>                   
                    </tr>  
                    <?php } ?>                               
            </table>
        </div>
      
            <div class="div">
                <div class="divformulario">
                    <form class="formulario"  id='formCanvas' method='post' action='#' ENCTYPE='multipart/form-data'>
                                <input type="hidden" name="action" value="insert">                                                                                  
                                <select name="selectEmpleado" >
                                    <option value="0">Seleccione:</option>
                                    <?php 
                                    $consulta = "SELECT * FROM empleados where puesto = 'Vendedor'";
                                    $db = conectar();
                                    $ejecutar = mysqli_query($db,$consulta);
                                    while ($proceso = mysqli_fetch_assoc($ejecutar))
                                    {
                                        
                                        echo"<option value = '$proceso[idEmpleado]'> $proceso[Nombre] $proceso[ApellidoPaterno] $proceso[ApellidoMaterno]</option>";
                                    }

                                    ?>
                                </select>                                                                                
                                <label for="selectTerreno">Selecciona el terreno
                                    <select name="selecTerreno" >
                                        <option value="0">Seleccione:</option>
                                        <?php 
                                        $consulta = "SELECT * FROM terrenos WHERE Estatus = 'Vendido'";
                                        $db = conectar();
                                        $ejecutar = mysqli_query($db,$consulta);
                                        while ($proceso = mysqli_fetch_assoc($ejecutar))
                                        {
                                            echo"<option value = '$proceso[Fraccionamiento] $proceso[Fraccion] $proceso[Manzana]'> $proceso[Fraccionamiento] $proceso[Fraccion] $proceso[Manzana]</option>";
                                        }

                                        ?>
                                    </select>
                                </label>                                  
                                <input type="text" name="fecha" placeholder="Fecha" value="<?php echo date("Y-m-d");?>">                                 
                                <input type="text" name="pagofinal" placeholder="Pago final" pattern="^[0-9]{1,}$" maxlength="5" placeholder="Ej:5500" required>                                                                              
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
                        
                        $firma = $_POST['imagen'];                     
                        $action = $_POST['action'];                    
                        $idempleado = $_POST['selectEmpleado']; 
                        $idterreno = $_POST['selecTerreno']; 
                        $fecha = $_POST['fecha'];                     
                        $monto = $_POST['pagofinal'];
                        $concepto = "Pago a vendedor";
                        $tipoconcepto = "Comisión";                                            
                        try 
                        {               
                            if ($action == 'insert' && !empty($idempleado) && !empty($idterreno)) 
                            {                           
                                $sentencia = "INSERT INTO nomina (id_Empleado, Dias_laborados, fecha, pago_final, Firma) VALUES ('$idempleado', '$idterreno', '$fecha', '$monto', '$firma')";
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
                        <script src="canvasnominasecre.js"></script> 
                        </div>
            </div>
            
            
    </main>
    <footer class="footer">
        <p>Lunaterrecas A. C.</p>
    </footer>
</body>
</html>