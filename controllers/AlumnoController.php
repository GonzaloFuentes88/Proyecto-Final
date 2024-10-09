<?php
require_once __DIR__ . '/../dal/AlumnoDAO.php'; // Asegúrate de que la ruta sea correcta
require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Usuario.php';

class AlumnoController {
    private AlumnoDAO $alumnoDao;

    public function __construct() {
        // Corrige el nombre de la clase aquí
        $this->alumnoDao = new AlumnoDAO(); // Corrige AlumndoDAO a AlumnoDAO
    }

    public function iniciarSesion(string $email, string $password): ?Alumno {
        return $this->alumnoDao->iniciarSesion($email, $password);
    }
}
?>