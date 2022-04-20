<?php
include 'php/conexion.php';
?>
<?php    
    session_start();
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador' OR 'Secretaria'){
       
    }else{
        header('location:/cerrar.php');
    }
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Trabajadores.css">
    
</head>
<body>
    
    <?php
    if($_SESSION['tipo'] =='Secretaria')
    {
        include 'menuSecretaria.php';
    }
    if($_SESSION['tipo'] =='Administrador')
    {
            include 'Menu.php';
    }
    ?>
    
    <main>
        <?php
                $consulta = "SELECT * FROM clientes WHERE idCliente > 0";
                $db = conectar();
                $ejecutar = mysqli_query($db,$consulta);
        ?>
    <div class="divtable">
        <table>
            <thead>
                <th colspan="15"> Datos de los clientes</th>
            </thead>
            <tbody>
                <tr>
                    <td>Foto</td>
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
                    <td ><img width="100px" src="<?php echo "$proceso[Foto]"; ?>" ></td>
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
    </div>
    </main>
</body>
<footer class="footer">
    <p>Lunaterrecas A. C.</p>
</footer>
</html>