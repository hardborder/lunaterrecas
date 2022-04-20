<?php
    session_start();  
    
    $_SESSION['total']='';
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
?>
<?php include "php/conexion.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    
</head>
<body>
    <?php include "menuSecretaria.php" ;  

    $consulta = "SELECT * FROM caja_chica ORDER BY idCajaChica ";
    $db = conectar();
    $ejecutar = mysqli_query($db,$consulta);    
    
    ?>
    <main>
        <div class="divtable">
            <table class="table">
                <thead>
                    <td colspan="6">Registros de la caja chica</td>
                </thead>
                <tbody>
                    <tr>
                        <td>IdCajaChica</td>
                        <td>Fecha</td>
                        <td>Monto</td>
                        <td>Concepto</td>
                        <td>Tipo de concepto</td>
                        <td>Firma de directora</td>
                    </tr>
                </tbody>  
                <?php while($proceso =  mysqli_fetch_assoc($ejecutar)){?>        
                    <tr>
                        <td><?php echo"$proceso[idCajaChica]";?></td>
                        <td><?php echo"$proceso[Fecha]";?></td>
                        <td><?php echo"$proceso[Monto]"?></td>
                        <td><?php echo"$proceso[Concepto]"?></td>
                        <td><?php echo"$proceso[Tipo_concepto]"?></td>
                        <td><?php echo"$proceso[FirmaDirectora]"?></td>
                    </tr>   
                <?php }?>    
                <thead>
                    <?php 
                        $fechadeldia = date('Y-m-d');
                        $consulta = "SELECT sum(Monto) FROM caja_chica WHERE Fecha = '$fechadeldia' ";
                        
                        $db = conectar();
                        $ejecutar = mysqli_query($db, $consulta);
                        $procesar = mysqli_fetch_assoc($ejecutar);
                        $total = $procesar["sum(Monto)"];
                        
                    ?>
                    <td colspan="5">Total del día:</td><td colspan="1">$<?php echo $total ?></td>
                </thead>           
            </table>
        </div>
          
    </main>
</body>
</html>