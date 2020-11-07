<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idDoc_sesion = $this->session->userdata('doctor');
$dataTest = $this->session->userdata('dataTest');
if($idPer_sesion==null || $idDoc_sesion==null){
    redirect('doctorr/ingresaDoctor','refresh');
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
          echo "[new Date('".$test['t_fecha']."T00:00:00'),".$test['t_ansiedadpuntos'].",".$test['t_depresionpuntos'].",".$test['t_estrespuntos']."],";
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
            <a href="#" class="brand-logo">AsistenteAEE</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
                <li><a href="<?php echo site_url();?>doctor/resultadosDoctor">Pagina Principal</a></li>
                <li><a href="<?php echo site_url();?>registrar/logoutUsuario">LogOut</a></li>
            </ul>
            </div>
        </nav>
    </div>

    <div class="container">
        <div class="row">
            <h2>Resultados</h2>
            <div class="col l12">
                <div id="line_top_x"></div>
            </div>
        </div>
    </div>
    <div class="container">
      <div class="row">
        <h4>Detalle de Resultados</h4>
        <table class="highlight reponsive-table">
        <thead>
          <tr>
              <th>Fecha</th>
              <th>Ansiedad</th>
              <th>Depresion</th>
              <th>Estres</th>
          </tr>
        </thead>

        <tbody>
        <?php
              foreach ($dataTest as $test) {
        ?>
          <tr>
            <td><?php echo $test['t_fecha'];?></td>
            <td><?php echo $test['t_ansiedadpuntos'];?></td>
            <td><?php echo $test['t_depresionpuntos'];?></td>
            <td><?php echo $test['t_estrespuntos'];?></td>
          </tr>
        <?php
              }
        ?>
        </tbody>
      </table>
      </div>
<!--       <div class="row">
        <h4>Detalle de Resultados por Test</h4>
      </div> -->
    </div>



