<?php
header("Access-Control-Allow-Origin: *"); // Allow all origins
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS"); // Allowed methods
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Allowed headers
require_once __DIR__ . '/controllers/AlumnoController.php';

$alumnoController = new AlumnoController();
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Handle preflight requests
    http_response_code(204);
    exit;
}

$endpoint = $_GET['endpoint'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $endpoint === 'login') {
    $data = json_decode(file_get_contents('php://input'), true);
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $alumno = $alumnoController->iniciarSesion($email, $password);

    if ($alumno) {
        echo json_encode([
            'success' => true,
            'message' => 'Inicio de sesión exitoso',
            'alumno' => $alumno->__toString(),
        ]);
    } else {
        echo json_encode([
            'success' => false,
            'message' => 'Credenciales incorrectas',
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode(['message' => 'Método no permitido o endpoint no válido']);
}
?>