<?php

require_once "../models/Cita.php";

$cita=new Cita();

$accion=$_GET['accion'] ?? '';

if($accion=="guardar"){

$cita->insertar($_POST);

header("Location: ../views/citas/listar.php");

}

if($accion=="actualizar"){

$cita->actualizar($_POST);

header("Location: ../views/citas/listar.php");

}

if($accion=="eliminar"){

$id=$_GET['id'];

$cita->eliminar($id);

header("Location: ../views/citas/listar.php");

}