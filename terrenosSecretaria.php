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
        <div class="div">
            <div class="divterrenos">        
                <form class="formulario" >
                    <input type="hidden" name="action" value="insert">                
                    <label for="">Estatus<input type="text" name="estatus" "></label>
                    <label for="">Precio<input type="text" name="precio"></label>
                    <label for="">Superficie<input type="text" name="superficie"></label>
                    <label for="">Al noreste<input type="text" name="alnoreste" ></label> 
                    <label for="">Al noroeste<input type="text" name="alnoroeste"></label>
                    <label for="">Al sureste<input type="text" name="alsureste"></label>
                    <label for="">Al suroeste<input type="text" name="alsuroeste"></label> 
                    <label for="">Municipio<input type="text" name="municipio"></label> 
                    <label for="">Estado<input type="text" name="estado"></label> 
                    <label for="">Fraccionamiento<input type="text" name="fraccionamiento"></label> 
                    <label for="">Fraccion<input type="text" name="fraccion"></label>
                    <label for="">Manzana<input type="text" name="manzana" "></label>                 
                    <input type="submit" value="Insertar">
                </form>
            </div> 
        </div>
          
        <?php           
            $action = filter_input(INPUT_GET, 'action');
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
            $estatus = filter_input(INPUT_GET, 'estatus', FILTER_SANITIZE_STRING);
            $precio = filter_input(INPUT_GET, 'precio', FILTER_VALIDATE_INT);
            $superficie = filter_input(INPUT_GET, 'superficie', FILTER_SANITIZE_STRING);
            $alnoreste = filter_input(INPUT_GET, 'alnoreste', FILTER_VALIDATE_INT);
            $alnoroeste = filter_input(INPUT_GET, 'alnoroeste', FILTER_VALIDATE_INT);
            $alsureste = filter_input(INPUT_GET, 'alsureste', FILTER_VALIDATE_INT);
            $alsuroeste = filter_input(INPUT_GET, 'alsuroeste', FILTER_VALIDATE_INT);
            $municipio = filter_input(INPUT_GET, 'municipio', FILTER_SANITIZE_STRING);
            $estado = filter_input(INPUT_GET, 'estado', FILTER_SANITIZE_STRING);
            $fraccionamiento = filter_input(INPUT_GET, 'fraccionamiento', FILTER_SANITIZE_STRING);
            $fraccion = filter_input(INPUT_GET, 'fraccion', FILTER_SANITIZE_STRING);
            $manzana = filter_input(INPUT_GET, 'manzana', FILTER_SANITIZE_STRING);  
            try 
            {  //Acciones sobre la base de datos
                if ($action == 'insert' && !empty($estatus) && !empty($precio)) 
                {
                    $sentencia =  "SELECT * FROM terrenos WHERE  Fraccionamiento = '$fraccionamiento' AND Fraccion = '$fraccion' AND Manzana = '$manzana'";
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $sentencia);
                    $procesar = mysqli_fetch_assoc($ejecutar);    
                    
                    if(!isset($procesar))
                    {
                        $sentencia = "INSERT INTO terrenos (Estatus, Precio, Superficie, alNoreste, alNoroeste, alSureste, alSuroeste, Municipio, Estado, Fraccionamiento, Fraccion, Manzana)
                        VALUES('$estatus', '$precio', '$superficie', '$alnoreste', '$alnoroeste',  '$alsureste', '$alsuroeste', '$municipio', '$estado', '$fraccionamiento', '$fraccion', '$manzana')";
                        $db = conectar();
                        $ejecutar = mysqli_query($db, $sentencia);                        
                    }
                    else
                    {
                        echo"<script> alert('El terreno ya existe'); </script>";
                    }
                    
                                     
                }
                if ($action == "delete" && !empty($id)) 
                {
                    $sentencia = "DELETE FROM terrenos WHERE idTerreno = '$id'";
                    $db =conectar();
                    $ejecutar = mysqli_query($db, $sentencia);     
                        
                }
                if ($action == 'update' && !empty($id)) 
                {
                    $sentencia = "UPDATE terrenos SET Estatus='$estatus', Precio='$precio', Superficie='$superficie', alNoreste='$alnoreste', alNoroeste='$alnoroeste', alSureste='$alsureste', alSuroeste='$alsuroeste',
                    Municipio ='$municipio', Estado='$estado', Fraccionamiento='$fraccionamiento', Fraccion='$fraccion', Manzana='$manzana' WHERE idTerreno='$id'";
                   
                   $db = conectar();
                    $ejecutar = mysqli_query($db,$sentencia);                    
                }
                
            }
            catch (Exception $ex) {
                echo "Ha ocurrido un error<br/>" . $ex->getMessage();
            }             
        ?>
        
        <table class="table">
                <thead>
                    <th colspan="15">Datos de los terrenos</th>
                </thead>
                <tbody>
                    <tr>
                        <td>ID terreno</td>
                        <td>Estatus</td>
                        <td>Precio</td>
                        <td>Superficie</td>
                        <td>Al noreste</td>
                        <td>Al noroeste</td>
                        <td>Al sureste</td>
                        <td>Al suroeste</td>
                        <td>Municipio</td>
                        <td>Estado</td>
                        <td>Fraccionamiento</td>
                        <td>Fracción</td>
                        <td>Manzana</td>
                        <td>Foto</td>
                        <td>Operaciones</td>
                    </tr>
                </tbody>
                <?php
                $sentencia = "SELECT * FROM terrenos ORDER BY idTerreno";
                $db = conectar();
                $ejecutar = mysqli_query($db, $sentencia);
                ?>
                <?php while($proceso = mysqli_fetch_assoc($ejecutar)) {?>
                <tr> 
                    <td><?php echo"$proceso[idTerreno]"; ?></td>                 
                    <td><?php echo"$proceso[Estatus]"; ?></td>
                    <td><?php echo"$proceso[Precio]"; ?></td>
                    <td><?php echo"$proceso[Superficie]"; ?></td>
                    <td><?php echo"$proceso[alNoreste]"; ?></td>
                    <td><?php echo"$proceso[alNoroeste]"; ?></td>
                    <td><?php echo"$proceso[alSureste]"; ?></td>
                    <td><?php echo"$proceso[alSuroeste]"; ?></td>
                    <td><?php echo"$proceso[Municipio]"; ?></td>
                    <td><?php echo"$proceso[Estado]"; ?></td>
                    <td><?php echo"$proceso[Fraccionamiento]"; ?></td>
                    <td><?php echo"$proceso[Fraccion]"; ?></td>
                    <td><?php echo"$proceso[Manzana]"; ?></td>
                    <td ><img width="100px" src="<?php echo $proceso['Foto']; ?>" ></td>  
                    <td>
                        <a href="?action=delete&id=<?= $proceso['idTerreno'] ?>" >Borrar</a>
                        <a href="updateterrsec.php?id=<?= $proceso['idTerreno'] ?>" >Editar</a>
                    </td>                 
                </tr>
                <?php } ?>
        </table>
    </main>

</body>
</html>