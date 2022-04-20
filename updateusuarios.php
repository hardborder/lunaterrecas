<?php include 'php/conexion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/Trabajadores.css">
    <link rel="stylesheet" href="css/normalizer.css">
    <title>Document</title>
</head>
<body>
        <?php
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);                                                
                $sentencia = "SELECT * FROM usuarios WHERE idUsuarios = $id";
                $db = conectar();
                $ejecutar = mysqli_query($db, $sentencia);
                $proceso = mysqli_fetch_assoc($ejecutar);   
                                
        ?>
    <main>               
        <div class="div">
            <div class="divformularioUSUARIOS">
                <h2>Actualizar usuarios</h2>
                <form class="formulario" action="usuarios.php" >   
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?=$id?>">    
                    <label for="">Usuario<input type="text" name="usuario" value="<?=$proceso['Usuario']?>"></label> 
                    <label for="">Contraseña<input type="text" name="contraseña" value="<?=$proceso['contra']?>"></label>             
                    <label for="">Puesto<input type="text" name="puesto" value="<?=$proceso['Puesto']?>"></label>                
                    <input class="botonEnviar" type="submit"  value="Enviar">
                </form>
            </div>  
       </div>
    </main>
</body>
</html>