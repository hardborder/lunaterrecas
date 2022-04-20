<?php include 'php/conexion.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php include 'menuSecretaria.php';?>
    <?php 
   
    if ($_SERVER['REQUEST_METHOD'] === 'POST')        
    {
            
            $idcliente = $_POST['idcliente'];
            $nombre = $_POST['nombre'];
            $apellidopaterno = $_POST['apellidopaterno'];
            $apellidomaterno = $_POST['apellidomaterno'];            
            $consulta = "SELECT * FROM testigos WHERE (nombre='$nombre') AND (apellidopaterno='$apellidopaterno') AND (apellidomaterno='$apellidomaterno')";
            $db = conectar();
            $ejecutar = mysqli_query($db, $consulta);   
            $proceso = mysqli_fetch_assoc($ejecutar);         
            if(!isset($proceso))
            {
                $consulta = "INSERT INTO testigos (idCliente, Nombre, apellidoPaterno, apellidoMaterno) VALUES ('$idcliente', '$nombre', '$apellidopaterno', '$apellidomaterno')";
                $db = conectar();
                $ejecutar = mysqli_query($db, $consulta);           
            }            
            else
            {
                echo"<script>alert('El nombre del testigo ya existe, ingresa otro nombre');</script>";
            }
    }

    ?>
    <main>
        <div class="divtable">
            <table class="table">
                <thead>
                    <th colspan="5">Información de los testigos de los clientes</th>
                </thead>
                <tbody>
                    <tr>
                        <td>Id testigo</td>
                        <td>Id cliente</td>
                        <td>Nombre</td>
                        <td>Apellido paterno</td>
                        <td>Apellido materno</td>
                    </tr>
                </tbody>
                <?php
                 $consulta = "SELECT * FROM testigos";
                 $db = conectar();
                 $ejecutar = mysqli_query($db,$consulta);

                while ($proceso=mysqli_fetch_assoc($ejecutar)){?>
                    <tr>
                        <td><?php echo"$proceso[idTestigo]"; ?></td>
                        <td><?php echo"$proceso[idCliente]"; ?></td>
                        <td><?php echo"$proceso[Nombre]"; ?></td>
                        <td><?php echo"$proceso[apellidoPaterno]"; ?></td>
                        <td><?php echo"$proceso[apellidoMaterno]"; ?></td>
                    </tr> 
                    <?php } ?>             
            </table>
        </div>
        <div class="div" >
            <div class="divformulario">
                <form class="formulario" action="testigos.php" method="POST">                    
                    <select  name="idcliente" >
                        <option value="0">Seleccionar</option>
                            <?php 
                                $null ='';
                                $consulta = "SELECT * FROM  clientes";
                                $db = conectar();
                                $ejecutar = mysqli_query($db, $consulta);                                  
                                while($proceso = mysqli_fetch_assoc($ejecutar))       
                                {
                                    echo"<option value= '$proceso[idCliente]'> $proceso[Nombre] $proceso[ApellidoPaterno] $proceso[ApellidoMaterno]</option>";
                                }              
                                
                            ?>
                    </select>            
                    <input required name="nombre" type="text" placeholder="Nombre">
                    <input name="apellidopaterno" type="text" placeholder="Apellido paterno">
                    <input name="apellidomaterno" type="text" placeholder="Apellido materno">
                    <input class="botonEnviar" type="submit" value="Enviar">
                </form>
            </div>
        </div>      
    </main>
    <footer class="footer">
        Lunaterrecas A. C.
    </footer>
</body>
</html>