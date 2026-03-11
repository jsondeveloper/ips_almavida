<?php

require_once "../models/Paciente.php";

$paciente=new Paciente();

$accion=$_GET['accion'] ?? '';

if($accion=="guardar"){

$paciente->insertar($_POST);

header("Location: ../views/pacientes/listar.php");

}

if($accion=="actualizar"){

$paciente->actualizar($_POST);

header("Location: ../views/pacientes/listar.php");

}

if($accion=="eliminar"){

$id=$_GET['id'];

$paciente->eliminar($id);

header("Location: ../views/pacientes/listar.php");

}