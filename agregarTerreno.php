<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
<?php include 'php/conexion.php'; ?>
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
<?php
 if($_SERVER['REQUEST_METHOD'] === 'POST' )
 {
    
    $estatus = '';
    $precio = '';
    $superficie = '';
    $alNoreste = '';
    $alNoroeste = '';
    $alSureste = '';
    $alSuroeste = '';
    $municipio = '';
    $estado = '';
    $fraccionamiento = '';
    $fraccion = '';
    $manzana = '';


    
    $estatus = $_POST['estatus'];
    $precio = $_POST['precio'];
    $superficie = $_POST['superficie'];
    $alNoreste = $_POST['alNoreste'];
    $alNoroeste = $_POST['alNoroeste'];
    $alSureste = $_POST['alSureste'];
    $alSuroeste = $_POST['alSuroeste'];
    $municipio = $_POST['municipio'];
    $estado = $_POST['estado'];
    $fraccionamiento = $_POST['fraccionamiento'];
    $fraccion = $_POST['fraccion'];
    $manzana = $_POST['manzana'];  
    
    $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
    $max_tamanyo = 1024 * 1024 * 8;   
    $nom_archivo = $_FILES['imagen']['name'];
    $ruta = "img/".$nom_archivo;
    $archivo = $_FILES['imagen']['tmp_name'];
    $subir = move_uploaded_file($archivo, $ruta);

    if($fraccion)
    {
        $sentencia =  "SELECT * FROM terrenos WHERE  Fraccionamiento = '$fraccionamiento' AND Fraccion = '$fraccion' AND Manzana = '$manzana'";
        $db = conectar();
        $ejecutar = mysqli_query($db, $sentencia);
        $procesar = mysqli_fetch_assoc($ejecutar);    
        
        if(!isset($procesar))
        {
            
            $sentencia = "INSERT INTO terrenos (Estatus, Precio, Superficie, alNoreste, alNoroeste, alSureste, alSuroeste, Municipio, Estado, Fraccionamiento, Fraccion, Manzana, Foto)
            VALUES('$estatus', '$precio', '$superficie', '$alNoreste', '$alNoroeste',  '$alSureste', '$alSuroeste', '$municipio', '$estado', '$fraccionamiento', '$fraccion', '$manzana', '$ruta')";
            $db = conectar();
            $ejecutar = mysqli_query($db, $sentencia);
            if($ejecutar)
            {
                echo"<script> alert('Datos del terreno enviados'); </script>";
            }
        }
        else
        {
            echo"<script> alert('El terreno ya existe'); </script>";
        }
    }
    else
    {
        echo"<script>alert('Ingresa los datos del terreno para su registro')</script>";
    }

    

 }

?>
<body>
 <main>
 <div class="div">
        <div class="divformulario">
            <h2>Registro de terrenos</h2>
                <form class="formulario" action="agregarTerreno.php" method="POST">       
                    <label >Estatus<input type="radio" name="estatus" value="Disponible">Disponible</label>                                                 
                    <label>Precio<input name="precio" type="text" placeholder="$"> </label>                
                    <label>Superficie<input name="superficie" type="text" placeholder="m²"></label>          
                    <label>Colindancia<input name="alNoreste" type="text" placeholder="Al noreste"></label> 
                    <label>Colinancia<input name="alNoroeste" type="text" placeholder="Al noroeste"></label>
                    <label>Colindancia<input name="alSureste" type="text" placeholder="Al sureste"></label>          
                    <label>Colindancia<input name="alSuroeste" type="text" placeholder="Al suroeste"></label>                
                    <label>Municipio<input name="municipio" type="text" placeholder="Ej. Zacatecas"></label>                
                    <label>Estado<input name="estado" type="text" placeholder="Ej. Zacatecas"> </label>                
                    <label>Fraccionamiento<input name="fraccionamiento" type="text" placeholder="Ej. Colinas"> </label>               
                    <label>Fracción<input name="fraccion" type="text" placeholder="Ej. F1"></label>                
                    <label>Manzana<input name="manzana" type="text" placeholder="Ej. M1"></label> 
                    <label>Fotografia<input type="file" name="imagen"></label>                                                      
                    <input class="botonEnviar" type="submit" value="Enviar">                                   
                </form>
        </div>
 </div> 
 </main>
    
</body>
</html>