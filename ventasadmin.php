<?php 
include 'php/conexion.php'; 

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
<?php include 'Menu.php'; ?>
<body>    
    <?php 
        $sentencia = "SELECT * FROM ventas";
        $db = conectar();
        $ejecutar = mysqli_query($db, $sentencia);
    ?>
    <main>
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