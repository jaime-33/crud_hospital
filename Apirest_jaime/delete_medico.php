<?php 
require_once('includes/medico.php');

if($_SERVER['REQUEST_METHOD']== 'DELETE' && isset($_GET['id'])){
    medico::delete_medico($_GET['id']);
}
?>