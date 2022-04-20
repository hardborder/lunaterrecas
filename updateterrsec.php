<?php include 'php/conexion.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/Trabajadores.css">
</head>
<body>
                <?php
                    $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
                    $sentencia = "SELECT * FROM terrenos WHERE idTerreno = $id";
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $sentencia);
                    $proceso = mysqli_fetch_assoc($ejecutar);                    
                ?>
    <main>  
        <div class="div">
            <div class="divformularioUpdateTerr"" >
                <h1>Editar terreno</h1>
                <form  class="formulario" action="terrenosSecretaria.php">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" name="id" value="<?=$id?>">
                    <label for="">Estatus<input type="text" name="estatus" value="<?php $proceso['Estatus']?>"></label>
                    <label for="">Precio<input type="text" name="precio" value="<?=$proceso['Precio']?>"></label>
                    <label for="">Superficie<input type="text" name="superficie" value="<?=$proceso['Superficie']?>"></label>
                    <label for="">Al noreste<input type="text" name="alnoreste" value="<?=$proceso['alNoreste']?>"></label>
                    <label for="">Al noroeste<input type="text" name="alnoroeste" value="<?=$proceso['alNoroeste']?>"></label>
                    <label for="">Al sureste<input type="text" name="alsureste" value="<?=$proceso['alSureste']?>"></label>
                    <label for="">Al suroeste<input type="text" name="alsuroeste" value="<?=$proceso['alSuroeste']?>"></label>
                    <label for="">Municipio<input type="text" name="municipio" value="<?=$proceso['Municipio']?>"></label>
                    <label for="">Estado<input type="text" name="estado" value="<?=$proceso['Estado']?>"></label>
                    <label for="">Fraccionamiento<input type="text" name="fraccionamiento" value="<?=$proceso['Fraccionamiento']?>"></label>
                    <label for="">Fracción<input type="text" name="fraccion" value="<?=$proceso['Fraccion']?>"></label>
                    <label for="">Manzana<input type="text" name="manzana" value="<?=$proceso['Manzana']?>"></label>
                    <input type="submit" value="Actualizar Datos">
                </form>
            </div>
        </div>      
       
    </main>
</body>
</html>