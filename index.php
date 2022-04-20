<?php
session_start(); 
include 'php/conexion.php'; 
$usuario = '';
$contrasena = '';
$c_contrasena = '';
$u_suario = '';
$tipo = '';
$response_recaptcha = "";
$_SESSION['tipo'] = '';
$_SESSION['nombre'] = '';
if($_SERVER['REQUEST_METHOD'] === 'POST')
{
    $usuario =  $_POST['usuario'];
    $contrasena =  $_POST ['contra'];
    $consulta = "SELECT * FROM  usuarios WHERE Usuario = '$usuario' AND contra = '$contrasena' ";
    $db = conectar();
    $select = mysqli_query($db,$consulta);
    $proceso = mysqli_fetch_assoc($select);
    if($proceso)
    {
        $c_contrasena = $proceso['contra'];
        $u_suario = $proceso['Usuario'];
        
        $tipo = $proceso['Puesto'];
        
        if($usuario == $u_suario & $contrasena == $c_contrasena)
        {              
            $_SESSION['tipo'] = $tipo;
            $_SESSION['nombre'] = $u_suario;
            if($_SESSION['tipo'] == 'Administrador'){
                header('Location: ventasadmin.php');
            }
            if($_SESSION['tipo'] == 'Secretaria'){
                header('location: ventas.php');
            }
            if($_SESSION['tipo'] == 'Ventas'){
                header('location: Terrenos.php');
            }     
        }                    
    }
    else
    {
        echo"<script> alert('Usuario no encontrado');</script>";
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet">    
    <link rel="stylesheet" href="css/normalizer.css">    
    <script async src="https://www.google.com/recaptcha/api.js"></script>
</head> 
   
<body>
  
    <?php
    include 'MenuA.php';
    ?>   
        <div class="div">            
            <div class="divformulario">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-user" width="74" height="74" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                <circle cx="12" cy="7" r="4" />
                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
            </svg>
                <form class="formulario"  action="index.php" method="POST" >         
                    <input class="input" pattern="[A-Z]{0,1}[a-zíóúáñ ]{1,14}" required type="text" name="usuario" placeholder="Usuario" title="Ingresa un nombre de usuario valido"/>                    
                    <input class="input" required type="password" name="contra"  placeholder="Contraseña" title="No se admiten comillas" />                                    
                    <input class="botonEnviar" type="submit" name="enviar" id="enviar" value="Iniciar" />  
                    <div data-theme=”dark” class="g-recaptcha" data-sitekey="6Lc_AgocAAAAACmEcntaznGRH_Bxi6ggsW00A97a"></div>           
                </form >  
            </div>   
                        
        </div>
            
      <footer class="findex">
        <p>Lunaterrecas A. C.</p>
      </footer>
</body>
</html>
