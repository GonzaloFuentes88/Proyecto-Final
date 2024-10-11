<?php
require_once __DIR__ . '/../dal/UsuarioDAO.php';
require_once __DIR__ . '/../models/Usuario.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}

$endpoint = $_GET['endpoint'] ?? '';

$usuarioController = new UsuarioController();

switch ($endpoint) {
    case "login":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuarioController->iniciarSesion();
        } else {
            http_response_code(405);
            echo json_encode(['message' => 'Método no permitido']);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['message' => 'Endpoint no encontrado']);
        break;
}

class UsuarioController {
    private UsuarioDAO $usuarioDao;

    public function __construct() {
        $this->usuarioDao = new UsuarioDAO();
    }

    public function iniciarSesion() {
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';

        $usuario = $this->usuarioDao->iniciarSesion($email, $password);

        if ($usuario) {
            echo json_encode([
                'success' => true,
                'message' => 'Inicio de sesión exitoso',
                'usuario' => $usuario,
            ]);
        } else {
            http_response_code(401);
            echo json_encode([
                'success' => false,
                'message' => 'Credenciales incorrectas',
            ]);
        }
    }

}
