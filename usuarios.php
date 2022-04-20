<?php
    session_start();  
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){       
    }else{
        header('Location:cerrar.php');
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
    include 'Menu.php';
    include 'php/conexion.php';
    ?>      
    <main> 
       <div class="div">
            <div class="divformularioUSUARIOS">
                <h2>Registro de usuarios</h2>
                <form class="formulario" action="usuarios.php" >   
                    <input type="hidden" name="action" value="insert">                  
                    <label>Selecciona al empleado
                        <select name="selectEmpleado" >
                                <option value="0">Seleccione:</option>
                                <?php 
                                $consulta = "SELECT * FROM empleados";
                                $db = conectar();
                                $ejecutar = mysqli_query($db,$consulta);
                                while ($proceso = mysqli_fetch_assoc($ejecutar))
                                {
                                    
                                    echo"<option value = '$proceso[idEmpleado]'> $proceso[Nombre] $proceso[ApellidoPaterno] $proceso[ApellidoMaterno]</option>";
                                }

                                ?>
                        </select>      
                    </label>                                                 
                    <label >Usuario<input required pattern="^[A-Za-z]+" name="usuario" type="text" placeholder="Usuario"></label>                    
                    <label >Contraseña <input name="contraseña" pattern="^[A-Za-z0-9-@#_.,]+" type="password" placeholder="Contraseña"> </label>         
                    <input class="botonEnviar" type="submit"  value="Enviar">
                </form>
            </div>  
       </div>
       <?php
        $action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING); 
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);       
        $usuario = filter_input(INPUT_GET, 'usuario', FILTER_SANITIZE_STRING);
        $idEmpleado = filter_input(INPUT_GET, 'selectEmpleado', FILTER_VALIDATE_INT);
        $contraseña = filter_input(INPUT_GET, 'contraseña', FILTER_SANITIZE_STRING);
        $puesto = filter_input(INPUT_GET, 'puesto', FILTER_SANITIZE_STRING);

         try 
            {  //Acciones sobre la base de datos
                if ($action == 'insert' && !empty($usuario) && !empty($idEmpleado)) 
                {
                    $sentencia =  "SELECT * FROM usuarios WHERE  Usuario = '$usuario' AND contra = '$contraseña'";
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $sentencia);
                    $procesar = mysqli_fetch_assoc($ejecutar);    
                    
                    if(!isset($procesar))
                    {
                        $consulta = "SELECT * FROM empleados  WHERE idEmpleado = '$idEmpleado'";
                        $db = conectar();
                        $ejecutar = mysqli_query($db, $consulta);            
                        $ordenar = mysqli_fetch_assoc($ejecutar);
                        $idEmpleado = $ordenar['idEmpleado'];
                        $puesto = $ordenar['Puesto'];
                        $insertar = "INSERT INTO usuarios(id_Empleado, Usuario, contra, Puesto ) VALUES ('$idEmpleado', '$usuario', '$contraseña', '$puesto')";
                        $db = conectar();
                        $resultado = mysqli_query($db, $insertar);                        
                    }
                    else
                    {
                        echo"<script> alert('El usuario ya existe, ingresa un usuario distinto'); </script>";
                    }
                    
                                     
                }                
                if ($action == "delete" && !empty($id)) 
                {
                    $sentencia = "DELETE FROM usuarios WHERE idUsuarios = '$id'";
                    $db =conectar();
                    $ejecutar = mysqli_query($db, $sentencia);     
                        
                }
                if ($action == 'update' && !empty($id)) 
                {
                    $sentencia =  "SELECT * FROM usuarios WHERE  Usuario = '$usuario' AND contra = '$contraseña'";
                    $db = conectar();
                    $ejecutar = mysqli_query($db, $sentencia);
                    $procesar = mysqli_fetch_assoc($ejecutar);                    
                    if(!isset($procesar))
                    {
                        
                        $sentencia = "UPDATE usuarios SET Usuario='$usuario', contra='$contraseña', Puesto = '$puesto' WHERE idUsuarios='$id'";                   
                        $db = conectar();
                        $ejecutar = mysqli_query($db,$sentencia);                      
                    }
                    else
                    {
                        echo"<script> alert('El usuario ya existe, ingresa un usuario distinto'); </script>";
                    }
                                      
                }
                
            }
            catch (Exception $ex) {
                echo "Ha ocurrido un error<br/>" . $ex->getMessage();
            }             
        ?>   
            <?php
                $consulta = "SELECT * FROM usuarios  ORDER BY idUsuarios";
                $db = conectar();                        
                $ejecutar = mysqli_query($db, $consulta);
            ?>  
            <div class="divtable">
                <table  class="table">
                    <thead>
                        <th colspan="6" >Datos de los usuarios</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Id usuario</td>
                            <td>Id empleado</td>
                            <td>Usuario</td>
                            <td>Contraseña</td>
                            <td>Puesto</td>     
                            <td>Operaciones</td>                  
                        </tr>                             
                    </tbody>     
                    <?php while ($proceso = mysqli_fetch_assoc($ejecutar)){ ?>                  
                    <tr>
                        <td> <?php echo "$proceso[idUsuarios]"; ?> </td> 
                        <td> <?php echo "$proceso[id_Empleado]"; ?> </td>
                        <td> <?php echo "$proceso[Usuario]"; ?> </td>
                        <td> <?php echo "$proceso[contra]";?> </td>
                        <td> <?php echo "$proceso[Puesto]";?> </td>   
                        <td>
                            <a href="?action=delete&id=<?= $proceso['idUsuarios'] ?>" >Borrar</a>
                            <a href="updateusuarios.php?id=<?= $proceso['idUsuarios'] ?>" >Editar</a>
                        </td>                       
                    </tr>  
                    <?php } ?>                               
                </table>  
            </div>    

    </main>
    <footer class="footer">
        <p>
            Lunaterrecas A. C.
        </p>
    </footer>
</body>
</html>