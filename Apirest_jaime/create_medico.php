<?php
    
    require('includes/medico.php');
    //header('Access-Control-Allow-Origin: *');

    if ($_SERVER['REQUEST_METHOD'] =='POST'
     && isset($_POST['nombre']) && isset($_POST['especialidad']) && isset($_POST['telefono']) && isset($_POST['email'])) {

        medico::create_medico($_POST['nombre'], $_POST['especialidad'], $_POST['telefono'], $_POST['email']);
        
    } else {
        echo 'No se encontraron todos los datos necesarios';
    }
?>
