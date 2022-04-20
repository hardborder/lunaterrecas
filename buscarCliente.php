<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador' OR 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
<?php
include 'php/conexion.php';
$idCliente = "";
$nombre = "";
$apellidoPaterno = "";
$apellidoMaterno = "";
$telefono = "";
$celular = "";
$correo = "";
$calle = "";
$numero = "";
$colonia = "";
$cp = "";
$municipio = "";
$estado = "";
$identificacion = "";
$Buscar = "";
$nom = "";
$apellidoPaternO = "";
$apellidoMaternO = "";
$foto = "";  

    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {        
        if(isset($_POST['Busqueda']))
        {
            $nom= $_POST['nombrE'];
            $apellidoPaternO = $_POST['apellidoP'];
            $apellidoMaternO = $_POST['apellidoM'];
            
            $consulta = "SELECT * FROM clientes WHERE (Nombre = '$nom') AND (ApellidoPaterno = '$apellidoPaternO') AND (ApellidoMaterno = '$apellidoMaternO')";
            $db= conectar();
            $ejecutar = mysqli_query($db, $consulta);
            $procesar =  mysqli_fetch_assoc($ejecutar);   
            if($procesar)
            {
                $idCliente  = $procesar['idCliente'];
                $nombre = $procesar['Nombre'];
                $apellidoPaterno =$procesar['ApellidoPaterno'];
                $apellidoMaterno = $procesar['ApellidoMaterno'];
                $telefono = $procesar['Telefono'];
                $celular = $procesar['Celular'];
                $correo = $procesar['Correo'];
                $calle = $procesar['Calle'];
                $numero = $procesar['Numero'];
                $colonia = $procesar['Fraccionamiento'];
                $cp = $procesar['CP'];
                $municipio = $procesar['Municipio'];
                $estado = $procesar['Estado'];
                $identificacion = $procesar['Identificacion'];
                $foto = $procesar['Foto'];                
            }
            else
            {
                echo "<script> alert ('Nombre no encontrado'); </script>";
            }

        } 
        
        if(isset($_POST['eliminar']))
        {                     
            $idCliente = $_POST['idCLIENTE'];
            
            if($idCliente)
            {
                $eliminar = "DELETE FROM clientes WHERE idCliente = '$idCliente'";
                $db=conectar();
                $consulta = mysqli_query($db, $eliminar);          
                if($consulta)
                {
                    echo"<script> alert('Datos del cliente eliminados');
                    </script>";
                    
                }          
               
            }
             else
             {
                echo"<script>alert('Ingresa un cliente para eliminar');</script> ";
             }      
        }
        if(isset($_POST['actualizar']))
        {
            $idClientE = $_POST['idCLIENTE'];
            $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
            $max_tamanyo = 1024 * 1024 * 8;   
            $nom_archivo = $_FILES['imagen']['name'];
            $ruta = "img/".$nom_archivo;
            $archivo = $_FILES['imagen']['tmp_name'];
            $subir = move_uploaded_file($archivo, $ruta);           
                if($idClientE)
                {
                    if ( in_array($_FILES['imagen']['type'], $extensiones) ) 
                        {
                            if ( $_FILES['imagen']['size']< $max_tamanyo ) 
                            {
                                $sentencia =  "UPDATE clientes SET Nombre = '$_POST[nombre]', ApellidoPaterno = '$_POST[apellidopaterno]', ApellidoMaterno = '$_POST[apellidomaterno]', 
                                Telefono = '$_POST[telefono]', Celular = '$_POST[celular]', Correo = '$_POST[correo]', Calle = '$_POST[calle]', Numero = '$_POST[numero]', 
                                Fraccionamiento = '$_POST[fraccionamiento]', CP = '$_POST[cp]', Municipio =  '$_POST[municipio]', Estado = '$_POST[estado]', Identificacion = '$_POST[identificacion]', Foto = '$ruta' WHERE idCliente = '$idClientE'";
                                $db = conectar();
                                $ejecutar  = mysqli_query($db, $sentencia);
                                if($ejecutar)
                                {
                                    echo"<script>alert('Datos del cliente actualizados');</script>";
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
                    echo"<script>alert('Ingresa un cliente para actualizar sus datos');</script>";
                }
                     
        }

    }
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
        if($_SESSION['tipo'] =='Secretaria')
        {
            include 'menuSecretaria.php';
        }
        if($_SESSION['tipo'] =='Administrador')
        {
                include 'Menu.php';
        }
    ?>
    
    <main>
        <div class="div">
            <div class="divformulario" >
            <h2>Formulario para buscar, eliminar o actualizar un cliente </h2>
                <form class="formulario" action="buscarCliente.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmar()">
                    <input placeholder="Nombre" name="nombrE" type="text" placeholder="Nombre">
                    <input placeholder="Apellido paterno" name="apellidoP" type="text" placeholder="Apellido paterno">
                    <input placeholder="Apellido materno" name="apellidoM" type="text" placeholder="Apellido materno">
                    <input class="botonEnviar" type="submit" name="Busqueda" value="Buscar">                    
                    
                    <input placeholder="Id cliente" name="idCLIENTE" type="text" value="<?php echo $idCliente; ?>">
                    <input placeholder="Nombre" name="nombre" type="text" value="<?php echo $nombre; ?>">
                    <input placeholder="Apellido paterno" name="apellidopaterno" type="text" value="<?php echo $apellidoPaterno; ?>">
                    <input placeholder="Apellido materno" name="apellidomaterno" type="text" value="<?php echo $apellidoMaterno; ?>">
                    <input placeholder="Teléfono" name="telefono" type="text" value="<?php echo $telefono; ?>">
                    <input placeholder="Celular" name="celular" type="text" value="<?php echo $celular; ?>">
                    <input placeholder="Correo" name="correo" type="text" value="<?php echo $correo; ?>">
                    <input placeholder="Calle" name="calle" type= "text" value="<?php echo $calle; ?>">
                    <input placeholder="Número" name="numero" type="text" value="<?php echo $numero; ?>">
                    <input placeholder="Fraccionamiento" name="fraccionamiento" type="text" value="<?php echo $colonia; ?>">
                    <input placeholder="CP" name="cp" type="text" value="<?php echo $cp; ?>">
                    <input placeholder="Municipio" name="municipio" type="text" value="<?php echo $municipio; ?>">
                    <input placeholder="Estado" name="estado" type="text" value="<?php echo $estado; ?>">
                    <input placeholder="Identificación" name="identificacion" type="text" value="<?php echo $identificacion; ?>">
                    <label for=""></label>
                    <label for=""></label>
                    <label for=""></label>
                    <label >Foto<img width="400px" align="center" src="<?php echo $foto; ?>" > </label> 
                    <label>Fotografia<input type="file" name="imagen"></label>
                    <label for=""></label>
                    <label for=""></label>                    

                    <input class="botonEnviar" type="submit" name="eliminar" value="Eliminar">
                    <input class="botonEnviar" name="actualizar" type="submit" value="Actualizar" >
                </form>
                <script type="text/javascript">
                          function confirmar() 
                            {
                                if(confirm("¿Confirma la operación?"))
                                {
                                  return true;
                                }
                                else
                                {
                                  return false;
                                }
                            }
                </script>
            </div> 
        </div>         
    </main>
    <footer class="footer">
        <p>Lunaterrecas A. C.</p>
    </footer>
</body>
</html> 