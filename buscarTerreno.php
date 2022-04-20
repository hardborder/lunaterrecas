<?php

    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
       
    }else{
        header('Location:cerrar.php');
    }
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
<?php
include 'Menu.php';
?>
<body>
    <main>
        <div class="div">
            <div class="divformularioBuscarterreno">
                <form class="formulario">
                        <label for="">Fraccionamiento<input type="text" name="fraccionamiento"></label>
                        <label for="">Fraccion<input type="text" name="fraccion"></label>
                        <label for="">Manzana<input type="text" name="manzana"></label>
                        <input type="submit" value="Buscar">
                </form>
            </div>
        </div>   
        <div class="divtable">
            <table class="table">
                <tr>
                    <td>Id</td>
                    <td>Fraccionamiento</td>
                    <td>Fraccion</td>
                    <td>Manzana</td>
                </tr>
                <?php                              
                        $fraccionamiento = filter_input(INPUT_GET, 'fraccionamiento', FILTER_SANITIZE_STRING);
                        $fraccion = filter_input(INPUT_GET, 'fraccion', FILTER_SANITIZE_STRING);
                        $manzana = filter_input(INPUT_GET, 'manzana', FILTER_SANITIZE_STRING);
                        try
                        {
                            
                            $sentencia  = "SELECT * FROM terrenos WHERE 1";
                            $db= conectar();
                            if (!empty($fraccionamiento)){
                                $sentencia.=" and fraccionamiento like '%$fraccionamiento%'";
                            }
                            if (!empty($fraccion)){
                                $sentencia.=" and fraccion like '%$fraccion%'";
                            }
                            if (!empty($manzana)){
                                $sentencia.=" and manzana like '%$manzana%'";
                            }
                        
                            
                            $ejecutar = mysqli_query($db, $sentencia);
                            while ($proceso = mysqli_fetch_assoc($ejecutar)) 
                            {
                    ?>
                            <tr>
                                <td><?= $proceso['idTerreno'] ?></td>
                                <td><?= $proceso['Fraccionamiento'] ?></td>
                                <td><?= $proceso['Fraccion'] ?></td>
                                <td><?= $proceso['Manzana'] ?></td>
                                <td>
                                    <a href="?action=delete&id=<?= $proceso['idTerreno'] ?>" >Borrar</a>
                                    <a href="update.php?id=<?= $proceso['idTerreno'] ?>" >Editar</a>
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
    </main>
</body>
</html>