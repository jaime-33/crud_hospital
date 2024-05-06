<?php
    require('Database.php');

    class medico{
        public static function create_medico($nombre, $especialidad, $telefono, $email){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('INSERT INTO medico(nombre, especialidad, telefono, email) VALUES(:nombre, :especialidad, :telefono, :email)');
            
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
        
            if ($stmt->execute()) {
                header('HTTP/1.1 201 Created');
                echo json_encode(array("message" => "Medico creado correctamente."));
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(array("message" => "Error al crear al medico."));
            }
        }
        
        public static function delete_medico($id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM medico WHERE id=:id');
            $stmt->bindParam(':id', $id);
            
            if ($stmt->execute()) {
                http_response_code(200);
                echo json_encode(array("message" => "medico eliminado exitosamente"));
            } else {
                http_response_code(500);
                echo json_encode(array("message" => "No se pudo eliminar al medico"));
            }
        }
        


        public static function get_all_medico(){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM medico');
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }
        public static function get_id_medico($id){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('SELECT * FROM medico WHERE id = :id');
            $stmt->bindParam(':id',$id);
            
        
            if ($stmt->execute()) {
                $result = $stmt->fetchAll();
                header('HTTP/1.1 202 ok');
                echo json_encode($result);
                return json_encode($result);
            } else {
                header('HTTP/1.1 401 fallo');
                echo "Error en el listado";
            }
        }


        public static function update_medico($id, $nombre, $especialidad, $telefono, $email){
            $database = new Database();
            $conn = $database->getConnection();
        
            $stmt = $conn->prepare('UPDATE medico SET nombre=:nombre, especialidad=:especialidad, telefono=:telefono, email=:email WHERE id=:id');
        
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':especialidad', $especialidad);
            $stmt->bindParam(':telefono', $telefono);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':id', $id);
        
            if ($stmt->execute()) {
                header('HTTP/1.1 201 el medico se actualizo correctamente');
                echo json_encode(array("message" => "medico actualizado correctamente."));
            } else {
                header('HTTP/1.1 401 el medico no se pudo actualizar');
                echo json_encode(array("message" => "Nose pudo actualizar al medico."));
            }
        }
        
        
    }


?>