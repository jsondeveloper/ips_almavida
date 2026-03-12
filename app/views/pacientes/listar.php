<?php
require_once "../../middleware/auth.php";
require_once "../../models/Paciente.php";

$p = new Paciente();
$pacientes = $p->listar();
?>

<!DOCTYPE html>
<html>
<head>
<title>Pacientes</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{ background:#f5f7fa; }
.card{ border:none; border-radius:10px; }

/* Barra herramientas */
.toolbar {
display:flex;
align-items:center;
gap:0.5rem;
flex-wrap:nowrap;
margin-bottom:1rem;
}

.toolbar > * { flex:1 1 auto; }

.toolbar h3{
flex:0 0 auto;
margin-bottom:0;
font-size:1.25rem;
}

.toolbar input{
flex:2 1 auto;
min-width:150px;
}

.toolbar button,.toolbar a{
flex:0 0 auto;
white-space:nowrap;
}

/* móvil */
@media (max-width:767px){
.toolbar{
flex-direction:column;
align-items:stretch;
}
.toolbar>*{
flex:1 1 100%;
}
}

/* filas compactas */
.table tbody tr td{
padding:0.35rem 0.5rem;
white-space:nowrap;
overflow:hidden;
text-overflow:ellipsis;
}

.table th,.table td{
font-size:0.875rem;
}
</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">

<div class="card-body">

<div class="toolbar">

<h3>👤 Pacientes</h3>

<input
type="text"
id="buscador"
class="form-control form-control-sm"
placeholder="Buscar nombre, documento, celular, EPS o empresa...">

<button id="limpiarFiltros" class="btn btn-secondary btn-sm">
❌ Limpiar
</button>

<a href="crear.php" class="btn btn-primary btn-sm">
➕ Nuevo Paciente
</a>

</div>

<div class="table-responsive">

<table class="table table-striped table-hover align-middle" id="tablaPacientes">

<thead class="table-dark">

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

<?php foreach($pacientes as $pac){ ?>

<tr>

<td><?= htmlspecialchars($pac['nombre_completo']) ?></td>

<td><?= htmlspecialchars($pac['numero_documento']) ?></td>

<td><?= htmlspecialchars($pac['empresa'] ?? '—') ?></td>

<td><?= htmlspecialchars($pac['edad']) ?></td>

<td><?= htmlspecialchars($pac['celular']) ?></td>

<td><?= htmlspecialchars($pac['eps']) ?></td>

<td class="text-center">

<div class="d-flex justify-content-center flex-wrap gap-1">

<a href="editar.php?id=<?= $pac['id'] ?>" class="btn btn-warning btn-sm">
✏ Editar
</a>

<a href="../../controllers/PacienteController.php?accion=eliminar&id=<?= $pac['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar paciente?')">

🗑 Eliminar

</a>

</div>

</td>

</tr>

<?php } ?>

</tbody>

</table>

</div>

</div>

</div>

<script>

const buscador = document.getElementById('buscador');
const limpiarFiltros = document.getElementById('limpiarFiltros');
const filas = document.querySelectorAll('#tablaPacientes tbody tr');

function filtrarTabla(){

const texto = buscador.value.toLowerCase();

filas.forEach(fila => {

const nombre = fila.cells[0].textContent.toLowerCase();
const documento = fila.cells[1].textContent.toLowerCase();
const empresa = fila.cells[2].textContent.toLowerCase();
const edad = fila.cells[3].textContent.toLowerCase();
const celular = fila.cells[4].textContent.toLowerCase();
const eps = fila.cells[5].textContent.toLowerCase();

fila.style.display =
(nombre.includes(texto) ||
documento.includes(texto) ||
empresa.includes(texto) ||
celular.includes(texto) ||
eps.includes(texto))
? ''
: 'none';

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