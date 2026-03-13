<?php
require_once __DIR__ . "/../../config/database.php";

class Empresa {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->conectar();
    }

    // Listar empresas normales
    public function listar() {
        $sql = "SELECT * FROM empresas ORDER BY nombre";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Listar empresas con cantidad de pacientes (optimizado)
    public function listarConEmpleados() {
        $sql = "
            SELECT e.*, 
                   COUNT(p.id) AS cantidad_empleados
            FROM empresas e
            LEFT JOIN pacientes p ON p.empresa_id = e.id
            GROUP BY e.id
            ORDER BY e.nombre
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function insertar($data) {
        $sql = "INSERT INTO empresas (nombre, nit, direccion, telefono) VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['nit'],
            $data['direccion'],
            $data['telefono']
        ]);
    }

    public function obtener($id) {
        $sql = "SELECT * FROM empresas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function actualizar($data) {
        $sql = "UPDATE empresas SET nombre=?, nit=?, direccion=?, telefono=? WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            $data['nombre'],
            $data['nit'],
            $data['direccion'],
            $data['telefono'],
            $data['id']
        ]);
    }

    public function eliminar($id) {
        $sql = "DELETE FROM empresas WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }
}
?>