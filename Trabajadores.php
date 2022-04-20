<?php 
session_start();


if(isset($_SESSION) && $_SESSION['tipo'] == 'Administrador'){
    
}else{
    header('location:/cerrar.php');
}

?>  
<?php include 'php/conexion.php';?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">                
        <title>Document</title>        
    </head>
    <body>
   <?php include 'Menu.php'; ?>
    <main>
            <?php                     
                $action = filter_input(INPUT_GET, 'action');
                $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);  
               
            try 
            {  //Acciones sobre la base de datos
                
                if ($action == "delete" && !empty($id)) 
                {
                    $sentencia = "DELETE FROM empleados WHERE idEmpleado = '$id'";
                    $db =conectar();
                    $ejecutar = mysqli_query($db, $sentencia);                             
                }               
            }
            catch (Exception $ex) {
                echo "Ha ocurrido un error<br/>" . $ex->getMessage();
            }             
        ?>
            <div class="divtable">
                <table  class="table">
                    <thead>
                        <th colspan="18" >Datos del trabajador</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Id Empleado</td>
                            <td>Puesto</td>
                            <td>Nombre</td>
                            <td>Apellido paterno</td>
                            <td>Apellido materno</td>
                            <td>fecha de nacimiento</td>
                            <td>Teléfono</td>
                            <td>Celular</td>
                            <td>Correo</td>
                            <td>Fecha de ingreso</td>
                            <td>Calle</td>
                            <td>Número</td>
                            <td>Colonia</td>
                            <td>Código postal</td>
                            <td>Municipio</td>
                            <td>Estado</td>    
                            <td>Foto</td>     
                            <td>Acciones</td>                  
                        </tr>                             
                    </tbody>   
                    <?php 
                        $consulta = "SELECT * FROM empleados  ORDER BY idEmpleado ";
                        $db = conectar();                        
                        $ejecutar = mysqli_query($db, $consulta);  
                    ?>
                    <?php while ($proceso = mysqli_fetch_assoc($ejecutar)){ ?>                  
                    <tr>
                        <td> <?php echo "$proceso[idEmpleado]"; ?> </td> 
                        <td> <?php echo "$proceso[Puesto]"; ?> </td>
                        <td> <?php echo "$proceso[Nombre]"; ?> </td>
                        <td> <?php echo "$proceso[ApellidoPaterno]";?> </td>
                        <td> <?php echo "$proceso[ApellidoMaterno]";?> </td>   
                        <td> <?php echo "$proceso[FechaNacimiento]";?> </td>
                        <td> <?php echo "$proceso[Telefono]";?>  </td>
                        <td> <?php echo "$proceso[Celular]";?> </td>
                        <td> <?php echo "$proceso[Correo]";?> </td>
                        <td> <?php echo "$proceso[FechaIngreso]";?> </td>
                        <td> <?php echo "$proceso[Calle]";?> </td>
                        <td> <?php echo "$proceso[Numero]";?> </td>
                        <td> <?php echo "$proceso[Colonia]";?> </td>
                        <td> <?php echo "$proceso[CP]";?> 
                        <td> <?php echo "$proceso[Municipio]";?> 
                        <td> <?php echo "$proceso[Estado]";?>  </td> 
                        <td ><img width="100px" src="<?php echo "$proceso[Foto]"; ?>" ></td>                        
                        <td>
                            <a href="?action=delete&id=<?= $proceso['idEmpleado'] ?>" >Borrar</a>                            
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
           
        
    
