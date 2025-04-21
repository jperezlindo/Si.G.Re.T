<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['horas', 'Horas'],
          @foreach ($horas as $i => $hora)
          	['{{$i}} hs.', {{$hora}}],
          @endforeach

        ]);

		var options = {
           bar: {groupWidth: '90%'},
		};

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
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
  </body>
</html>