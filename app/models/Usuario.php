<?php

require_once __DIR__ . "/../../config/database.php";

class Usuario {

private $conn;

public function __construct(){

$db = new Database();
$this->conn = $db->conectar();

}

public function buscarPorEmail($email){

$sql="SELECT * FROM usuarios WHERE email=?";
$stmt=$this->conn->prepare($sql);
$stmt->execute([$email]);

return $stmt->fetch(PDO::FETCH_ASSOC);

}

public function registrar($nombre,$email,$password){

$hash=password_hash($password,PASSWORD_DEFAULT);

$sql="INSERT INTO usuarios(nombre,email,password) VALUES(?,?,?)";

$stmt=$this->conn->prepare($sql);

return $stmt->execute([$nombre,$email,$hash]);

}

}