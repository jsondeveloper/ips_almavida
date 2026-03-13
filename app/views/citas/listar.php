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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

<style>
body {
    background:#F7FAFC;
    font-family: system-ui,-apple-system,Segoe UI,Roboto;
}

.card {
    border:none;
    border-radius:12px;
    box-shadow:0 2px 6px rgba(0,0,0,0.05);
}

.toolbar{
    display:flex;
    align-items:center;
    gap:0.5rem;
    flex-wrap:nowrap;
    margin-bottom:1rem;
}

.toolbar h3{
    flex:0 0 auto;
    margin-bottom:0;
    font-size:1.25rem;
    color:#0F4C81;
}

.toolbar input{
    flex:2 1 auto;
    min-width:180px;
    border-radius:6px;
    border:1px solid #E6E6E6;
}

.toolbar button, .toolbar a{
    flex:0 0 auto;
    white-space:nowrap;
    border-radius:6px;
}

.table th, .table td{
    font-size:0.875rem;
    vertical-align:middle;
}

.badge-examen{
    font-size:0.75rem;
    padding:0.35em 0.5em;
    border-radius:6px;
    color:white;
}

.badge-Sangre{ background:#1E6FB8; }
.badge-Orina{ background:#1FA89A; }
.badge-RayosX{ background:#0F4C81; }
.badge-Ultrasonido{ background:#2FBF71; }
.badge-Electrocardiograma{ background:#7ED957; }

.btn-sm i{
    vertical-align:middle;
}

.btn-editar{
    background:#1E6FB8;
    border-color:#1E6FB8;
    color:white;
}
.btn-editar:hover{
    background:#0F4C81;
    border-color:#0F4C81;
}

.btn-eliminar{
    background:#2FBF71;
    border-color:#2FBF71;
    color:white;
}
.btn-eliminar:hover{
    background:#1FA89A;
    border-color:#1FA89A;
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
</style>

</head>

<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<div class="toolbar">
    <h3><i class="bi bi-calendar-event"></i> Citas</h3>

    <input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar paciente, empresa, examen, fecha o hora...">

    <button id="limpiarFiltros" class="btn btn-outline-secondary btn-sm">
        <i class="bi bi-x-circle"></i> Limpiar
    </button>

    <a href="crear.php" class="btn btn-primary btn-sm">
        <i class="bi bi-plus-circle"></i> Nueva Cita
    </a>
</div>

<div class="table-responsive">
<table class="table table-hover align-middle" id="tablaCitas">
<thead class="table-primary text-white">
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

<?php foreach($citas as $cita): ?>
<tr>
<td><?= htmlspecialchars($cita['nombre_completo']) ?></td>
<td>
<?php 
$tipo = $cita['tipo_examen'] ?? 'No definido';
$badgeClass = "badge-".str_replace(' ','',$tipo);
?>
<span class="badge badge-examen <?= $badgeClass ?>"><?= $tipo ?></span>
</td>
<td><?= htmlspecialchars($cita['empresa'] ?? '—') ?></td>
<td><?= date('d/m/Y', strtotime($cita['fecha_cita'])) ?></td>
<td><?= date('h:i A', strtotime($cita['fecha_cita'])) ?></td>
<td class="text-center">
<div class="d-flex justify-content-center flex-wrap gap-1">
<a href="editar.php?id=<?= $cita['id'] ?>" class="btn btn-sm btn-editar" title="Editar">
    <i class="bi bi-pencil-square"></i>
</a>
<a href="../../controllers/CitaController.php?accion=eliminar&id=<?= $cita['id'] ?>" class="btn btn-sm btn-eliminar" onclick="return confirm('¿Eliminar cita?')" title="Eliminar">
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
        hora.includes(texto)) ? '' : 'none';
    });
}

buscador.addEventListener('keyup', filtrarTabla);

limpiarFiltros.addEventListener('click',()=>{
    buscador.value='';
    filtrarTabla();
});
</script>

</body>
</html>