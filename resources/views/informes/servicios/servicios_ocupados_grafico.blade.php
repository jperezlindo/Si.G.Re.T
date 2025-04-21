<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Servicios', 'Contratados'],
          @foreach ($servicios as $servicio => $cant)
            ['{{$servicio}}', {{$cant}}],
          @endforeach
        ]);

        var options = {
          is3D: true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div class="row">
      <div class="col-xs-12 col-sm-12 col-md-8 col-md-offset-2">
        <div class="form-group text-center">
          <h3><b>INFORME desde: {{$desde->format('d-m-Y')}}, hasta: {{$hasta->format('d-m-Y')}}</b></h3>
        </div>
      </div>
    </div>  
    <div class="row">
      <div class="col-md-8 col-md-offset-2">
        <div id="piechart" style="width: 100%; max-width:1000px; height: 500px; "></div>
      </div>
    </div>
    <hr>    
  </body>
</html>