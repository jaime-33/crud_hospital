<?php
require('includes/medico.php');


parse_str(file_get_contents("php://input"), $_PUT);

if ($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_PUT['nombre']) && isset($_PUT['especialidad']) && isset($_PUT['telefono']) && isset($_PUT['email']) && isset($_PUT['id'] )) {
    medico::update_medico($_PUT['id'], $_PUT['nombre'], $_PUT['especialidad'], $_PUT['telefono'], $_PUT['email']);
} else {
    echo 'No se han proporcionado todos los datos necesarios para la actualización';
}

?>
