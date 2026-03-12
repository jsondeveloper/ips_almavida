<?php
require_once __DIR__ . "/../../config/database.php";

class Cita {

    private $conn;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar(){

        $sql = "SELECT 
        c.*,
        p.nombre_completo,
        e.nombre AS empresa

        FROM citas c

        INNER JOIN pacientes p
        ON c.paciente_id = p.id

        LEFT JOIN empresas e
        ON p.empresa_id = e.id

        ORDER BY c.fecha_cita DESC";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($data){

        $sql = "INSERT INTO citas 
        (paciente_id, tipo_examen, fecha_cita)
        VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $data['paciente'],
            $data['examen'],
            $data['fecha']
        ]);
    }

    public function obtener($id){

        $sql = "SELECT 
        c.*,
        p.nombre_completo,
        e.nombre AS empresa

        FROM citas c

        INNER JOIN pacientes p
        ON c.paciente_id = p.id

        LEFT JOIN empresas e
        ON p.empresa_id = e.id

        WHERE c.id = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($data){

        $sql = "UPDATE citas
        SET paciente_id = ?,
        tipo_examen = ?,
        fecha_cita = ?
        WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        $stmt->execute([
            $data['paciente'],
            $data['examen'],
            $data['fecha'],
            $data['id']
        ]);
    }

    public function eliminar($id){

        $sql = "DELETE FROM citas WHERE id=?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function obtenerHorasOcupadas($fecha, $tipo_examen){

        $sql = "SELECT DATE_FORMAT(fecha_cita,'%H:%i') as hora
        FROM citas
        WHERE DATE(fecha_cita) = ?
        AND tipo_examen = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha,$tipo_examen]);

        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

}