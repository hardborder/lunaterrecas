<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
<?php
include  'Menu.php';
include 'php/conexion.php';
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
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
  {                        
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
    $foto = '';
    
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
      // se valida que la imagen tenga el formato señalado y el tamaño.
      $extensiones = array(0=>'image/jpg',1=>'image/jpeg',2=>'image/png');
      $max_tamanyo = 1024 * 1024 * 8;   
      // se recibe la imagen y se solicita a FILES el nombre del archivo, agregandolo a la variable $nom_archivo
      $nom_archivo = $_FILES['imagen']['name'];
      $ruta = "img/".$nom_archivo;
      $archivo = $_FILES['imagen']['tmp_name'];
      $subir = move_uploaded_file($archivo, $ruta);

      if($_POST)
      {
        $consulta = "SELECT * FROM empleados WHERE (Nombre = '$nombre') AND (ApellidoPaterno = '$apellidoPaterno') AND (ApellidoMaterno = '$apellidoMaterno')";
        $db = conectar();
        $ejecutar = mysqli_query($db, $consulta);
        $proceso = mysqli_fetch_assoc($ejecutar);                                 
            if(!isset($proceso))
            {    
                if ( in_array($_FILES['imagen']['type'], $extensiones) ) 
                {
                    if ( $_FILES['imagen']['size']< $max_tamanyo ) 
                    {
                      $insertar ="INSERT INTO empleados (Puesto, Nombre, ApellidoPaterno, ApellidoMaterno, FechaNacimiento, Telefono, Celular, Correo, FechaIngreso, Calle, Numero, Colonia, CP, Municipio, Estado, Foto) VALUES ('$puesto','$nombre','$apellidoPaterno','$apellidoMaterno','$fechaNacimiento','$telefono','$celular','$correo','$fechaIngreso','$calle','$numero','$colonia','$cp','$municipio','$estado', '$ruta')";
                      $db=conectar();
                      $ejecutar = mysqli_query($db,$insertar);                                                  
                      if ($ejecutar)
                      {
                          echo"<script> alert('Datos del trabajador enviados'); </script>";
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
      else
      {
        echo"<script>('Ingresa un trabajador para regitrar');</script>";
      }               
  }   
?>  
      <main>                 
          <div class="div">                   
                  <div class="divformularioTRABAJADORES">
                      <h2>Registro de trabajadores</h2>
                        <form class="formulario" action="agregarTrabajador.php" method="POST" enctype="multipart/form-data" onsubmit="return confirmar()" >                                                                         
                            <label >Secretaria<input required name="puesto"  type="radio"  value="Secretaria"></label>                          
                            <label >Vendedor<input  name="puesto"  type="radio"  value="Vendedor"> </label>                   
                            <label >Administrador<input name="puesto" type="radio" value="Administrador"> </label>                                
                            <label >Nombre<input autofocus required name="nombre" minlength="1" maxlength="15" pattern="^[A-Z]{1}[a-záéíóú]+[\s]*$" type="text" placeholder="Ej: Juan" title="Ingresa el nombre empezando por una letra mayúscula" ></label>                          
                            <label >Apellido paterno<input required name="apellidoPaterno" minlength="2" maxlength="15" pattern="^[A-Z]{1}[a-záéíóú]+[\s]*$" type="text" placeholder="Ej: Lara" title="Ingresa el apellido paterno empezando por una letra mayúscula, no se admiten números"></label>  
                            <label >Apellido materno<input required name="apellidoMaterno" minlength="2" maxlength="15" pattern="^[A-Z]{1}[a-záéíóú]+[\s]*$" type="text" placeholder="Ej: Briceño" title="Ingresa el apellido materno empezando por una letra mayúscula"> </label>                                    
                            <label >Fecha de nacimiento<input required name="fechaNacimiento" id="fechanacimiento" min = "1950-01-01" max="2021-01-01" placeholder="Año/Mes/Día" type="text"></label>   
                            <label >Telefono de casa<input required name="telefono" id="tel" pattern="^[0-9-\(\)\s]+" minlength="7" maxlength="13"  type="text" placeholder="Ej: 92 2 40 50" title="Ingresa un numero de casa de 7 dígitos" ></label>                                      
                            <label >Celular<input required name="celular" id="cel" pattern="[0-9-\(\)\s]+" minlength="10" maxlength="10" type="text" placeholder="Ej. 492 129 67 94" title="Ingresa un número celular de 10 dígitos"></label>                          
                            <label >Correo<input required name="correo" id="email" maxlength="25" pattern="^[A-Za-z0-9._%+-]+@(gmail|hotmail)+\.[a-z]{2,}$" type="email" placeholder="Ej:Gmail o Hotmail" title="Registra una cuenta de correo de gmail o hotmail"></label>                    
                            <label >Fecha de ingreso<input name="fechaIngreso" type="date" readonly value="<?php echo date("Y-m-d");?>" ></label>                           
                            <label >Calle<input required name="calle" pattern="^[A-Za-z0-9\sáéíóú-]+$" maxlength="20" type="text" placeholder="Ej:Río Juchipila" title="No se admiten caracteres especiales"></label>                   
                            <label >Número<input required name="numero" pattern="^[0-9]+[A-Za-z]?$" maxlength="5" type="text" placeholder="Ej:209B"></label> 
                            <label >Colonia<input required name="colonia" pattern="^[A-Za-z0-9\sáéíóú-]+$" maxlength="20" type="text" placeholder="Ej:La Pinta"></label>                           
                            <label >Código postal<input required name="cp" type="text" pattern="^[0-9]{2,}$" maxlength="5" placeholder="Ej:98600"></label> 
                            <label >Municipio<input required name="municipio" pattern="^[A-Z]{1}[a-z]+$" maxlength="25" type="text" placeholder="Ej:Zacatecas"></label>                             
                            <label >Estado<input required name="estado" pattern="^[A-Z]{1}[a-z]+$" maxlength="25" type="text" placeholder="Ej:Zacatecas"></label>                                                     
                            <label>Fotografia<input type="file" name="imagen"></label>                            
                            <input class="botonEnviar" type="submit" value="Enviar" ;">           
                        </form>
                        <script type="text/javascript">
                          function confirmar() 
                            {
                                if(confirm("¿Guardar los datos?"))
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