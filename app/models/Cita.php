<?php
require_once __DIR__ . "/../../config/database.php";

class Cita {

    private $conn;

    public function __construct(){
        $db = new Database();
        $this->conn = $db->conectar();
    }

    public function listar($fecha='', $paciente='', $examen=''){
    $sql = "SELECT citas.*, pacientes.nombre_completo
            FROM citas
            INNER JOIN pacientes ON citas.paciente_id = pacientes.id
            WHERE 1";

    $params = [];
    if($fecha){
        $sql .= " AND DATE(fecha_cita) = ?";
        $params[] = $fecha;
    }
    if($paciente){
        $sql .= " AND paciente_id = ?";
        $params[] = $paciente;
    }
    if($examen){
        $sql .= " AND tipo_examen = ?";
        $params[] = $examen;
    }

    $stmt = $this->conn->prepare($sql);
    $stmt->execute($params);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    public function insertar($data){
        $sql = "INSERT INTO citas (paciente_id, tipo_examen, empresa, fecha_cita)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['paciente'],
            $data['examen'],
            $data['empresa'],
            $data['fecha'] // Ya viene convertido con espacio en el controller
        ]);
    }

    public function obtener($id){
        $sql = "SELECT * FROM citas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($data){
        $sql = "UPDATE citas SET
                paciente_id=?,
                tipo_examen=?,
                empresa=?,
                fecha_cita=?
                WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['paciente'],
            $data['examen'],
            $data['empresa'],
            $data['fecha'], // Convertido en el controller
            $data['id']
        ]);
    }

    public function eliminar($id){
        $sql = "DELETE FROM citas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    // Opcional: obtener todas las horas ocupadas en un día específico para un tipo de examen
    public function obtenerHorasOcupadas($fecha, $tipo_examen){
        $sql = "SELECT DATE_FORMAT(fecha_cita, '%H:%i') as hora
                FROM citas
                WHERE DATE(fecha_cita) = ? AND tipo_examen = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$fecha, $tipo_examen]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }
}