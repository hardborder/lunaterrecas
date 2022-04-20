<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
?>
<?php
  include 'menuSecretaria.php';   
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
    <main>
        <div class="div">
            <div class="divformulario">
                <h2>
                    Registro de la venta de un terreno
                </h2>                
                <form  class="formulario"  id='formCanvas' method='post' action='#' ENCTYPE='multipart/form-data' >
                    <input type="hidden" name="action" value="insert">
                    <label for="selectEmpleado">Selecciona al vendedor
                            <select name="selectEmpleado" >
                                <option value="0">Seleccione:</option>
                                <?php 
                                $consulta = "SELECT * FROM empleados WHERE puesto = 'Vendedor'";
                                $db = conectar();
                                $ejecutar = mysqli_query($db,$consulta);
                                while ($proceso = mysqli_fetch_assoc($ejecutar))
                                {
                                    echo"<option value = '$proceso[idEmpleado]'> $proceso[Nombre] $proceso[ApellidoPaterno]</option>";
                                }

                                ?>
                            </select>
                    </label>                    
                        <label for="selectCliente">Selecciona el nombre del cliente
                            <select name="selectCliente" >
                                <option value="0">Seleccione:</option>
                                <?php 
                                $consulta = "SELECT * FROM clientes";
                                $db = conectar();
                                $ejecutar = mysqli_query($db,$consulta);
                                while ($proceso = mysqli_fetch_assoc($ejecutar))
                                {
                                    echo"<option value = '$proceso[idCliente]'> $proceso[Nombre] $proceso[ApellidoPaterno]</option>";
                                }

                                ?>
                            </select>
                        </label>                   
                        <label for="selectTerreno">Selecciona el terreno
                            <select name="selectTerreno" >
                                <option value="0">Seleccione:</option>
                                <?php 
                                $consulta = "SELECT * FROM terrenos WHERE Estatus = 'Disponible'";
                                $db = conectar();
                                $ejecutar = mysqli_query($db,$consulta);
                                while ($proceso = mysqli_fetch_assoc($ejecutar))
                                {
                                    echo"<option value = '$proceso[idTerreno]'> $proceso[Fraccionamiento] $proceso[Fraccion] $proceso[Manzana]</option>";
                                }

                                ?>
                            </select>
                        </label>        
                        <label>Enganche<input name="enganche" type="text" maxlength="9" pattern="^[0-9]{1,}$" placeholder="Ej:10000" required ></label>                            
                        <label for="">Apartado<input name="apartado" type="text"  pattern="^[0-9]{1,}$" placeholder="Ej:10000" required></label>                        
                        <label for="">Fecha de la venta<input name="fecha" type="date" readonly value="<?php echo date("Y-m-d");?>"></label>
                        <label for="">Numero de meses para pagar<input name="meses" type="text" pattern="^[0-9]{1,}$" placeholder="Ej:25" required></label>                                            
                        <label for="">Estatus del terreno                   
                            <label ><input type="radio" name="estatus" value="Vendido">Vendido</label>
                            <label ><input type="radio" name="estatus" value="Disponible">Disponible</label>
                            <label ><input type="radio" name="estatus" value="Apartado">Apartado</label>
                        </label>   
                        <label for=""></label>                                 
                        <button class="botonEnviar" type='button' onclick='guardar()'>Guardar</button>
                        <input type='hidden' name='imagen' id='imagen' />  
                        <input type='hidden' name='imagentes' id='imagentes' /> 
                        <input type='hidden' name='imagendir' id='imagendir' /> 

                          
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
                        uploadImgBase64($_POST['imagentes'], 'mi_imagentes_'.date('d_m_Y_H_i_s').'.png');  
                        uploadImgBase64($_POST['imagendir'], 'mi_imagendir_'.date('d_m_Y_H_i_s').'.png');                                                   
                        // llamamos a la funcion uploadImgBase64( img_base64, nombre_fina.png)             
                        
                        $firmacliente = $_POST['imagen']; 
                        $firmatestigo = $_POST['imagentes']; 
                        $firmadirectora = $_POST['imagendir'];

                        $action = $_POST['action'];
                        $selectEmpleado = $_POST['selectEmpleado'];
                        $selectCliente = $_POST['selectCliente'];
                        $selectTerreno = $_POST['selectTerreno'];
                        $enganche = $_POST['enganche'];
                        $apartado = $_POST['apartado'];
                        $fecha = $_POST['fecha'];
                        $mensualidades = $_POST['meses'];
                        $estatus = $_POST['estatus'];
                       
                        try 
                        {  //Acciones sobre la base de datos
                            if ($action == 'insert' && !empty($selectCliente) && !empty($selectTerreno)) 
                            {                
                               $concepto ='Proceso de la empresa';
                               $tipoconcepto='Nueva venta';
                               $sentencia = "INSERT INTO ventas (idEmpleado,  idCliente, idTerreno, Enganche, Apartado, Fecha, Mensualidades, Estatus, FirmaCliente, FirmaTestigo, FirmaDirectora) VALUES ('$selectEmpleado', '$selectCliente', '$selectTerreno', '$enganche', '$apartado', '$fecha', '$mensualidades', '$estatus', '$firmacliente', '$firmatestigo', '$firmadirectora' )";
                               $db = conectar();
                               $ejecutar = mysqli_query($db, $sentencia);
                               
                               if ($ejecutar)
                               {
                                   echo"<script> alert('Datos enviados');</script>";
                               }
                                  
                               // sentencia para actualizar el estado de los terrenos
                               $sentencia = "UPDATE terrenos SET Estatus='$estatus' WHERE idTerreno  = '$selectTerreno'";
                               $db = conectar();
                               $ejecutar = mysqli_query($db, $sentencia);  
                               if ($ejecutar)
                               {
                                   echo"<script> alert('Terreno actualizado');</script>";
                               }            
                   
                               $consulta = "SELECT * FROM ventas ORDER BY idVenta DESC";
                               $ejecutar = mysqli_query($db,$consulta);
                               $proceso = mysqli_fetch_assoc($ejecutar);
                               $idventapagos = $proceso['idVenta'];
                               $fechapagos = $proceso['Fecha'];
                               $enganchepagos = $proceso['Enganche'];
                               $firmadirectorapagos = $proceso['FirmaDirectora'];
                   
                               $sentencia = "INSERT INTO pagos(idVenta, Fecha, Monto, FirmaDirectora) VALUES ('$idventapagos','$fechapagos','$enganchepagos','$firmadirectorapagos')";
                               $ejecutar = mysqli_query($db, $sentencia);
                               if ($ejecutar)
                               {
                                   echo"<script> alert('Enganche almacenado en tabla pagos de los clientes');</script>";
                               }
                                  
                               //Sentencia  para guardar el enganche en la caja chica
                               $sentencia = "INSERT INTO caja_chica(Fecha, Monto, Concepto, Tipo_concepto, FirmaDirectora) VALUES ('$fecha', '$enganche', '$concepto', '$tipoconcepto', '$firmadirectora')"; 
                               $db = conectar();
                               $ejecutar =  mysqli_query($db, $sentencia);   
                               if ($ejecutar)
                               {
                                   echo"<script> alert('Enganche almacenado en caja chica');</script>";
                               }                                   
                            }             
                                     
                        }
                        catch (Exception $ex) {
                            echo "Ha ocurrido un error<br/>" . $ex->getMessage();
                        }  
                    }
                ?>
                    <div class="wrapper">                     
                        <img src="https://i.ibb.co/0mg7WrJ/Design-and-Soft-Wallpapers.jpg" alt="Design-and-Soft-Wallpapers" border="0" width=400 height=200 />
                        <canvas id="signature-pad" class="signature-pad" width=400 height=200></canvas>
                    </div>                        
                    <div>                          
                        <button id="clear">Clear</button>
                    </div>
                    <div class="wrapper">                     
                        <img src="https://i.ibb.co/0mg7WrJ/Design-and-Soft-Wallpapers.jpg" alt="Design-and-Soft-Wallpapers" border="0" width=400 height=200 />
                        <canvas id="firmates" class="signature-pad" width=400 height=200></canvas>
                    </div>                        
                    <div>                          
                        <button id="cleartes">Clear</button>
                    </div>
                    <div class="wrapper">                     
                        <img src="https://i.ibb.co/0mg7WrJ/Design-and-Soft-Wallpapers.jpg" alt="Design-and-Soft-Wallpapers" border="0" width=400 height=200 />
                        <canvas id="firmadir" class="signature-pad" width=400 height=200></canvas>
                    </div>                        
                    <div>                          
                        <button id="cleardir">Clear</button>
                    </div>                    
                <script src="canvasventas.js"></script>
            </div>
        </div>        
        <?php 
            $sentencia = "SELECT * FROM ventas";
            $db = conectar();
            $ejecutar = mysqli_query($db, $sentencia);
        ?>
        <div class="divtable">
            <table class="table">
                <thead>
                    <th colspan="12">Datos de las ventas</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Id venta</td>
                        <td>Id empleado</td>
                        <td>Id cliente</td>
                        <td>Id terreno</td>
                        <td>Enganche</td>
                        <td>Apartado</td>
                        <td>Fecha</td>
                        <td>Mensualidades</td>
                        <td>Estatus</td>
                        <td>Firma cliente</td>
                        <td>Firma testigo</td>
                        <td>Firma directora</td>
                    </tr>
                </tbody>
                <?php while ($proceso = mysqli_fetch_assoc($ejecutar)) {?>
                    <tr>
                        <td><?php echo"$proceso[idVenta]";?></td>
                        <td><?php echo"$proceso[idEmpleado]";?></td>
                        <td><?php echo"$proceso[idCliente]";?></td>
                        <td><?php echo"$proceso[idTerreno]";?></td>
                        <td><?php echo"$proceso[Enganche]";?></td>
                        <td><?php echo"$proceso[Apartado]";?></td>
                        <td><?php echo"$proceso[Fecha]";?></td>
                        <td><?php echo"$proceso[Mensualidades]";?></td>
                        <td><?php echo"$proceso[Estatus]";?></td>
                        <td><?php echo"$proceso[FirmaCliente]";?></td>
                        <td><?php echo"$proceso[FirmaTestigo]";?></td>
                        <td><?php echo"$proceso[FirmaDirectora]";?></td>
                    </tr>
                <?php }?>               
            </table>
        </div>           
    </main>
    <footer class="footer">
        <p>
            Lunaterrecas A. C.
        </p>
    </footer>
</body>
</html>