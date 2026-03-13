<?php
require_once "../../middleware/auth.php";
require_once __DIR__ . "/../../models/Empresa.php";

$e = new Empresa();
$id = $_GET['id'];
$empresa = $e->obtener($id);
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Editar Empresa</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body{
    background:#f5f7fa;
    font-family:'Segoe UI', sans-serif;
}

.card{
    border:none;
    border-radius:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

.is-invalid{ border-color:#dc3545; }
.is-valid{ border-color:#28a745; }

.invalid-feedback{
    display:none;
    color:#dc3545;
}

.btn-success{
    background:#2FBF71;
    border-color:#2FBF71;
    color:white;
}
.btn-success:hover{
    background:#1FA89A;
    border-color:#1FA89A;
}
.btn-secondary{
    background:#E6E6E6;
    border-color:#E6E6E6;
    color:#333;
}
.btn-secondary:hover{
    background:#d4d4d4;
    border-color:#d4d4d4;
}
.btn-guardar {
    background: #2FBF71;
    border-color: #2FBF71;
    color: white;
    font-weight: 500;
}
.btn-guardar:hover {
    background: #1FA89A;
    border-color: #1FA89A;
}

.btn-volver {
    background: #0F4C81;
    border-color: #0F4C81;
    color: white;
    font-weight: 500;
}
.btn-volver:hover {
    background: #1E6FB8;
    border-color: #1E6FB8;
}
h3 {
    color: #0F4C81;
    font-weight: 600;
}

.form-label {
    font-weight: 500;
    color: #0F4C81;
}

input, select {
    border-radius: 8px;
    border: 1px solid #E6E6E6;
    padding: 6px 10px;
}

.is-invalid { border-color: #dc3545; }
.is-valid { border-color: #2FBF71; }
</style>
</head>

<body class="container-fluid mt-4">

<div class="card shadow p-4">

<h3 class="mb-4"><i class="bi bi-pencil-square"></i> Editar Empresa</h3>

<form id="formEmpresa" action="../../controllers/EmpresaController.php?accion=actualizar" method="POST" novalidate>

<input type="hidden" name="id" value="<?= htmlspecialchars($empresa['id']) ?>">

<div class="row">

<div class="col-md-6 mb-3">
<label class="form-label">Nombre</label>
<input type="text" name="nombre" class="form-control" value="<?= htmlspecialchars($empresa['nombre']) ?>" required>
<div class="invalid-feedback">El nombre de la empresa es obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">NIT</label>
<input type="text" name="nit" class="form-control" value="<?= htmlspecialchars($empresa['nit']) ?>" required>
<div class="invalid-feedback">El NIT es obligatorio.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Dirección</label>
<input type="text" name="direccion" class="form-control" value="<?= htmlspecialchars($empresa['direccion']) ?>" required>
<div class="invalid-feedback">La dirección es obligatoria.</div>
</div>

<div class="col-md-6 mb-3">
<label class="form-label">Teléfono</label>
<input type="tel" name="telefono" class="form-control" value="<?= htmlspecialchars($empresa['telefono']) ?>" required>
<div class="invalid-feedback">El teléfono es obligatorio.</div>
</div>

</div>

<div class="mt-3">
    <button type="submit" class="btn btn-guardar me-2">
        <i class="bi bi-save"></i> Actualizar
    </button>
    <a href="listar.php" class="btn btn-volver">
        <i class="bi bi-arrow-left"></i> Volver
    </a>
</div>

</form>
</div>

<script>
document.getElementById("formEmpresa").addEventListener("submit", function(e){
    let valido = true;
    this.querySelectorAll("input[required]").forEach(input => {
        if(input.value.trim() === ""){
            valido=false;
            input.classList.add("is-invalid");
            input.classList.remove("is-valid");
            input.nextElementSibling.style.display="block";
        } else {
            input.classList.remove("is-invalid");
            input.classList.add("is-valid");
            input.nextElementSibling.style.display="none";
        }
    });
    if(!valido) e.preventDefault();
});
</script>

</body>
</html>