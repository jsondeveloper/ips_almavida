<?php
require_once "../../middleware/auth.php";
require_once "../../models/Cita.php";

$c = new Cita();
$citas = $c->listar();
?>

<!DOCTYPE html>
<html>
<head>

<title>Citas</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{ background:#f5f7fa; }

.card{
border:none;
border-radius:10px;
}

.toolbar{
display:flex;
align-items:center;
gap:0.5rem;
flex-wrap:nowrap;
margin-bottom:1rem;
}

.toolbar>*{
flex:1 1 auto;
}

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

@media (max-width:767px){

.toolbar{
flex-direction:column;
align-items:stretch;
}

.toolbar>*{
flex:1 1 100%;
}

}

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

<h3>📅 Citas</h3>

<input
type="text"
id="buscador"
class="form-control form-control-sm"
placeholder="Buscar paciente, empresa, examen, fecha o hora...">

<button id="limpiarFiltros" class="btn btn-secondary btn-sm">
❌ Limpiar
</button>

<a href="crear.php" class="btn btn-primary btn-sm">
➕ Nueva Cita
</a>

</div>

<div class="table-responsive">

<table class="table table-striped table-hover align-middle" id="tablaCitas">

<thead class="table-dark">

<tr>

<th>Paciente</th>
<th>Examen</th>
<th>Empresa</th>
<th>Fecha</th>
<th>Hora</th>
<th class="text-center">Acciones</th>

</tr>

</thead>

<tbody>

<?php foreach($citas as $cita){ ?>

<tr>

<td>
<?= htmlspecialchars($cita['nombre_completo']) ?>
</td>

<td>
<?= htmlspecialchars($cita['tipo_examen']) ?>
</td>

<td>
<?= htmlspecialchars($cita['empresa'] ?? '—') ?>
</td>

<td>
<?= date('d/m/Y', strtotime($cita['fecha_cita'])) ?>
</td>

<td>
<?= date('h:i A', strtotime($cita['fecha_cita'])) ?>
</td>

<td class="text-center">

<div class="d-flex justify-content-center flex-wrap gap-1">

<a
href="editar.php?id=<?= $cita['id'] ?>"
class="btn btn-warning btn-sm">

✏ Editar

</a>

<a
href="../../controllers/CitaController.php?accion=eliminar&id=<?= $cita['id'] ?>"
class="btn btn-danger btn-sm"
onclick="return confirm('¿Eliminar cita?')">

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
const filas = document.querySelectorAll('#tablaCitas tbody tr');

function filtrarTabla(){

const texto = buscador.value.toLowerCase();

filas.forEach(fila=>{

const paciente = fila.cells[0].textContent.toLowerCase();
const examen = fila.cells[1].textContent.toLowerCase();
const empresa = fila.cells[2].textContent.toLowerCase();
const fecha = fila.cells[3].textContent.toLowerCase();
const hora = fila.cells[4].textContent.toLowerCase();

fila.style.display =
(paciente.includes(texto) ||
empresa.includes(texto) ||
examen.includes(texto) ||
fecha.includes(texto) ||
hora.includes(texto))
? ''
: 'none';

});

}

buscador.addEventListener('keyup',filtrarTabla);

limpiarFiltros.addEventListener('click',()=>{

buscador.value='';
filtrarTabla();

});

</script>

</body>
</html>