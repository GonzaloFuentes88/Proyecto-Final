<?php
require_once __DIR__ . '/../dal/AdministradorDAO.php';
require_once __DIR__ . '/../models/Usuario.php';


header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

$endpoint = $_GET['endpoint'] ?? '';

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $endpoint === "darDeBaja") {
    $userId = $data['userId'];
    $result = $administradorController->darDeBaja($userId);
    echo json_encode(['success' => $result]);
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $endpoint === "habilitar") {
    $userId = $data['userId'];
    $result = $administradorController->habilitar($userId);
    echo json_encode(['success' => $result]);
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $endpoint === "cambiarContraseña") {
    $userId = $data['userId'];
    $newPassword = $data['newPassword'];
    $result = $administradorController->cambiarClave($userId, $newPassword);
    echo json_encode(['success' => $result]);
    exit;
}


$administradorController = new AdministradorController();
$endpoint = $_GET['endpoint'] ?? '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $endpoint === "register") {
    $resultado = $administradorController->register();
    return $resultado;
    exit;
}
$administradorController = new AdministradorController();



class AdministradorController 
{
    private AdministradorDAO $administradorDAO;

    public function __construct() {
        $this->administradorDAO = new AdministradorDAO();
    }


    public function crearEvento(){
        $titulo = $_POST['titulo'] ? $_POST['titulo'] : NULL;
        $fecha = $_POST['fecha'] ? $_POST['fecha'] : NULL ;
        $hora = $_POST['hora'] ? $_POST['hora'] : NULL;
        $tipo = $_POST['tipo'] ? $_POST['tipo'] : NULL;
        $descripcion = $_POST['descripcion'] ? $_POST['descripcion'] : NULL;
        

        $evento = $this->administradorDAO->crearEvento($_SESSION['user']['user_id'], $titulo, $tipo ,$fecha, $hora, $descripcion);
        if($evento){
            $response = [
                "success" => true,
                "body" => $evento
            ];
            return $response;
        }
        else {
            
            $response = [
                'success' => false,
                'message' => 'Error: No se encontraron solicitudes',
            ];
            return $response;
        }
    }
    
    // Método para obtener todos los usuarios
    public function listarUsuarios() {
        $usuarios = $this->administradorDAO->getUsuarios();
        if ($usuarios !== false) {
            return $usuarios; // Devolver el arreglo de usuarios
        } else {
            return []; // Devolver un arreglo vacío si falla la consulta
        }
    }
    public function cambiarClave($userId, $newPassword) {
        return $this->administradorDAO->updatePassword($userId, $newPassword);
    }
    public function darDeBaja($userId) {
        return $this->administradorDAO->setUserStatus($userId, 'S'); // 'S' para inactivo
    }
    public function habilitar($userId) {
        return $this->administradorDAO->setUserStatushab($userId, 'N'); // 'N' para activo
    }
    public function getEventos() {
        return $this->administradorDAO->getEventos();
    }
    public function getEventosDeAdmin() {
        return $this->administradorDAO->getEventos($_SESSION['user']['user_id']);
    }

    public function register() {
        
        $input = json_decode(file_get_contents('php://input'), true);
        $typeUser = htmlspecialchars($input['typeUser'] ?? '');
        $email = htmlspecialchars($input['email'] ?? '');
        $password = htmlspecialchars($input['password'] ?? '');
        $nombreUsuario = htmlspecialchars($input['nombreUsuario'] ?? '');

        if (empty($email) || empty($password)  || empty($nombreUsuario)) {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Faltan datos obligatorios.'
            ]);
            return;
        }
    

        if ($typeUser == 2) {
            $nombre = htmlspecialchars($input['nombre'] ?? '');
            $apellido = htmlspecialchars($input['apellido'] ?? '');
    
            if (empty($nombre) || empty($apellido)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Faltan datos obligatorios para el alumno.'
                ]);
                return;
            }

            $respose = $this->administradorDAO->registerAlumno($nombreUsuario, $password, $email, $nombre, $apellido);
    
        } else if ($typeUser == 3) {
            $RazonSocial = htmlspecialchars($input['RazonSocial'] ?? '');
            

            if (empty($RazonSocial)) {
                http_response_code(400);
                echo json_encode([
                    'success' => false,
                    'message' => 'Faltan datos obligatorios para la empresa.'
                ]);
                return;
            }
    
            $respose = $this->administradorDAO->registerEmpresa($nombreUsuario, $password, $email, $RazonSocial);
        } else {
            http_response_code(400);
            echo json_encode([
                'success' => false,
                'message' => 'Tipo de usuario no válido.'
            ]);
            return;
        }
        if ($respose['success']) {
            echo json_encode($respose);
            return;
        } else {
            http_response_code(500);
            echo json_encode($respose);
            return;
        }
        
    }


} 



?>