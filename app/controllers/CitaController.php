<?php
require_once "../models/Cita.php";

$cita = new Cita();
$accion = $_GET['accion'] ?? '';

if($accion=="guardar"){
    $fecha = str_replace('T', ' ', $_POST['fecha']) . ':00'; // Convierte a formato MySQL
    $_POST['fecha'] = $fecha;

    $cita->insertar($_POST);
    header("Location: ../views/citas/listar.php");
}

if($accion=="actualizar"){
    $fecha = str_replace('T', ' ', $_POST['fecha']) . ':00';
    $_POST['fecha'] = $fecha;

    $cita->actualizar($_POST);
    header("Location: ../views/citas/listar.php");
}

if($accion == "eliminar"){

    $id = $_GET['id'];
    $cita->eliminar($id);

    header("Location: ../views/citas/listar.php");
    exit;
}

if($accion == "horas_ocupadas"){
    $fecha = $_GET['fecha'] ?? '';
    $examen = $_GET['examen'] ?? '';
    $horas = $cita->obtenerHorasOcupadas($fecha, $examen);
    echo json_encode($horas);
    exit;
}