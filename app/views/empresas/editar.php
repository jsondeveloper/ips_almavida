<?php
require_once "../../middleware/auth.php";
require_once __DIR__ . "/../../models/Empresa.php";

$e = new Empresa();
$id = $_GET['id'];
$empresa = $e->obtener($id);
?>

<!DOCTYPE html>
<html>

<head>

<meta charset="UTF-8">

<title>Editar Empresa</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
background:#f5f7fa;
}

.card{
border:none;
border-radius:10px;
}

.is-invalid{
border-color:#dc3545;
}

.is-valid{
border-color:#28a745;
}

.invalid-feedback{
display:none;
color:#dc3545;
}

</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow p-4">

<h4 class="mb-4">✏ Editar Empresa</h4>

<form id="formEmpresa" action="../../controllers/EmpresaController.php?accion=actualizar" method="POST" novalidate>

<input type="hidden" name="id" value="<?= htmlspecialchars($empresa['id']) ?>">

<div class="row">

<div class="col-md-6 mb-3">

<label class="form-label">Nombre</label>

<input
type="text"
name="nombre"
class="form-control"
value="<?= htmlspecialchars($empresa['nombre']) ?>"
required
>

<div class="invalid-feedback">
El nombre de la empresa es obligatorio.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">NIT</label>

<input
type="text"
name="nit"
class="form-control"
value="<?= htmlspecialchars($empresa['nit']) ?>"
required
>

<div class="invalid-feedback">
El NIT es obligatorio.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">Dirección</label>

<input
type="text"
name="direccion"
class="form-control"
value="<?= htmlspecialchars($empresa['direccion']) ?>"
required
>

<div class="invalid-feedback">
La dirección es obligatoria.
</div>

</div>


<div class="col-md-6 mb-3">

<label class="form-label">Teléfono</label>

<input
type="tel"
name="telefono"
class="form-control"
value="<?= htmlspecialchars($empresa['telefono']) ?>"
required
>

<div class="invalid-feedback">
El teléfono es obligatorio.
</div>

</div>

</div>


<button type="submit" class="btn btn-success">
💾 Actualizar
</button>

<a href="listar.php" class="btn btn-secondary">
⬅ Volver
</a>

</form>

</div>



<script>

document.getElementById("formEmpresa").addEventListener("submit",function(e){

let valido = true;

this.querySelectorAll("input[required]").forEach(input=>{

if(input.value.trim()===""){

valido=false;

input.classList.add("is-invalid");
input.classList.remove("is-valid");

input.nextElementSibling.style.display="block";

}else{

input.classList.remove("is-invalid");
input.classList.add("is-valid");

input.nextElementSibling.style.display="none";

}

});

if(!valido){
e.preventDefault();
}

});

</script>

</body>

</html>