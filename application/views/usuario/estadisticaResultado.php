<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$dataTest = $this->session->userdata('dataTest');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
//var_dump($dataTest);
foreach ($dataTest as $test) {
  echo "[new Date('".$test['t_fecha']."'),".$test['t_ansiedadpuntos'].",".$test['t_depresionpuntos'].",".$test['t_estrespuntos']."],";
}  
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Asistente AEE</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href= "<?php echo base_url();?>assets/css/bootstrap.min.css">
     <!--Import Google Icon Font-->
     <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/materialize.min.css"  media="screen,projection"/>
      <!-- Estilos -->
      <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>assets/css/style.css"  media="screen,projection"/>
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['line']});
      google.charts.setOnLoadCallback(drawChart);

    function drawChart() {

      var data = new google.visualization.DataTable();
      data.addColumn('date', 'Pruebas realizadas');
      data.addColumn('number', 'Ansiedad');
      data.addColumn('number', 'Depresion');
      data.addColumn('number', 'Estres');

      data.addRows([<?php 
        foreach ($dataTest as $test) {
          echo "[new Date('".$test['t_fecha']."'),".$test['t_ansiedadpuntos'].",".$test['t_depresionpuntos'].",".$test['t_estrespuntos']."],";
        } 
      ?>
      ]);

      var options = {
        chart: {
          title: 'Asistente de Ansiedad Estres y Depresion',
          subtitle: 'Resultados de Prueba DASS-21'
        },
        width: 900,
        height: 500,
        series: {
          0: {targetAxisIndex: 0}
        },
        vAxes: {
          // Adds titles to each axis.
          0: {title: 'Escala Likter'},
          minValue: 0,
          minValue:21
        },
         hAxis: {
          title: "Dias"
        }, 
      };

      var chart = new google.charts.Line(document.getElementById('line_top_x'));

      chart.draw(data, google.charts.Line.convertOptions(options));
    }
  </script>
</head>
<body>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper">
            <a href="#" class="brand-logo">Logo</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?php echo site_url();?>registrar/resultadoUsuarioAEE">Ultimo resultado</a></li>
                <li><a href="#">Doctor</a></li>
                <li><a href="badges.html">Registrate</a></li>
                <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
            </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <div class="col l12">
                <div id="line_top_x"></div>
            </div>
        </div>
    </div>



