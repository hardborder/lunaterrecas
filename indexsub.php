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

    	
    <script src="js/validar.js"></script>	
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital@1&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css/normalizer.css">
    <link  href="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fotorama/4.6.4/fotorama.js"></script>   
</head>
<?php include 'Menu.php'; ?>
<body>   
    <main>       
        <p>
            Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum, explicabo totam accusantium odio placeat expedita error officia libero alias perspiciatis sit nam, eius ab enim. Consectetur ipsum molestiae quo quisquam?
        </p>            
    </main>
</body>
<footer class="footer" >
        <p>
          Lunaterrecas A.C
        </p>
</footer>
</html>