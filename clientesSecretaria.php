<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
?>
<?php include "php/conexion.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include"menuSecretaria.php"; 
    
    ?>
    <main>
    <?php
                $consulta = "SELECT * FROM clientes WHERE idCliente > 0";
                $db = conectar();
                $ejecutar = mysqli_query($db,$consulta);
        ?>

        <table class="table">
            <thead>
                <th colspan="14"> Datos de los clientes</th>
            </thead>
            <tbody>
                <tr>
                    <td>IdCliente</td>
                    <td>Nombre</td>
                    <td>ApellidoPaterno</td>
                    <td>ApellidoMaterno</td>
                    <td>Teléfono</td>
                    <td>Celular</td>
                    <td>Correo</td>
                    <td>Calle</td>
                    <td>Número</td>
                    <td>Fraccionamiento</td>
                    <td>CP</td>
                    <td>Municipio</td>
                    <td>Estado</td>
                    <td>Identificación</td>
                </tr>
            </tbody>
            <?php while($proceso = mysqli_fetch_assoc($ejecutar)){ ?>
                <tr>
                    <td><?php echo "$proceso[idCliente]"; ?></td>
                    <td><?php echo "$proceso[Nombre]"; ?></td>
                    <td><?php echo "$proceso[ApellidoPaterno]"; ?></td>
                    <td><?php echo "$proceso[ApellidoMaterno]"; ?></td>
                    <td><?php echo "$proceso[Telefono]"; ?></td>
                    <td><?php echo "$proceso[Celular]"; ?></td>
                    <td><?php echo "$proceso[Correo]"; ?></td>
                    <td><?php echo "$proceso[Calle]"; ?></td>
                    <td><?php echo "$proceso[Numero]"; ?></td>
                    <td><?php echo "$proceso[Fraccionamiento]"; ?></td>
                    <td><?php echo "$proceso[CP]"; ?></td>
                    <td><?php echo "$proceso[Municipio]"; ?></td>
                    <td><?php echo "$proceso[Estado]"; ?></td>
                    <td><?php echo "$proceso[Identificacion]"; ?></td>
                
                </tr>
                <?php } ?>
        </table>

    
    </main>
    </main>
</body>
</html>