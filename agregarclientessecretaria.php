<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
<?php
include 'php/conexion.php' 
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
    include  'menuSecretaria.php';
    ?>
    <?php
        if($_SERVER['REQUEST_METHOD'] ==='POST')
        {
          
            $Nombre = '';
            $ApellidoPaterno = '';
            $ApellidoMaterno = '';
            $Telefono = '';
            $Celular  ='';
            $Correo = '';
            $Calle = '';
            $Numero = '';
            $Colonia = '';
            $Cp = '';
            $Municipio = '';
            $Estado = '';
            $Identificación = '';

            $Nombre = $_POST['nombre'];
            $ApellidoPaterno = $_POST['apellidoPaterno'];
            $ApellidoMaterno = $_POST['apellidoMaterno'];
            $Telefono = $_POST['telefono'];
            $Celular = $_POST['celular'];
            $Correo = $_POST['correo'];
            $Calle = $_POST['calle'];
            $Numero = $_POST['numero'];
            $Colonia = $_POST['colonia'];
            $Cp = $_POST['cp'];
            $Municipio = $_POST['municipio'];
            $Estado = $_POST['estado'];
            $Identificacion = $_POST['identificacion'];

            $consulta = "SELECT * FROM clientes WHERE (Nombre='$Nombre') and (ApellidoPaterno='$ApellidoPaterno') and (ApellidoMaterno = '$ApellidoMaterno') ";
            $db = conectar();
            $ejecutar = mysqli_query($db, $consulta);
            $proceso = mysqli_fetch_assoc($ejecutar);
            var_dump($proceso);
            if(!isset($proceso))
            {                
                $consulta = "INSERT INTO clientes (Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, Celular, Correo, Calle, Numero, Fraccionamiento, CP, Municipio, Estado, Identificacion) VALUES ('$Nombre', '$ApellidoPaterno', '$ApellidoMaterno', '$Telefono', '$Celular', '$Correo', '$Calle', '$Numero', '$Colonia', '$Cp', '$Municipio', '$Estado', '$Identificacion' )";
                $db = conectar();
                $ejecutar = mysqli_query($db,$consulta);
                 
                if ($ejecutar)
                {
                    echo"<script> alert('Datos del cliente enviados'); </script>";
                }
            }
            else
            {
                echo"<script> alert('Ese nombre de cliente ya existe'); </script>";
            }
           
        }
    ?>
    <main>
        
    <div class="div">
        <div class="divformulario">
            <h2>Registro de clientes</h2>
            <form class="formulario" action="agregarclientessecretaria.php" method="POST">
                <label>Nombre<input type="text" name="nombre" placeholder="Nombre"></label>   
                <label>Apellido paterno<input type="text" name="apellidoPaterno" placeholder="Apellido paterno"></label>
                <label for="">Apellido materno<input type="text" name="apellidoMaterno" placeholder="Apellido materno">  </label>
                <label for="">Teléfono<input type="text" name="telefono" placeholder="Teléfono"></label>    
                <label for="">Celular<input type="text" name="celular" placeholder="Celular"> </label>  
                <label for="">Correo<input title="Ingresa una cuenta de Gmail o Hotmail con el formato: correo@gmail.com"  type="text" name="correo" placeholder="Ej.correo@gmail.com"></label>    
                <label for="">Calle<input type="text" name="calle" placeholder="Calle"></label>   
                <label for="">Número<input type="text" name="numero" placeholder="Número">  </label>
                <label for="">Colonia<input type="text" name="colonia" placeholder="Fraccionamiento"></label>
                <label for="">CP<input type="text" name="cp" placeholder="CP"> </label>
                <label for="">Municipio<input type="text" name="municipio" placeholder="Municipio">    </label>   
                <label for="">Estado<input type="text" name="estado" placeholder="Estado"> </label>
                <label for="">Identificacion<input type="text" name="identificacion" placeholder="Identificación"></label>  
                <label for=""></label>
                <label for=""></label>                               
                <input class="botonEnviar" type="submit" value="Enviar">                         
            </form>
        </div>
    </div>
    </main>
</body>
</html>