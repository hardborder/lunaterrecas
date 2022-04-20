<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
?>
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
    include 'menuSecretaria.php';
    ?>
<main>
    <?php 
    $sentencia = "SELECT * FROM empleados WHERE Puesto = 'Vendedor'";
    $db = conectar();
    $ejecutar = mysqli_query($db,$sentencia);
    ?>
    <table class="table">
        <thead>
            <th colspan="16">Datos de vendedores</th>
        </thead>
        <tbody>
            <tr>
                <td>Id Empleado</td>
                <td>Puesto</td>
                <td>Nombre</td>
                <td>Apellido paterno</td>
                <td>Apellido materno</td>
                <td>fecha de nacimiento</td>
                <td>Teléfono</td>
                <td>Celular</td>
                <td>Correo</td>
                <td>Fecha de ingreso</td>
                <td>Calle</td>
                <td>Número</td>
                <td>Colonia</td>
                <td>Código postal</td>
                <td>Municipio</td>
                <td>Estado</td>
            </tr>
        </tbody>
        <?php while ($proceso = mysqli_fetch_assoc($ejecutar)){?>
                <tr>
                    <td> <?php echo "$proceso[idEmpleado]"; ?> </td> 
                    <td> <?php echo "$proceso[Puesto]"; ?> </td>
                    <td> <?php echo "$proceso[Nombre]"; ?> </td>
                    <td> <?php echo "$proceso[ApellidoPaterno]";?> </td>
                    <td> <?php echo "$proceso[ApellidoMaterno]";?> </td>   
                    <td> <?php echo "$proceso[FechaNacimiento]";?> </td>
                    <td> <?php echo "$proceso[Telefono]";?>  </td>
                    <td> <?php echo "$proceso[Celular]";?> </td>
                    <td> <?php echo "$proceso[Correo]";?> </td>
                    <td> <?php echo "$proceso[FechaIngreso]";?> </td>
                    <td> <?php echo "$proceso[Calle]";?> </td>
                    <td> <?php echo "$proceso[Numero]";?> </td>
                    <td> <?php echo "$proceso[Colonia]";?> </td>
                    <td> <?php echo "$proceso[CP]";?> 
                    <td> <?php echo "$proceso[Municipio]";?> 
                    <td> <?php echo "$proceso[Estado]";?>  </td>  
                </tr>  
        <?php } ?>                    
    </table>

</main>


<footer class="footer">
    <p>Lunaterrecas A. C.</p>
</footer>

</body>
</html>