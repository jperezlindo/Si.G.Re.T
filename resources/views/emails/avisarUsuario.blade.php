<div class="Container">
  <section class="titulo row">
    <article class="col-xs-12 col-sm-12 col-md-12">
      <h1 class="text-center">Aviso de Juego en {{ Auth::user()->user_empresa->empresa->name }}</h1>
    </article>
    <div class="col-xs-12 col-sm-10 col-md-10 col-md-offset-1">
      <h2>Te agregaron como participante a un juego el dia <strong>{{$data['fecha']}},</strong>, a las <strong> {{$data['hora']}}:00 hs.</strong> . Por favor ingresa a tu perfil en Si.G.Re.T y confirma tu participacion. Gracias...</h2>
    </div>
  </section>
</div>
<br>
