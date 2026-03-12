<?php
require_once "../../middleware/auth.php";
require_once "../../models/Paciente.php";
require_once "../../models/Cita.php";

$p = new Paciente();
$c = new Cita();

$totalPacientes = count($p->listar());
$totalCitas = count($c->listar());

date_default_timezone_set("America/Bogota");
$hoy = date("Y-m-d");

$citasHoy = 0;
$tiposExamen = [];
$pacientesEPS = [];
$trendPacientes = [];
$trendCitas = [];
$trendCitasHoy = [];

// Recorremos las citas
foreach($c->listar() as $cita){
    $fechaCita = date("Y-m-d", strtotime($cita['fecha_cita']));
    if($fechaCita == $hoy){
        $citasHoy++;
        $trendCitasHoy[$fechaCita] = ($trendCitasHoy[$fechaCita] ?? 0) + 1;
    }

    $tipo = $cita['tipo_examen'];
    $tiposExamen[$tipo] = ($tiposExamen[$tipo] ?? 0) + 1;

    $day = date("Y-m-d", strtotime($cita['fecha_cita']));
    $trendCitas[$day] = ($trendCitas[$day] ?? 0) + 1;
}

// Recorremos los pacientes
foreach($p->listar() as $pac){
    $eps = $pac['eps'];
    $pacientesEPS[$eps] = ($pacientesEPS[$eps] ?? 0) + 1;

    $day = date("Y-m-d", strtotime($pac['creado_en'] ?? date("Y-m-d")));
    $trendPacientes[$day] = ($trendPacientes[$day] ?? 0) + 1;
}

// Últimos 7 días
$last7Days = [];
for($i=6; $i>=0; $i--){
    $day = date("Y-m-d", strtotime("-$i days"));
    $last7Days[] = $day;
    $trendCitas[$day] = $trendCitas[$day] ?? 0;
    $trendPacientes[$day] = $trendPacientes[$day] ?? 0;
    $trendCitasHoy[$day] = $trendCitasHoy[$day] ?? 0;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{ background:#f5f7fa; }
.card{ border:none; border-radius:12px; }
.numero{ font-size:28px; font-weight:bold; }
.card .chart-container{ height:200px; }
.table th, .table td{ white-space: nowrap; font-size:0.9rem; }
</style>
</head>
<body class="container-fluid mt-4">

<h3 class="mb-4">📊 Dashboard</h3>

<div class="row g-3">

    <!-- Totales con mini-gráficos -->
    <div class="col-md-4">
        <div class="card shadow p-3 text-center">
            <h6>👤 Pacientes</h6>
            <div class="numero text-primary"><?= $totalPacientes ?></div>
            <div class="chart-container">
                <canvas id="sparkPacientes"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-3 text-center">
            <h6>📅 Citas Totales</h6>
            <div class="numero text-success"><?= $totalCitas ?></div>
            <div class="chart-container">
                <canvas id="sparkCitas"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow p-3 text-center">
            <h6>🩺 Citas Hoy</h6>
            <div class="numero text-danger"><?= $citasHoy ?></div>
            <div class="chart-container">
                <canvas id="sparkCitasHoy"></canvas>
            </div>
        </div>
    </div>

</div>

<div class="row g-3 mt-3">
    <!-- Gráficos de barras -->
    <div class="col-md-6">
        <div class="card shadow p-3">
            <h6>🧪 Citas por tipo de examen</h6>
            <div class="chart-container">
                <canvas id="chartExamen"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card shadow p-3">
            <h6>🏥 Pacientes por EPS</h6>
            <div class="chart-container">
                <canvas id="chartEPS"></canvas>
            </div>
        </div>
    </div>
</div>

<script>
// Mini-gráficos sparkline
const last7 = <?= json_encode($last7Days) ?>;
const trendP = <?= json_encode(array_values($trendPacientes)) ?>;
const trendC = <?= json_encode(array_values($trendCitas)) ?>;
const trendCHoy = <?= json_encode(array_values($trendCitasHoy)) ?>;

// Sparkline Pacientes
new Chart(document.getElementById('sparkPacientes'), {
    type: 'line',
    data: { labels:last7, datasets:[{data:trendP, borderColor:'rgba(54,162,235,1)', backgroundColor:'rgba(54,162,235,0.2)', tension:0.3, fill:true, pointRadius:0}]},
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{x:{display:false},y:{display:false}}}
});

// Sparkline Citas Totales
new Chart(document.getElementById('sparkCitas'), {
    type: 'line',
    data: { labels:last7, datasets:[{data:trendC, borderColor:'rgba(40,167,69,1)', backgroundColor:'rgba(40,167,69,0.2)', tension:0.3, fill:true, pointRadius:0}]},
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{x:{display:false},y:{display:false}}}
});

// Sparkline Citas Hoy
new Chart(document.getElementById('sparkCitasHoy'), {
    type: 'line',
    data: { labels:last7, datasets:[{data:trendCHoy, borderColor:'rgba(220,53,69,1)', backgroundColor:'rgba(220,53,69,0.2)', tension:0.3, fill:true, pointRadius:0}]},
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{x:{display:false},y:{display:false}}}
});

// Citas por examen
const examenLabels = <?= json_encode(array_keys($tiposExamen)) ?>;
const examenData = <?= json_encode(array_values($tiposExamen)) ?>;
new Chart(document.getElementById('chartExamen'), {
    type:'bar',
    data:{ labels:examenLabels, datasets:[{label:'Citas', data:examenData, backgroundColor:'rgba(54,162,235,0.6)', borderColor:'rgba(54,162,235,1)', borderWidth:1 }]},
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true, precision:0}}}
});

// Pacientes por EPS
const epsLabels = <?= json_encode(array_keys($pacientesEPS)) ?>;
const epsData = <?= json_encode(array_values($pacientesEPS)) ?>;
new Chart(document.getElementById('chartEPS'), {
    type:'bar',
    data:{ labels:epsLabels, datasets:[{label:'Pacientes', data:epsData, backgroundColor:'rgba(255,159,64,0.6)', borderColor:'rgba(255,159,64,1)', borderWidth:1 }]},
    options:{responsive:true, plugins:{legend:{display:false}}, scales:{y:{beginAtZero:true, precision:0}}}
});
</script>

</body>
</html>