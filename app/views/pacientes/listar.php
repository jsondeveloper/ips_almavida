<?php
require_once "../../middleware/auth.php";
require_once "../../models/Paciente.php";

$p = new Paciente();
$pacientes = $p->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Pacientes - IPS Alma Vida</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body {
    background:#f5f7fa;
    font-family: 'Segoe UI', sans-serif;
}

.card {
    border: none;
    border-radius: 12px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.08);
}

/* Toolbar */
.toolbar {
    display:flex;
    align-items:center;
    gap:0.5rem;
    flex-wrap:nowrap;
    margin-bottom:1rem;
}
.toolbar > * { flex:1 1 auto; }
.toolbar h3 {
    flex:0 0 auto;
    margin-bottom:0;
    font-size:1.25rem;
    color:#0F4C81;
    font-weight:600;
}
.toolbar input {
    flex:2 1 auto;
    min-width:150px;
    border-radius:6px;
    border:1px solid #E6E6E6;
    padding:6px 10px;
}
.toolbar button, .toolbar a {
    flex:0 0 auto;
    white-space:nowrap;
    border-radius:6px;
}

/* Buttons */
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

/* Table */
.table th, .table td{
    font-size:0.875rem;
    vertical-align:middle;
}
.table tbody tr td{
    padding:0.35rem 0.5rem;
    white-space:nowrap;
    overflow:hidden;
    text-overflow:ellipsis;
}

/* Responsive toolbar */
@media (max-width:767px){
    .toolbar {
        flex-direction:column;
        align-items:stretch;
    }
    .toolbar > * {
        flex:1 1 100%;
    }
}
</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<div class="toolbar">
    <h3><i class="bi bi-person-circle"></i> Pacientes</h3>

    <input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar nombre, documento, celular, EPS o empresa...">

    <button id="limpiarFiltros" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-x-circle"></i> Limpiar
    </button>

    <a href="crear.php" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Nuevo Paciente
    </a>
</div>

<div class="table-responsive">
<table class="table table-hover align-middle" id="tablaPacientes">
<thead class="table-primary text-white">
<tr>
<th>Nombre</th>
<th>Documento</th>
<th>Empresa</th>
<th>Edad</th>
<th>Celular</th>
<th>EPS</th>
<th class="text-center">Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach($pacientes as $pac): ?>
<tr>
<td><?= htmlspecialchars($pac['nombre_completo']) ?></td>
<td><?= htmlspecialchars($pac['numero_documento']) ?></td>
<td><?= htmlspecialchars($pac['empresa'] ?? '—') ?></td>
<td><?= htmlspecialchars($pac['edad']) ?></td>
<td><?= htmlspecialchars($pac['celular']) ?></td>
<td><?= htmlspecialchars($pac['eps']) ?></td>
<td class="text-center">
    <div class="d-flex justify-content-center flex-wrap gap-1">
        <a href="editar.php?id=<?= $pac['id'] ?>" class="btn btn-sm btn-editar" title="Editar">
            <i class="bi bi-pencil-square"></i>
        </a>
        <a href="../../controllers/PacienteController.php?accion=eliminar&id=<?= $pac['id'] ?>" class="btn btn-sm btn-eliminar" onclick="return confirm('¿Eliminar paciente?')" title="Eliminar">
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
const buscador = document.getElementById('buscador');
const limpiarFiltros = document.getElementById('limpiarFiltros');
const filas = document.querySelectorAll('#tablaPacientes tbody tr');

function filtrarTabla() {
    const texto = buscador.value.toLowerCase();
    filas.forEach(fila => {
        const nombre = fila.cells[0].textContent.toLowerCase();
        const documento = fila.cells[1].textContent.toLowerCase();
        const empresa = fila.cells[2].textContent.toLowerCase();
        const edad = fila.cells[3].textContent.toLowerCase();
        const celular = fila.cells[4].textContent.toLowerCase();
        const eps = fila.cells[5].textContent.toLowerCase();

        fila.style.display =
        (nombre.includes(texto) || documento.includes(texto) || empresa.includes(texto) || celular.includes(texto) || eps.includes(texto)) ? '' : 'none';
    });
}

buscador.addEventListener('keyup', filtrarTabla);
limpiarFiltros.addEventListener('click', ()=>{
    buscador.value='';
    filtrarTabla();
});
</script>

</body>
</html>