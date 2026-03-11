<?php

require_once __DIR__ . "/../../config/database.php";

class Paciente{

private $conn;

public function __construct(){

$db = new Database();
$this->conn = $db->conectar();

}

public function listar(){

$sql="SELECT * FROM pacientes";
$stmt=$this->conn->prepare($sql);
$stmt->execute();
return $stmt->fetchAll(PDO::FETCH_ASSOC);

}

public function insertar($data){

$sql="INSERT INTO pacientes
(nombre_completo,tipo_documento,numero_documento,direccion,telefono,celular,fecha_nacimiento,edad,eps,contacto_emergencia,parentesco)
VALUES (?,?,?,?,?,?,?,?,?,?,?)";

$stmt=$this->conn->prepare($sql);

$stmt->execute([
$data['nombre'],
$data['tipo_documento'],
$data['documento'],
$data['direccion'],
$data['telefono'],
$data['celular'],
$data['fecha'],
$data['edad'],
$data['eps'],
$data['contacto'],
$data['parentesco']
]);

}

public function obtener($id){

$sql="SELECT * FROM pacientes WHERE id=?";
$stmt=$this->conn->prepare($sql);
$stmt->execute([$id]);

return $stmt->fetch(PDO::FETCH_ASSOC);

}

public function actualizar($data){

$sql="UPDATE pacientes SET
nombre_completo=?,
tipo_documento=?,
numero_documento=?,
direccion=?,
telefono=?,
celular=?,
fecha_nacimiento=?,
edad=?,
eps=?,
contacto_emergencia=?,
parentesco=?
WHERE id=?";

$stmt=$this->conn->prepare($sql);

$stmt->execute([
$data['nombre'],
$data['tipo_documento'],
$data['documento'],
$data['direccion'],
$data['telefono'],
$data['celular'],
$data['fecha'],
$data['edad'],
$data['eps'],
$data['contacto'],
$data['parentesco'],
$data['id']
]);

}

public function eliminar($id){

$sql="DELETE FROM pacientes WHERE id=?";
$stmt=$this->conn->prepare($sql);
$stmt->execute([$id]);

}

}