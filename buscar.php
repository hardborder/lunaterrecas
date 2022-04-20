<?php include 'php/conexion.php';
      session_start();
if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
    
}else{
    header('location:/cerrar.php');
}

      
$buscar = '';
$idEmpleado = '';
$puesto='';  
$nombre = '';
$apellidoPaterno = '';
$apellidoMaterno = '';
$fechaNacimiento = '';
$telefono = '';
$celular = '';
$correo = '';
$fechaIngreso = '';
$calle = '';
$numero = '';
$colonia = '';
$cp = '';
$municipio = '';
$estado = '';
$busqueda = '';

?>
                
<?php             
        if($_SERVER['REQUEST_METHOD'] === 'POST')
        { 
                           
            if(isset ($_POST['busqueda']))
            {
                $nom= $_POST['nombrE'];
                $apellidoPaternO = $_POST['apellidoP'];
                $apellidoMaternO = $_POST['apellidoM'];
                
                $consulta = "SELECT * FROM empleados WHERE (Nombre = '$nom') AND (ApellidoPaterno = '$apellidoPaternO') AND (ApellidoMaterno = '$apellidoMaternO')";
                $db= conectar();
                $ejecutar = mysqli_query($db, $consulta);
                $proceso =  mysqli_fetch_assoc($ejecutar);
                if($proceso)
                {
                    $idEmpleado = $proceso['idEmpleado'];
                    $puesto = $proceso['Puesto'];
                    $nombre = $proceso['Nombre'];
                    $apellidoPaterno = $proceso['ApellidoPaterno'];
                    $apellidoMaterno = $proceso['ApellidoMaterno'];
                    $fechaNacimiento = $proceso['FechaNacimiento'];
                    $telefono = $proceso['Telefono'];
                    $celular = $proceso['Celular'];
                    $correo = $proceso['Correo'];
                    $fechaIngreso = $proceso['FechaIngreso'];
                    $calle = $proceso['Calle'];
                    $numero = $proceso['Numero'];
                    $colonia = $proceso['Colonia'];
                    $cp = $proceso['CP'];
                    $municipio = $proceso['Municipio'];
                    $estado = $proceso['Estado'];   
                    $foto = $proceso['Foto'];                    
                }
                else
                {
                    echo "<script>
                            alert('Nombre no encontrado');
                        </script>";
                }          
            }              
            if(isset ($_POST['actualizar']))
            {   
                $idEmpleado = $_POST['id'];
                $puesto = $_POST ['puesto']; 
                $nombre = $_POST['nombre'];        
                $apellidoPaterno = $_POST ['apellidoPaterno'];
                $apellidoMaterno = $_POST ['apellidoMaterno'];
                $fechaNacimiento = $_POST ['fechaNacimiento'];
                $telefono = $_POST ['telefono'];
                $celular = $_POST ['celular'];
                $correo = $_POST ['correo'];
                $fechaIngreso = $_POST ['fechaIngreso'];
                $calle = $_POST ['calle'];
                $numero = $_POST ['numero'];
                $colonia = $_POST ['colonia'];
                $cp = $_POST ['cp'];
                $municipio = $_POST ['municipio'];
                $estado = $_POST ['estado'];
                  
                
                    $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
                    $max_tamanyo = 1024 * 1024 * 8;   
                    $nom_archivo = $_FILES['imagen']['name'];
                    $ruta = "img/".$nom_archivo;
                    $archivo = $_FILES['imagen']['tmp_name'];
                    $subir = move_uploaded_file($archivo, $ruta);
                
                
                        
                if(isset($idEmpleado))
                {         
                    $actualizar = " UPDATE  empleados SET Puesto = '$puesto', Nombre = '$nombre', ApellidoPaterno = '$apellidoPaterno', ApellidoMaterno = '$apellidoMaterno', FechaNacimiento = '$fechaNacimiento', Telefono = '$telefono', Celular ='$celular', Correo='$correo', FechaIngreso='$fechaIngreso', Calle='$calle', Numero='$numero', Colonia='$colonia', CP='$cp', Municipio='$municipio', Estado='$estado', Foto='$ruta' WHERE idEmpleado = '$idEmpleado'";
                    $db=conectar();
                    $consulta=mysqli_query($db, $actualizar);
                    if($consulta)
                    {
                        echo"<script> alert ('Datos actualizados');
                        </script>";                              
                    }                   
                    
                }
               else
               {
                   echo"<script>alert('Ingresa un empleado para actualizar sus datos');</script>";
               }
            }
            if(isset ($_POST['eliminar']))
            {    
                    $idEmpleado = $_POST['id'];                               
                    if($_POST)
                    {
                        $consulta = "DELETE FROM empleados WHERE idEmpleado = '$idEmpleado'";
                        $db = conectar();
                        $ejecutar = mysqli_query($db, $consulta);                                                                
                        if($ejecutar)
                        {
                            echo"<script> alert ('Empleado eliminado');
                            </script>";
                            
                        }  
                    }            
                    else
                    {
                        echo"<script> alert ('Ingresa un empleado para eliminar');
                            </script>";
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
<?php include 'Menu.php';?>      
    <main>            
        <div class="div">
            <div class="divformulario">
                <h2>Formulario para buscar, eliminar o actualizar un empleado </h2>
                <form class="formulario"  action="buscar.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmar()">                   
                    <input name="nombrE"   autofocus   placeholder="Ejemplo:Juan" >
                    <input name="apellidoP" type="text" placeholder="Apellido paterno">
                    <input name="apellidoM" type="text" placeholder="Apellido materno">
                    <input class="botonEnviar" type="submit" name="busqueda" value="Buscar">                   
                    <label for="idempleado" >Id de empleado<input name="id" value="<?php echo $idEmpleado;?>" type="text" ></label>
                    <label for="puesto">Puesto<input name="puesto" maxlength="15" value="<?php echo $puesto;?>" type="text"></label>    
                    <label for="nombre">Nombre<input name="nombre" maxlength="15" value="<?php echo $nombre;?>" type="text"></label>
                    <label for="apellidoPaterno">Apellido paterno<input name="apellidoPaterno" maxlength="15" value="<?php echo $apellidoPaterno;?>" type="text"></label>       
                    <label for="apellidoMaterno">Apellido materno<input name="apellidoMaterno" maxlength="15" value="<?php echo $apellidoMaterno;?>" type="text"></label>
                    <label for="FechaNacimiento">Fecha de nacimiento<input name="fechaNacimiento" value="<?php echo $fechaNacimiento;?>" type="date"></label>        
                    <label for="telefono">Telefono<input name="telefono" maxlength="7" value="<?php echo $telefono;?>" type="text"></label>
                    <label for="celular">Celular<input name="celular" maxlength="10" value="<?php echo $celular;?>" type="text"></label>             
                    <label for="correo">Correo<input name="correo" value="<?php echo $correo;?>" type="email"></label>
                    <label for="fechaIngreso">Fecha de ingreso<input name="fechaIngreso" value="<?php echo $fechaIngreso;?>" type="date"></label>       
                    <label for="calle">Calle<input name="calle" maxlength="25" value="<?php echo $calle;?>" type="text"></label>
                    <label for="numero">Número <input name="numero" maxlength="5" value="<?php echo $numero;?>" type="text"></label>       
                    <label for="colonia">Colonia<input name="colonia" maxlength="25"value="<?php echo $colonia;?>" type="text"></label>
                    <label for="cp">Código postal<input name="cp" maxlength="5" value="<?php echo $cp;?>" type="text"></label>        
                    <label for="municipio">Municipio<input name="municipio" maxlength="20" value="<?php echo $municipio;?>" type="text"></label>
                    <label for="estado">Estado<input name="estado" maxlength="15" value="<?php echo $estado;?>" type="text"></label>
                    <label for=""></label>                              
                    <label>Foto<img width="400px" align="center" src="<?php echo $foto;?>"></label>
                    <label>Fotografia<input type="file" name="imagen"></label>
                    <label for=""></label>
                    <label for=""></label>     
                    <input type="submit" class="botonEnviar" name="eliminar"  value="Eliminar" >                    
                    <input type="submit" class="botonEnviar" name="actualizar" value="Actualizar">
                </form>
                <script type="text/javascript">
                          function confirmar() 
                            {
                                if(confirm("¿Confirmar la operación?"))
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
        <p>
          Lunaterrecas A.C
        </p>
    </footer>
</body>
</html>