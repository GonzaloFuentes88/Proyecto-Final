<?php
require_once __DIR__ . '/../dal/UsuarioDAO.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../dal/EmpresaDAO.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(204);
    exit;
}
$empresaController = new EmpresaController();


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['modalidades'])) {
    $resultado = $empresaController->listarModalidades();
    return $resultado;
    exit;

}elseif($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['jornadas'])) {
    $resultado = $empresaController->listarJornadas();
    return $resultado;
    exit;
}
class EmpresaController {
    private EmpresaDAO $empresaDAO;
    public function __construct() {
        $this->empresaDAO = new EmpresaDAO();
    }
    public function listarJornadas(){
        $jornadas = $this->empresaDAO->listarJornadas();
        if($jornadas){
            http_response_code(200);
            echo json_encode([
                "success" => true,
                "body" => $jornadas
            ]);
            return;
        }
        else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error: No se encontraron jornadas',
            ]);
        }
    }
    public function listarModalidades(){
        $modalidades = $this->empresaDAO->listarModalidades();
        if($modalidades){
            http_response_code(200);
            echo json_encode([
                "success" => true,
                "body" => $modalidades
            ]);
            return;
        }
        else {
            http_response_code(500);
            echo json_encode([
                'success' => false,
                'message' => 'Error: No se encontraron modalidades',
            ]);
        }
    }
}
