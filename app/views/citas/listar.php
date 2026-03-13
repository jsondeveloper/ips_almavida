<?php
require_once "../../middleware/auth.php";
require_once "../../models/Cita.php";

$c = new Cita();
$citas = $c->listar();
?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Citas - IPS Alma Vida</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

<style>
body { background:#f5f7fa; font-family:'Segoe UI', sans-serif; }
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

.badge-examen { font-size:0.75rem; padding:0.35em 0.5em; border-radius:6px; color:white; }
.badge-Sangre{ background:#1E6FB8; }
.badge-Orina{ background:#1FA89A; }
.badge-RayosX{ background:#0F4C81; }
.badge-Ultrasonido{ background:#2FBF71; }
.badge-Electrocardiograma{ background:#7ED957; }


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
@media (max-width:767px){
    .toolbar{ flex-direction:column; align-items:stretch; }
    .toolbar>*{ flex:1 1 100%; }
}
</style>
</head>

<body class="container-fluid mt-4">

<div class="card shadow">
<div class="card-body">

<div class="toolbar">
    <h3><i class="bi bi-calendar-event"></i> Citas</h3>
    <input type="text" id="buscador" class="form-control form-control-sm" placeholder="Buscar paciente, empresa, examen, fecha o hora...">
    <button id="limpiarFiltros" class="btn btn-outline-secondary btn-sm"><i class="bi bi-x-circle"></i> Limpiar</button>
    <button id="btnCrear" class="btn btn-primary btn-sm"><i class="bi bi-plus-circle"></i> Nueva Cita</button>
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
<button class="btn btn-guardar btn-sm btn-editar btn-lightbox" data-id="<?= $cita['id'] ?>"><i class="bi bi-pencil-square"></i></button>
<a href="../../controllers/CitaController.php?accion=eliminar&id=<?= $cita['id'] ?>" class="btn btn-sm btn-volver btn-eliminar" onclick="return confirm('¿Eliminar cita?')"><i class="bi bi-trash"></i></a>
</div>
</td>
</tr>
<?php endforeach; ?>
</tbody>
</table>
</div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalCita" tabindex="-1">
  <div class="modal-dialog modal-xl modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body" id="contenidoModal"></div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// Modal
const modal = new bootstrap.Modal(document.getElementById('modalCita'));
const contenidoModal = document.getElementById('contenidoModal');

// Inicializar horas y validaciones (para modal)
function inicializarHoras(){
    const pacienteSelect = document.getElementById('paciente');
    const empresaInput = document.getElementById('empresa');
    const fechaInput = document.getElementById('fecha');
    const examenInput = document.getElementById('examen');
    const horaSelect = document.getElementById('hora');

    if(!pacienteSelect) return;

    pacienteSelect.addEventListener('change', ()=>{
        const empresa = pacienteSelect.options[pacienteSelect.selectedIndex].dataset.empresa || '';
        empresaInput.value = empresa;
    });

    function formato12h(hora){
        let h = parseInt(hora.split(':')[0]);
        let ampm = h >= 12 ? 'PM' : 'AM';
        h = h % 12; if(h===0) h=12;
        return h + ':00 ' + ampm;
    }

    function cargarHorasDisponibles(){
        const fecha = fechaInput.value;
        const examen = examenInput.value;
        if(!fecha || !examen) return;
        fetch(`../../controllers/CitaController.php?accion=horas_ocupadas&fecha=${fecha}&examen=${examen}`)
        .then(r=>r.json())
        .then(ocupadas=>{
            horaSelect.innerHTML = '<option value="">-- Seleccione una hora --</option>';
            for(let h=8; h<=17; h++){
                let hora24 = h.toString().padStart(2,'0') + ':00';
                let disabled = ocupadas.includes(hora24) ? 'disabled' : '';
                let clase = ocupadas.includes(hora24) ? 'hora-ocupada' : 'hora-disponible';
                horaSelect.innerHTML += `<option value="${fecha}T${hora24}" ${disabled} class="${clase}">${formato12h(hora24)} ${disabled?'(Ocupada)':'(Disponible)'}</option>`;
            }

           // Seleccionar la hora existente si estamos editando
const horaActual = horaSelect.dataset.horaActual; // <-- tomamos el valor de data-hora-actual
if(horaActual){
    horaSelect.value = fechaInput.value + "T" + horaActual; 
}
        });
    }

    // Disparar carga cuando cambian inputs
    fechaInput.addEventListener('change', cargarHorasDisponibles);
    examenInput.addEventListener('change', cargarHorasDisponibles);

    // ✅ Cargar inmediatamente si ya hay fecha y examen (para editar)
    if(fechaInput.value && examenInput.value){
        cargarHorasDisponibles();
    }

    // Validación
    const form = document.getElementById('formCita');
    form.addEventListener('submit', function(e){
        let valido=true;
        form.querySelectorAll('input,select').forEach(input=>{
            if(!input.checkValidity()){
                input.classList.add('is-invalid');
                input.classList.remove('is-valid');
                const fb = input.nextElementSibling;
                if(fb && fb.classList.contains('invalid-feedback')) fb.style.display='block';
                valido=false;
            } else {
                input.classList.remove('is-invalid');
                input.classList.add('is-valid');
                const fb = input.nextElementSibling;
                if(fb && fb.classList.contains('invalid-feedback')) fb.style.display='none';
            }
        });
        if(!valido) e.preventDefault();
    });
}

// Cargar formulario en modal
function cargarFormulario(url){
    fetch(url)
    .then(r=>r.text())
    .then(html=>{
        contenidoModal.innerHTML = html;
        modal.show();
        inicializarHoras();
    });
}

// Botón crear
document.getElementById('btnCrear').addEventListener('click', ()=> cargarFormulario('crear.php'));

// Botones editar
document.querySelectorAll('.btn-lightbox').forEach(btn=>{
    btn.addEventListener('click', ()=> cargarFormulario(`editar.php?id=${btn.dataset.id}`));
});

// Buscador
const buscador = document.getElementById('buscador');
const filas = document.querySelectorAll('#tablaCitas tbody tr');
document.getElementById('limpiarFiltros').addEventListener('click', ()=>{
    buscador.value=''; filtrarTabla();
});
buscador.addEventListener('keyup', filtrarTabla);
function filtrarTabla(){
    const texto = buscador.value.toLowerCase();
    filas.forEach(fila=>{
        const paciente=fila.cells[0].textContent.toLowerCase();
        const examen=fila.cells[1].textContent.toLowerCase();
        const empresa=fila.cells[2].textContent.toLowerCase();
        const fecha=fila.cells[3].textContent.toLowerCase();
        const hora=fila.cells[4].textContent.toLowerCase();
        fila.style.display=(paciente.includes(texto)||examen.includes(texto)||empresa.includes(texto)||fecha.includes(texto)||hora.includes(texto))?'':'none';
    });
}
</script>

</body>
</html>