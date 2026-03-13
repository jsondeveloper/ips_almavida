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
<script>
document.addEventListener("contextmenu", function(e){
e.preventDefault();
});
</script>
<style>
body {
    background: #f5f7fa;
    font-family: 'Segoe UI', sans-serif;
    user-select:none;
-webkit-user-select:none;
-moz-user-select:none;
-ms-user-select:none;
}
.card { border:none; border-radius:12px; box-shadow:0 2px 6px rgba(0,0,0,0.08); }
.toolbar { display:flex; gap:0.5rem; flex-wrap:wrap; margin-bottom:1rem; align-items:center; }
.toolbar h3 { flex:1; margin:0; color:#0F4C81; font-weight:600; }
.toolbar input { flex:2; min-width:150px; border-radius:6px; border:1px solid #E6E6E6; padding:6px 10px; }
.table th, .table td{ font-size:0.875rem; vertical-align:middle; }
.table tbody tr td{ padding:0.35rem 0.5rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis; }
.btn-editar { background:#1E6FB8; border-color:#1E6FB8; color:white; }
.btn-editar:hover { background:#0F4C81; border-color:#0F4C81; }
.btn-eliminar { background:#2FBF71; border-color:#2FBF71; color:white; }
.btn-eliminar:hover { background:#1FA89A; border-color:#1FA89A; }

input, select { border-radius:8px; border:1px solid #E6E6E6; padding:6px 10px; }
.is-invalid { border-color:#dc3545 !important; }
.is-valid { border-color:#2FBF71 !important; }
.invalid-feedback { display:none; color:#dc3545; font-size:0.85rem; }

.modal-content .btn-guardar {
    background:#2FBF71 !important;
    border-color:#2FBF71 !important;
    color:white !important;
}
.modal-content .btn-guardar:hover {
    background:#1FA89A !important;
    border-color:#1FA89A !important;
}

.modal-content .btn-volver {
    background:#0F4C81 !important;
    border-color:#0F4C81 !important;
    color:white !important;
}
.modal-content .btn-volver:hover {
    background:#1E6FB8 !important;
    border-color:#1E6FB8 !important;
}
.modal-header{
  display: none !important;
}
.modal-content{
  background-color: transparent !important;
  border: none !important;
}
</style>
</head>
<body class="container-fluid mt-4">

<div class="card shadow p-3">
<div class="toolbar">
    <h3><i class="bi bi-person-circle"></i> Pacientes</h3>
    <input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar nombre, documento, celular, EPS o empresa...">
    <button id="limpiarFiltros" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i> Limpiar</button>
    <button id="btnCrear" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Nuevo Paciente</button>
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
<tr data-id="<?= $pac['id'] ?>">
<td><?= htmlspecialchars($pac['nombre_completo']) ?></td>
<td><?= htmlspecialchars($pac['numero_documento']) ?></td>
<td><?= htmlspecialchars($pac['empresa'] ?? '—') ?></td>
<td><?= htmlspecialchars($pac['edad']) ?></td>
<td><?= htmlspecialchars($pac['celular']) ?></td>
<td><?= htmlspecialchars($pac['eps']) ?></td>
<td class="text-center">
    <div class="d-flex justify-content-center flex-wrap gap-1">
        <button class="btn btn-guardar btn-sm btn-editar btn-lightbox" data-id="<?= $pac['id'] ?>"><i class="bi bi-pencil-square"></i></button>
        <a href="../../controllers/PacienteController.php?accion=eliminar&id=<?= $pac['id'] ?>" class="btn btn-volver btn-sm btn-eliminar" onclick="return confirm('¿Eliminar paciente?')"><i class="bi bi-trash"></i></a>
    </div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalPaciente" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body" id="contenidoModal"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const modal = new bootstrap.Modal(document.getElementById('modalPaciente'));
const tituloModal = document.getElementById('tituloModal');
const contenidoModal = document.getElementById('contenidoModal');

function cargarFormulario(url){
    // No se cambia título, solo cargamos contenido
    fetch(url)
    .then(resp => resp.text())
    .then(html => {
        contenidoModal.innerHTML = html;
        modal.show();

        const form = contenidoModal.querySelector('form');

        // Calcular edad automáticamente
        const fechaInput = form.querySelector('input[name="fecha"]');
        const edadInput = form.querySelector('input[name="edad"]');
        if(fechaInput && edadInput){
            fechaInput.addEventListener('change', () => {
                const fecha = new Date(fechaInput.value);
                const hoy = new Date();
                let edad = hoy.getFullYear() - fecha.getFullYear();
                const m = hoy.getMonth() - fecha.getMonth();
                if(m < 0 || (m===0 && hoy.getDate() < fecha.getDate())) edad--;
                edadInput.value = edad;
            });
        }

        // Validación y submit
        form.addEventListener('submit', function(e){
            e.preventDefault();
            let valido = true;
            form.querySelectorAll('input,select').forEach(input=>{
                if(!input.checkValidity()){
                    input.classList.add('is-invalid');
                    input.classList.remove('is-valid');
                    const fb = input.nextElementSibling;
                    if(fb && fb.classList.contains('invalid-feedback')) fb.style.display='block';
                    valido = false;
                } else {
                    input.classList.remove('is-invalid');
                    input.classList.add('is-valid');
                    const fb = input.nextElementSibling;
                    if(fb && fb.classList.contains('invalid-feedback')) fb.style.display='none';
                }
            });
            if(!valido) return;

            const formData = new FormData(form);
            fetch(form.action, { method: form.method, body: formData })
            .then(resp => {
                if(resp.ok){
                    modal.hide();
                    location.reload(); // o actualizar solo la fila si quieres
                }
            });
        });
    });
}

// Crear
document.getElementById('btnCrear').addEventListener('click', ()=> cargarFormulario('crear.php'));

// Editar
document.querySelectorAll('.btn-lightbox').forEach(btn=>{
    btn.addEventListener('click', ()=> {
        const id = btn.dataset.id;
        cargarFormulario(`editar.php?id=${id}`);
    });
});

// Buscador
const filas = document.querySelectorAll('#tablaPacientes tbody tr');
const buscador = document.getElementById('buscador');
const limpiarFiltros = document.getElementById('limpiarFiltros');

function filtrarTabla(){
    const texto = buscador.value.toLowerCase();
    filas.forEach(fila=>{
        const nombre = fila.cells[0].textContent.toLowerCase();
        const documento = fila.cells[1].textContent.toLowerCase();
        const empresa = fila.cells[2].textContent.toLowerCase();
        const celular = fila.cells[4].textContent.toLowerCase();
        const eps = fila.cells[5].textContent.toLowerCase();
        fila.style.display = (nombre.includes(texto)||documento.includes(texto)||empresa.includes(texto)||celular.includes(texto)||eps.includes(texto))?'':'none';
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