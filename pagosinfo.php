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
</head>
<body>
    <?php 
    include 'Menu.php';
    $nombre = '';
    $apellidopaterno = '';
    ?>
    <main>           
        <div class="div">      
        <h2>Buscar pagos de un cliente</h2>       
                <form class="formulario">
                        <input type="hidden" name="action" value="insert">
                        <label for="">Nombre<input type="text" name="nombre"></label>
                        <label for="">Apellido paterno<input type="text" name="apellidopaterno"></label>
                        <label for="">Apellido materno<input type="text" name="apellidomaterno"></label>
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
            if ($action == 'insert' && !empty($nombre) && !empty($apellidopaterno) && !empty($apellidomaterno)) 
            {
                $SELECT= "SELECT * FROM  ventas INNER JOIN clientes WHERE (clientes.Nombre = '$nombre') AND (clientes.ApellidoPaterno = '$apellidopaterno') AND (clientes.ApellidoMaterno = '$apellidomaterno')";
                $db = conectar();
                $ejecutar = mysqli_query($db, $SELECT);
                $procesar = mysqli_fetch_assoc($ejecutar);
                $idventa = $procesar['idVenta'];                                             
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
                        //$totalformato = number_format($total, 2);
                    ?>
                    <tfoot>
                        <tr>
                            <td colspan="4">Total:</td><td colspan="1">$<?php echo"$total"?></td>
                        </tr>
                    </tfoot>      
                </table>  
            </div>
        </div> 
            
       
        
    </main>    
</body>
    <footer class="footer">
 <p>Lunaterrecas A. C.</p>
    </footer>
</html>