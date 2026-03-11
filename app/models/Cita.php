<?php

require_once __DIR__ . "/../../config/database.php";

class Cita{

private $conn;

public function __construct(){

$db = new Database();
$this->conn = $db->conectar();

}

public function listar(){

$sql="SELECT citas.*, pacientes.nombre_completo
FROM citas
INNER JOIN pacientes
ON citas.paciente_id = pacientes.id";

$stmt=$this->conn->prepare($sql);
$stmt->execute();

return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function insertar($data){

$sql="INSERT INTO citas (paciente_id,tipo_examen,empresa,fecha_cita)
VALUES (?,?,?,?)";

$stmt=$this->conn->prepare($sql);

$stmt->execute([
$data['paciente'],
$data['examen'],
$data['empresa'],
$data['fecha']
]);

}
public function obtener($id){

$sql="SELECT * FROM citas WHERE id=?";
$stmt=$this->conn->prepare($sql);
$stmt->execute([$id]);

return $stmt->fetch(PDO::FETCH_ASSOC);

}

public function actualizar($data){

$sql="UPDATE citas SET
paciente_id=?,
tipo_examen=?,
empresa=?,
fecha_cita=?
WHERE id=?";

$stmt=$this->conn->prepare($sql);

$stmt->execute([
$data['paciente'],
$data['examen'],
$data['empresa'],
$data['fecha'],
$data['id']
]);

}

public function eliminar($id){

$sql="DELETE FROM citas WHERE id=?";
$stmt=$this->conn->prepare($sql);
$stmt->execute([$id]);

}

}