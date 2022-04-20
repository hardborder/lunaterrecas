<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador' OR 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
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
    <?php

    include 'php/conexion.php' 
    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/juery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript" src="jquery_formato.js" ></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
    if($_SERVER['REQUEST_METHOD'] ==='POST')
    {  
        
        
                     
            //$ruta_indexphp = dirname(realpath(__FILE__));
            
            
            //$ruta_nuevo_destino = $ruta_indexphp . '/img/' . $_FILES['imagen1']['name'];
          
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

        $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
        $max_tamanyo = 1024 * 1024 * 8;   
        $nom_archivo = $_FILES['imagen']['name'];
        $ruta = "img/".$nom_archivo;
        $archivo = $_FILES['imagen']['tmp_name'];
        $subir = move_uploaded_file($archivo, $ruta);        
        //$imgContent = addslashes(file_get_contents($ruta_fichero_origen));

        $consulta = "SELECT * FROM clientes WHERE (Nombre='$Nombre') and (ApellidoPaterno='$ApellidoPaterno') and (ApellidoMaterno = '$ApellidoMaterno') ";
        $db = conectar();
        $ejecutar = mysqli_query($db, $consulta);
        $proceso = mysqli_fetch_assoc($ejecutar);
        
        if(!isset($proceso))
        {    
            if ( in_array($_FILES['imagen']['type'], $extensiones) ) 
            {
                if ( $_FILES['imagen']['size']< $max_tamanyo ) 
                {
                    $consulta = "INSERT INTO clientes (Nombre, ApellidoPaterno, ApellidoMaterno, Telefono, Celular, Correo, Calle, Numero, Fraccionamiento, CP, Municipio, Estado, Identificacion, Foto) VALUES ('$Nombre', '$ApellidoPaterno', '$ApellidoMaterno', '$Telefono', '$Celular', '$Correo', '$Calle', '$Numero', '$Colonia', '$Cp', '$Municipio', '$Estado', '$Identificacion', '$ruta')";
                    $db = conectar();
                    $ejecutar = mysqli_query($db,$consulta);
                        
                    if ($ejecutar)
                    {
                        echo"<script> alert('Datos del cliente enviados'); </script>";
                    }
                }
                else
                {
                   echo "<script>alert(Ingresa una imagen de tamaño menor a 1024 * 1024 * 8);</script>";
                }
            }
           else
           {
                echo "<script>alert(Ingresa una imagen de tipo jpg, jpeg, o png);</script>";
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
        <div class="divformularioCLIENTES">
            <h2>Registro de clientes</h2>
            <form class="formulario" action="agregarClientes.php" method="POST" enctype="multipart/form-data">                       
                <label>Nombre<input required pattern="^[A-Z]{1}[a-záéíóú]+[\s]*" minlength="2" maxlength="20" type="text" name="nombre" placeholder="Ej. Salvador"></label>     
                <label>Apellido paterno<input required pattern="^[A-Z]{1}[a-záéíóú]+[\s]*" minlength="2" maxlength="20" type="text" name="apellidoPaterno" placeholder="Ej. García"></label>    
                <label>Apellido materno<input required pattern="^[A-Z]{1}[a-záéíóú]+[\s]*" minlength="2" maxlength="20" type="text" name="apellidoMaterno" placeholder="Ej. Morales"></label>  
                <label>Teléfono<input  required name="telefono" id="tel" pattern="^[0-9\(\)\s-]+" minlength="7" maxlength="12" type="text" placeholder="Ej. 92 2 30 30"></label>    
                <label>Celular<input required pattern="^[0-9\(\)\s-]+" minlength="10" maxlength="15" name="celular" id="cel" type="text" placeholder="Ej. 492 129 67 94"> </label>    
                <label>Correo<input required  maxlength="25" pattern="^[A-Za-z0-9._%+-]+@(gmail|hotmail)+\.[a-z]{2,}$" title="Ingresa una cuenta de Gmail o Hotmail con el formato: correo@gmail.com"  type="text" name="correo" placeholder="Ej. correo@gmail.com"></label> 
                <label>Calle<input  required pattern="^[A-Za-z\sáéíóú-]+$" maxlength="20" type="text" name="calle" placeholder="Ej. Río Juchipila"></label>   
                <label>Número<input required pattern="^[0-9]+[A-Za-z]?$" maxlength="5" type="text" name="numero" placeholder="Ej. 204B"></label>     
                <label>Colonia<input required  pattern="^[A-Za-z\sáéíóú-]+$" maxlength="20" type="text" name="colonia" placeholder="Ej. Bernardez"></label> 
                <label>CP<input required  pattern="^[0-9]{2,}$" maxlength="5" type="text" name="cp" placeholder="Ej. 98068"></label>              
                <label>Municipio<input required pattern="^[A-Z]{1}[a-z]+$" maxlength="25" type="text" name="municipio" placeholder="Ej. Zacatecas"></label>      
                <label>Estado<input required pattern="^[A-Z]{1}[a-z]+$" maxlength="25" type="text" name="estado" placeholder="Ej. Zacatecas"></label>                                  
                <label>Identificacion<input required pattern="^[A-Za-z0-9\\-]+$" maxlength="30" type="text" name="identificacion" placeholder="Ej. LURO920507HZSNMW018"></label>
                <label>Fotografia<input type="file" name="imagen"></label>                
                <label for=""></label>
                <label for=""></label>               
                <input class="botonEnviar" type="submit" value="Enviar">                         
            </form>
        </div>
    </div>
    </main>
    <footer class="footer">
        <p>Lunaterrecas A. C.</p>
    </footer>
</body>
</html>