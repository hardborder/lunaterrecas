<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
       
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
</head>
<body>
    <?php include('Menu.php');    
          include('php/conexion.php');                          
    ?>    
    <main>         
            <div class="div">
                <div class="divformularioNOMINA">
                    <form class="formulario">  
                                <input type="hidden" name="action" value="insert">                                                                                        
                                <select name="selectEmpleado" >
                                    <option value="0">Seleccione:</option>
                                    <?php 
                                    $consulta = "SELECT * FROM empleados";
                                    $db = conectar();
                                    $ejecutar = mysqli_query($db,$consulta);
                                    while ($proceso = mysqli_fetch_assoc($ejecutar))
                                    {
                                        
                                        echo"<option value = '$proceso[idEmpleado]'> $proceso[Nombre] $proceso[ApellidoPaterno] $proceso[ApellidoMaterno]</option>";
                                    }
                                    ?>
                                </select>                                                                                        
                                <input type="text" name="diaslaborados" placeholder="Días laborados">                                   
                                <input type="text" name="fecha" placeholder="Fecha" value="<?php echo date("Y-m-d");?>">                                 
                                <input type="text" name="pagofinal" placeholder="Pago final">                                                          
                                <input type="text" name="firma" placeholder="Firma">                                                                                              
                                <input class="botonEnviar" type="submit" value="Enviar">
                    </form>
                </div>
            </div>
            <?php
                $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); 
                $selectEmpleado = filter_input(INPUT_GET, 'selectEmpleado', FILTER_SANITIZE_STRING); 
                $diaslaborados = filter_input(INPUT_GET, 'diaslaborados', FILTER_SANITIZE_STRING); 
                $fecha = filter_input(INPUT_GET, 'fecha', FILTER_SANITIZE_STRING); 
                $pagofinal = filter_input(INPUT_GET, 'pagofinal', FILTER_SANITIZE_STRING);  
                $firma = filter_input(INPUT_GET, 'firma', FILTER_SANITIZE_STRING); 
                try 
                {  //Acciones sobre la base de datos
                    if ($action == 'insert' && !empty($diaslaborados) && !empty($pagofinal)) 
                    {                     
                        $consulta="INSERT INTO nomina(id_Empleado, Dias_laborados, fecha, pago_final, Firma)VALUES('$selectEmpleado', '$diaslaborados', '$fecha', '$pagofinal', '$firma')";
                        $db = conectar();
                        $ejecutar = mysqli_query($db, $consulta);                                 
                    }       
                }
                catch (Exception $ex) 
                {
                    echo "Ha ocurrido un error<br/>" . $ex->getMessage();
                } 
            ?>
            <?php  $consulta = "SELECT * FROM nomina  ORDER BY idNomina";
                $db = conectar();                        
                $ejecutar = mysqli_query($db, $consulta);
            ?>
            <div class="divtable">
                <table  class="table">
                        <thead>
                            <th colspan="6" >Datos de los pagos a los trabajadores</th>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Id nomina</td>
                                <td>Id empleado</td>
                                <td>Días laborados</td>
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
            
            <div class="divframe">
                <iframe src="recibonomina.php" type="" width="800px" height="800px"> </iframe>
            </div>
    </main>
    <footer class="footer">
        <p>
            Lunaterrecas A. C.
        </p>
    </footer>
</body>
</html>