<?php
require_once 'Database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Alumno.php';

class AlumnoDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function iniciarSesion(string $email, string $password): ?Alumno {
        $queryUser = "SELECT * FROM usuario WHERE Mail = :email AND Clave = :password LIMIT 1";
    
        $stmtUser = $this->conn->prepare($queryUser);
        $stmtUser->bindParam(':email', $email);
        $stmtUser->bindParam(':password', $password);
        $stmtUser->execute();
    
        if ($stmtUser->rowCount() > 0) {
            $rowUser = $stmtUser->fetch(PDO::FETCH_ASSOC);

            $idUsuario = $rowUser['idUsuario'];
    
            $queryAlumno = "SELECT * FROM alumno WHERE FK_idUsuario = :idUsuario LIMIT 1";
            $stmtAlumno = $this->conn->prepare($queryAlumno);
            $stmtAlumno->bindParam(':idUsuario', $idUsuario);
            $stmtAlumno->execute();
    
            if ($stmtAlumno->rowCount() > 0) {
                $rowAlumno = $stmtAlumno->fetch(PDO::FETCH_ASSOC);
                // echo json_encode($rowAlumno);
                $alumno = new Alumno();
                $alumno->setNombre($rowAlumno['NombreAlumno']);
                $alumno->setApellidoAlumno($rowAlumno['ApellidoAlumno']);
                
                return $alumno;
            }
        }
    
        return null;
    }

    public function editarPerfilAlumno($id, $email, $password, $nombreCompleto, $apellido, $telefono, $direccion, $fotoPerfil, $deBaja, $habilidades, $planEstudios, $materias): ?Alumno {
        // Actualizar información del usuario
        $updateUserQuery = "UPDATE usuario SET ";
        $updateUserFields = [];
        $paramsUser = [];
    
        if ($email !== null) {
            $updateUserFields[] = "Mail = :email";
            $paramsUser[':email'] = $email;
        }
        if ($password !== null) {
            $updateUserFields[] = "Clave = :password";
            $paramsUser[':password'] = $password;
        }
        if ($telefono !== null) {
            $updateUserFields[] = "Telefono = :telefono";
            $paramsUser[':telefono'] = $telefono;
        }
        if ($direccion !== null) {
            $updateUserFields[] = "Direccion = :direccion";
            $paramsUser[':direccion'] = $direccion;
        }
        if ($fotoPerfil !== null) {
            $updateUserFields[] = "fotoPerfil = :fotoPerfil";
            $paramsUser[':fotoPerfil'] = $fotoPerfil;
        }
        if ($deBaja !== null) {
            $updateUserFields[] = "deBaja = :deBaja";
            $paramsUser[':deBaja'] = $deBaja;
        }
    
        if (count($updateUserFields) > 0) {
            $updateUserQuery .= implode(", ", $updateUserFields) . " WHERE idUsuario = :idUsuario";
            $paramsUser[':idUsuario'] = $id;
    
            $stmtUserUpdate = $this->conn->prepare($updateUserQuery);
            foreach ($paramsUser as $key => $value) {
                $stmtUserUpdate->bindValue($key, $value);
            }
    
            $stmtUserUpdate->execute();
        }
    
        $updateAlumnoQuery = "UPDATE alumno SET ";
        $updateAlumnoFields = [];
        $paramsAlumno = [];
    
        if ($nombreCompleto !== null) {
            $updateAlumnoFields[] = "NombreAlumno = :nombreCompleto";
            $paramsAlumno[':nombreCompleto'] = $nombreCompleto;
        }
        if ($apellido !== null) {
            $updateAlumnoFields[] = "ApellidoAlumno = :apellido";
            $paramsAlumno[':apellido'] = $apellido;
        }
        
        // if ($dni !== null) {
        //     $updateAlumnoFields[] = "DNI_Alumno = :dni";
        //     $paramsAlumno[':dni'] = $dni;
        // }
        
        if (count($updateAlumnoFields) > 0) {
            $updateAlumnoQuery .= implode(", ", $updateAlumnoFields) . " WHERE FK_idUsuario = :idUsuario";
            $paramsAlumno[':idUsuario'] = $id;
    
            $stmtAlumnoUpdate = $this->conn->prepare($updateAlumnoQuery);
            foreach ($paramsAlumno as $key => $value) {
                $stmtAlumnoUpdate->bindValue($key, $value);
            }
    
            $stmtAlumnoUpdate->execute();
        }
    
        return $this->obtenerAlumnoPorId($id); 
    }
    
    
    private function obtenerAlumnoPorId($id): ?Alumno {
        // Implementación de consulta para obtener el Alumno por su ID (FK_idUsuario)
        $query = "SELECT * FROM alumno WHERE FK_idUsuario = :idUsuario LIMIT 1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':idUsuario', $id);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $rowAlumno = $stmt->fetch(PDO::FETCH_ASSOC);
            $alumno = new Alumno();
            $alumno->setNombre($rowAlumno['NombreAlumno']);
            $alumno->setApellidoAlumno($rowAlumno['ApellidoAlumno']);
            // Añadir más propiedades según sea necesario
            return $alumno;
        }
    
        return null;
    }
    
    
}

?>