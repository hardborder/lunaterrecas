<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
    }else{
        header('Location:cerrar.php');
    }
  ?>
<?php include 'php/conexion.php'; 

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
<?php include 'menuSecretaria.php'; 
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {        
        $fecha = '';
        $monto =  '';
        $concepto = '';
        $tipoconcepto = '';
        $firmadirectora = '';        
        $fecha =  $_POST['fecha'];
        $monto = $_POST['monto'];
        $concepto = $_POST['concepto'];
        $tipoconcepto = $_POST['tipoconcepto'];
        $firmadirectora = $_POST['firmadirectora'];

        $insert = "INSERT INTO caja_chica(Fecha, Monto, Concepto, Tipo_concepto,  FirmaDirectora) VALUES ('$fecha',  '$monto', '$concepto', '$tipoconcepto',  '$firmadirectora')";
        $db= conectar();
        $ejecutar = mysqli_query($db, $insert);        
        if ($ejecutar)
        {
            echo"<script> alert ('Pago extra almacenado'); </script>";            
        }
    }
?>
    <main>
        <div class="div">
            <div class="divformulario">
            <h2>Registro de pagos extras</h2>  
                <form class="formulario" action="agregarpagoextra.php" method="POST">
                    <label for=""></label>         
                    <label for=""></label>
                    <input name="fecha" type="text" placeholder="Fecha" value="<?php echo date('Y-m-d')?>" readonly>        
                    <input name="monto" type="text"  placeholder="Monto">
                    <label for=""></label>
                    <label for=""></label>                    
                    <label for=""></label>
                    <input name="concepto" type="text" name="" id="" placeholder="Concepto">                   
                    <input name="tipoconcepto" type="text" placeholder="Tipo de concepto">     
                    <label for=""></label>
                    <label for=""></label>
                    <label for=""></label>                    
                    <input name="firmadirectora" type="text" placeholder="Firma de directora"> 
                    <label for=""></label>
                    <label for=""></label>
                    <label for=""></label>            
                    <input class="botonEnviar" type="submit" value="Enviar">
                </form>
            </div>
        </div>
        <div class="divframe">
            <iframe src="pagosextras.php" frameborder="0" width="800px" height="1000px" ></iframe>
        </div>
    </main>
</body>
</html>