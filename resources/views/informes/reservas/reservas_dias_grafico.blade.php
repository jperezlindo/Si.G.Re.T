<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Dias', 'DOMINGO', 'LUNES', 'MARTES', 'MIERCOLES', 'JUEVES', 'VIERNES', 'SABADO'],
          [ '...',{{$dias[0]}}, {{$dias[1]}}, {{$dias[2]}}, {{$dias[3]}}, {{$dias[4]}}, {{$dias[5]}}, {{$dias[6]}}],
        ]);

        var options = {
          chart: {
            title: '',
            subtitle: 'Cantidad',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group text-center">
          <div class="form-group text-center">
            <h3>FECHA INFORME desde: <b>{{$desde->format('d-m-Y')}}</b>, hasta: <b>{{$hasta->format('d-m-Y')}}</b></h3>
          </div>
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="columnchart_material" style="width: 100%; max-width:1000px; height: 500px; "></div>
      </div>
    </div>    
  </body>
</html>