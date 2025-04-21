<div class="Container">
  <section class="titulo row">
    <article class="col-xs-12 col-sm-12 col-md-12">
      <h1 class="text-center">Aviso de Torneo en {{ Auth::user()->user_empresa->empresa->name }}</h1>
    </article>
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
      <h2>Tu equipo se inscribio al torneo
		  <strong>{{$data['name']}}, que se realizara desde el: {{$data['inicia']}} hasta el: {{$data['finaliza']}}</strong>, a las <strong> {{$data['hora']}} hs. Valor de la Inscripcion: {{$data['valor']}}</strong>.Gracias por tu participacion...
      </h2>
    </div>
  </section>
</div>
<br>
