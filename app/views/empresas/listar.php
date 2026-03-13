<?php
require_once "../../middleware/auth.php";
require_once "../../models/Empresa.php";

$e = new Empresa();
$empresas = $e->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Empresas</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background:#f5f7fa;
    font-family:'Segoe UI', sans-serif;
}

.card {
    border:none;
    border-radius:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.08);
}

.toolbar {
    display:flex;
    align-items:center;
    gap:0.5rem;
    flex-wrap:nowrap;
    margin-bottom:1rem;
}

.toolbar h3 {
    flex:0 0 auto;
    margin-bottom:0;
    font-size:1.25rem;
    color:#0F4C81;
}

.toolbar input {
    flex:2 1 auto;
    min-width:180px;
    border-radius:6px;
    border:1px solid #E6E6E6;
}

.toolbar button, .toolbar a {
    flex:0 0 auto;
    white-space:nowrap;
    border-radius:6px;
}

.table th, .table td {
    font-size:0.875rem;
    vertical-align:middle;
}

.table tbody tr td {
    padding:0.35rem 0.5rem;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* Botones */
.btn-editar {
    background:#1E6FB8;
    border-color:#1E6FB8;
    color:white;
}
.btn-editar:hover {
    background:#0F4C81;
    border-color:#0F4C81;
}

.btn-eliminar {
    background:#2FBF71;
    border-color:#2FBF71;
    color:white;
}
.btn-eliminar:hover {
    background:#1FA89A;
    border-color:#1FA89A;
}

@media(max-width:767px){
    .toolbar {
        flex-direction:column;
        align-items:stretch;
    }
    .toolbar>* {
        flex:1 1 100%;
    }
}
</style>

</head>
<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<div class="toolbar">
<h3><i class="bi bi-building"></i> Empresas</h3>

<input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar empresa o NIT...">

<a href="crear.php" class="btn btn-primary btn-sm">
<i class="bi bi-plus-circle"></i> Nueva Empresa
</a>
</div>

<div class="table-responsive">
<table class="table table-striped table-hover align-middle" id="tablaEmpresas">
<thead class="table-primary text-white">
<tr>
<th>Nombre</th>
<th>NIT</th>
<th>Dirección</th>
<th>Teléfono</th>
<th class="text-center">Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach($empresas as $empresa): ?>
<tr>
<td><?= htmlspecialchars($empresa['nombre']) ?></td>
<td><?= htmlspecialchars($empresa['nit']) ?></td>
<td><?= htmlspecialchars($empresa['direccion']) ?></td>
<td><?= htmlspecialchars($empresa['telefono']) ?></td>
<td class="text-center">
<div class="d-flex justify-content-center flex-wrap gap-1">
<a href="editar.php?id=<?= $empresa['id'] ?>" class="btn btn-sm btn-editar" title="Editar">
<i class="bi bi-pencil-square"></i>
</a>
<a href="../../controllers/EmpresaController.php?accion=eliminar&id=<?= $empresa['id'] ?>" class="btn btn-sm btn-eliminar" onclick="return confirm('¿Eliminar empresa?')" title="Eliminar">
<i class="bi bi-trash"></i>
</a>
</div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>

</div>
</div>

<script>
const buscador = document.getElementById("buscador");
const filas = document.querySelectorAll("#tablaEmpresas tbody tr");

buscador.addEventListener("keyup", function(){
    const texto = this.value.toLowerCase();
    filas.forEach(fila => {
        const nombre = fila.cells[0].textContent.toLowerCase();
        const nit = fila.cells[1].textContent.toLowerCase();
        fila.style.display = (nombre.includes(texto) || nit.includes(texto)) ? "" : "none";
    });
});
</script>

</body>
</html>