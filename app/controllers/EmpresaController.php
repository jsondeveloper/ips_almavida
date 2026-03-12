<?php
require_once "../models/Empresa.php";

$empresa = new Empresa();
$accion = $_GET['accion'] ?? '';

if($accion == "guardar") {
    $empresa->insertar($_POST);
    header("Location: ../views/empresas/listar.php");
}

if($accion == "actualizar") {
    $empresa->actualizar($_POST);
    header("Location: ../views/empresas/listar.php");
}

if($accion == "eliminar") {
    $id = $_GET['id'];
    $empresa->eliminar($id);
    header("Location: ../views/empresas/listar.php");
    exit;
}
?>