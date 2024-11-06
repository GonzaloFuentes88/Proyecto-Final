<?php
require_once 'Database.php';
require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../models/Empresa.php';
require_once __DIR__ . '/../models/Modalidad.php';
require_once __DIR__ . '/../models/Jornada.php';

class EmpresaDAO {
    private PDO $conn;

    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }
    public function listarJornadas() {
        $queryJornadas = "SELECT * FROM jornada";
        $stmt = $this->conn->prepare($queryJornadas);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $jornadas = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $jornadasArray = [];
            foreach($jornadas as $jornada){
                $id = $jornada['idJornada'];
                $descripcion = $jornada['DescripcionJornada'];
                $jornadaOBJ = new Jornada($id, $descripcion);
                $jornadasArray[] = $jornadaOBJ->toArray();
            }
            if($jornadasArray){
                return $jornadasArray;
            }
        }
        return null;
    }
    public function listarModalidades() {
        $queryModalidades = "SELECT * FROM modalidad";
        $stmt = $this->conn->prepare($queryModalidades);
        $stmt->execute();
        if ($stmt->rowCount() > 0) {
            $modalidades = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $modalidadesArray = [];
            foreach($modalidades as $modalidad){
                $id = $modalidad['idModalidad'];
                $descripcion = $modalidad['DescripcionModalidad'];
                $modalidadOBJ = new Modalidad($id, $descripcion);
                $modalidadesArray[] = $modalidadOBJ->toArray();
            }
            if($modalidadesArray){
                return $modalidadesArray;
            }
        }
        return null;
    }
    public function publicarEmpleo($titulo, $modalidad, $ubicacion, $jornada, $descripcion, $habilidad, $carrera, $plan_estudios, $materia) {
        $queryEmpleo = "
            INSERT INTO EMPLEO (Titulo, Modalidad, Ubicacion, Jornada, Descripcion, Habilidad, Carrera, Plan_Estudios, Materia)
            VALUES (:titulo, :modalidad, :ubicacion, :jornada, :descripcion, :habilidad, :carrera, :plan_estudios, :materia)
        ";
        $connPrepare = $this->conn->prepare($queryEmpleo);
        $connPrepare->bindParam(':titulo', $titulo);
        $connPrepare->bindValue(':modalidad', $modalidad);
        $connPrepare->bindValue(':ubicacion', $ubicacion);
        $connPrepare->bindValue(':jornada', $jornada);
        $connPrepare->bindValue(':descripcion', $descripcion);
        $connPrepare->bindValue(':habilidad', $habilidad);
        $connPrepare->bindValue(':carrera', $carrera);
        $connPrepare->bindValue(':plan_estudios', $plan_estudios);
        $connPrepare->bindValue(':materia', $materia);
    
        // Ejecutar la consulta
        return $connPrepare->execute();
    }
}