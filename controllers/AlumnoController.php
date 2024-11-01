<?php
require_once __DIR__ . '/../dal/AlumnoDAO.php';
require_once __DIR__ . '/../models/Alumno.php';
require_once __DIR__ . '/../models/Usuario.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
$alumnoController = new AlumnoController();

$endpoint = $_GET['endpoint'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $endpoint === "register") {
    $resultado = $usuarioController->register();
    return $resultado;
    exit;
}

class AlumnoController {
    private AlumnoDAO $alumnoDao;

    public function __construct() {
        $this->alumnoDao = new AlumnoDAO();
    }

    public function editarPerfilAlumno($id) {
        $email = $_POST['email'] ? $_POST['email'] : NULL;
        $password = $_POST['contraseña'] ? $_POST['contraseña'] : NULL;
        $nombreCompleto = $_POST['nombreCompleto'] ? $_POST['nombreCompleto'] : NULL ;
        $telefono = $_POST['telefono'] ? $_POST['telefono'] : NULL;
        $habilidades = /*$_POST['habilidad'] ? $_POST['habilidad'] : */ NULL;
        $carrera = /* $_POST['carrera'] ? $_POST['carrera'] : */ NULL;
        $planEstudios = /*$_POST['planEstudios'] ? $_POST['planEstudios'] : */NULL;
        $materias = /*$_POST['materia'] ? $_POST['materia'] : */NULL;
        $apellido = NULL;
        $direccion = NULL;

        $check = $this->alumnoDao->editarPerfilAlumno($id, $email, $password, $nombreCompleto, $apellido, $telefono, $direccion, $fotoPerfil, $deBaja, $habilidades, $planEstudios, $materias);

        if ($check) {
            return [
                'success' => true,
                'message' => 'Usuario Editado Correctamente',
            ];
        } else {
            return [
                'success' => false,
                'message' => 'Error',
            ];
        }

    }

    
}
?>


