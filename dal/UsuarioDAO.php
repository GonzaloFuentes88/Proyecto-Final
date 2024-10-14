<?php
require_once 'Database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Alumno.php';

class UsuarioDAO {

    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function iniciarSesion($email, $password) {
        $queryUser = "
            SELECT u.idUsuario as user_id, 
                   CASE 
                       WHEN a.idAlumno IS NOT NULL THEN 'Alumno'
                       WHEN e.idEmpresa IS NOT NULL THEN 'Empresa'
                       WHEN ad.idAdministradorUniversidad IS NOT NULL THEN 'Administrador'
                       ELSE NULL
                   END as user_type
            FROM usuario u
            LEFT JOIN alumno a ON u.idUsuario = a.FK_idUsuario
            LEFT JOIN empresa e ON u.idUsuario = e.FK_idUsuario
            LEFT JOIN administradoruniversidad ad ON u.idUsuario = ad.FK_idUsuario
            WHERE u.Mail = :email AND u.Clave = :password
            LIMIT 1;
        ";

        $stmtUser = $this->conn->prepare($queryUser);
        $stmtUser->bindParam(':email', $email);
        $stmtUser->bindParam(':password', $password);
        $stmtUser->execute();

        $result = $stmtUser->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return $result;
        } 
        return null;
    }

}

?>