<?php
require_once './dal/Database.php';
require_once './dal/AlumnoDAO.php';

// $database = new Database();
// $conn = $database->getConnection();

$AlumnoDAO = new AlumnoDAO();

// if ($conn) {
//     echo "Conexión exitosa a la base de datos";
// } else {
//     echo "Error al conectar a la base de datos";
// }

$resultado = $AlumnoDAO->iniciarSesion("usuario@example.com", "claveSegura123");

echo $resultado; 

?>