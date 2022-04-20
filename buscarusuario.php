<?php include 'php/conexion.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
include 'Menu.php';
?>
<body>
    <main>
    <div class="div">
        <div class="divformularioBuscarterreno">
            <form class="formulario">
                    <label for="">usuario<input type="text" name="usuario"></label>                    
                    <input type="submit" value="Buscar">
            </form>
        </div>
    </div>   
        <div class="divtable">
            <table class="table">
            <tr>
                <td>Id usuario</td>
                <td>Id empleado</td>
                <td>Contraseña</td>
                <td>Puesto</td>
                </tr>
            <?php  
                            
                    $usuario = filter_input(INPUT_GET, 'usuario', FILTER_SANITIZE_STRING);                   
                    try
                    {
                        
                        $sentencia  = "SELECT * FROM usuarios WHERE 1";
                        $db= conectar();
                        if (!empty($usuario)){
                            $sentencia.=" and usuario like '%$usuario%'";
                        }
                        
                    
                        
                        $ejecutar = mysqli_query($db, $sentencia);
                        while ($proceso = mysqli_fetch_assoc($ejecutar)) 
                        {
                ?>
                        <tr>
                            <td><?= $proceso['idUsuarios'] ?></td>
                            <td><?= $proceso['id_Empleado'] ?></td>
                            <td><?= $proceso['Usuario'] ?></td>
                            <td><?= $proceso['contra'] ?></td>
                            <td><?= $proceso['Puesto'] ?></td>
                            <td>
                                <a href="?action=delete&id=<?= $proceso['idUsuarios'] ?>" >Borrar</a>
                                <a href="updateusuarios.php?id=<?= $proceso['idUsuarios'] ?>" >Editar</a>
                            </td>
                        </tr>
        
                        <?php
                        }
                    }
                    catch (Exception $ex) 
                            {
                                echo "Ha ocurrido un error<br/>" . $ex->getMessage();
                            }
                        ?>
            </table>
        </div>    
    <main>
</body>
</html>