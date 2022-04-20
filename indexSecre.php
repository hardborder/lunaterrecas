<?php
    session_start();  
    
 
    if(isset($_SESSION) && $_SESSION['tipo'] == 'Secretaria'){
       
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
             include 'menuSecretaria.php';
        ?>
        <main>
            <p>Obten bonos por tu buen desempeño </p>

        </main>    
        <footer>
            <p>
            Lunaterrecas A.C
            </p>
        </footer>
    </body>    
</html>