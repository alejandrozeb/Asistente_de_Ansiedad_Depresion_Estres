<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$idPer_sesion = $this->session->userdata('persona');
$idUsu_sesion = $this->session->userdata('usuario');
$dataTest = $this->session->userdata('data');
if($idPer_sesion==null || $idUsu_sesion==null){
    redirect('registrar/ingresaUsuario','refresh');
}
var_dump($dataTest);
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
      data.addColumn('date', 'Month');
      data.addColumn('number', 'Ansiedad');
      data.addColumn('number', 'Depresion');
      data.addColumn('number', 'Estres');

      data.addRows([
        [new Date(2014, 0),  37.8, 80.8, 41.8],
        [new Date(2014, 1),  30.9, 69.5, 32.4],
        /* [new Date(2014, 2),  25.4,   57, 25.7],
        [new Date(2014, 3),  11.7, 18.8, 10.5],
        [new Date(2014, 4),  11.9, 17.6, 10.4],
        [new Date(2014, 5),   8.8, 13.6,  7.7],
        [new Date(2014, 6),   7.6, 12.3,  9.6],
        [new Date(2014, 7),  12.3, 29.2, 10.6],
        [new Date(2014, 8),  16.9, 42.9, 14.8],
        [new Date(2014, 9), 12.8, 30.9, 11.6],
        [new Date(2014, 10),  5.3,  7.9,  4.7],
        [new Date(2014, 11),  6.6,  8.4,  5.2],
        [new Date(2014, 12),  4.8,  6.3,  3.6],
        [new Date(2015, 0),  4.2,  6.2,  3.4] */
      ]);

      var options = {
        chart: {
          title: 'Box Office Earnings in First Two Weeks of Opening',
          subtitle: 'in millions of dollars (USD)'
        },
        width: 900,
        height: 500,
        series: {
          0: {targetAxisIndex: 0}
        },
        vAxes: {
          // Adds titles to each axis.
          0: {title: 'Temps (Celsius)'}
        },
        hAxis: {
          ticks: [new Date(2014, 0), new Date(2014, 1), new Date(2014, 2), new Date(2014, 3),
                  new Date(2014, 4),  new Date(2014, 5), new Date(2014, 6), new Date(2014, 7),
                  new Date(2014, 8), new Date(2014, 9), new Date(2014, 10), new Date(2014, 11)
                 ]
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



