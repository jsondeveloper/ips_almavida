<?php
require_once "../../middleware/auth.php";
require_once "../../models/Empresa.php";

$e = new Empresa();
$empresas = $e->listarConEmpleados(); // <-- usamos el método optimizado
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Empresas - IPS Alma Vida</title>
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

/* Botones dentro del modal */
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
    <h3><i class="bi bi-building"></i> Empresas</h3>
    <input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar empresa o NIT...">
    <button id="limpiarFiltros" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i> Limpiar</button>
    <button id="btnCrear" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Nueva Empresa</button>
</div>

<div class="table-responsive">
<table class="table table-hover align-middle" id="tablaEmpresas">
<thead class="table-primary text-white">
<tr>
<th>Nombre</th>
<th>NIT</th>
<th>Dirección</th>
<th>Teléfono</th>
<th class="text-center">Pacientes</th> 
<th class="text-center">Acciones</th>
</tr>
</thead>
<tbody>
<?php foreach($empresas as $empresa): ?>
<tr data-id="<?= $empresa['id'] ?>">
<td><?= htmlspecialchars($empresa['nombre']) ?></td>
<td><?= htmlspecialchars($empresa['nit']) ?></td>
<td><?= htmlspecialchars($empresa['direccion']) ?></td>
<td><?= htmlspecialchars($empresa['telefono']) ?></td>
<td class="text-center"><?= $empresa['cantidad_empleados'] ?></td> 
<td class="text-center">
    <div class="d-flex justify-content-center flex-wrap gap-1">
        <button class="btn btn-guardar btn-sm btn-editar btn-lightbox" data-id="<?= $empresa['id'] ?>"><i class="bi bi-pencil-square"></i></button>
        <a href="../../controllers/EmpresaController.php?accion=eliminar&id=<?= $empresa['id'] ?>" class="btn btn-volver btn-sm btn-eliminar" onclick="return confirm('¿Eliminar empresa?')"><i class="bi bi-trash"></i></a>
    </div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEmpresa" tabindex="-1">
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
const modal = new bootstrap.Modal(document.getElementById('modalEmpresa'));
const contenidoModal = document.getElementById('contenidoModal');

function cargarFormulario(url){
    fetch(url)
    .then(resp => resp.text())
    .then(html => {
        contenidoModal.innerHTML = html;
        modal.show();

        const form = contenidoModal.querySelector('form');
        if(!form) return;

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
                    location.reload();
                }
            });
        });
    });
}

document.getElementById('btnCrear').addEventListener('click', ()=> cargarFormulario('crear.php'));

document.querySelectorAll('.btn-lightbox').forEach(btn=>{
    btn.addEventListener('click', ()=> {
        const id = btn.dataset.id;
        cargarFormulario(`editar.php?id=${id}`);
    });
});

const filas = document.querySelectorAll('#tablaEmpresas tbody tr');
const buscador = document.getElementById('buscador');
const limpiarFiltros = document.getElementById('limpiarFiltros');

function filtrarTabla(){
    const texto = buscador.value.toLowerCase();
    filas.forEach(fila=>{
        const nombre = fila.cells[0].textContent.toLowerCase();
        const nit = fila.cells[1].textContent.toLowerCase();
        fila.style.display = (nombre.includes(texto)||nit.includes(texto))?'':'none';
    });
}

buscador.addEventListener('keyup', filtrarTabla);
limpiarFiltros.addEventListener('click', ()=>{ buscador.value=''; filtrarTabla(); });
</script>

</body>
</html>