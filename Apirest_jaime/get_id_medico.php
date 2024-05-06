<?php
    require('includes/medico.php');

    if ($_SERVER['REQUEST_METHOD'] =='GET' && isset($_GET['id'])) {
          
         medico::get_id_medico($_GET['id']);
        
    }else{
        echo 'Nose envio el Id';
    }


?>