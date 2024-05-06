<?php
require_once('includes/medico.php');

 if($_SERVER['REQUEST_METHOD'] == 'GET'){
    medico::get_all_medico();
 }

?>