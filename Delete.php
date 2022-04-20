<?php 
    include 'php/conexion.php';
    $idRegistros = $_REQUEST['ids_array'];
    foreach ($idRegistros as $Registro)
    {
        $DeleteRegistro = ("DELETE FROM terrenos WHERE idTerreno = 2222");
        $db = conectar();
        $ejecutar = mysqli_query($db, $DeleteRegistro);
        var_dump($ejecutar);
    }
?>