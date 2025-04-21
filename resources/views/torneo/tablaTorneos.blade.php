  <div class="row">
    <div class="col-xs-12 col-sm-12 col-md-10 col-md-offset-1">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead class="">
            <td class="active text-left"><strong>Torneo</strong></td>
            <td class="active text-left"><strong>Desde</strong></td>
            <td class="active text-left"><strong>Hasta</strong></td>
            <td class="active text-left"><strong>Hora Inicio</strong></td>
            <td class="active text-left"><strong>Inicia Inscripcion</strong></td>
            <td class="active text-left"><strong>Finaliza Inscripcion</strong></td>
            <td class="active text-center" colspan="4"><strong>Acciones</strong></td>
          </thead>
          @foreach ($torneos as $torneo)
          <tbody>
            <tr>
              <td class = "success text-left"><b>{{$torneo->name}}</b></td>
              <td class = "success text-left">{{$torneo->f_desde->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$torneo->f_hasta->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$torneo->hora}} hs.</td>
              <td class = "success text-left">{{$torneo->ini_ins->format('d/m/Y')}}</td>
              <td class = "success text-left">{{$torneo->fin_ins->format('d/m/Y')}}</td>
              
              <td class = "success text-center" title="VER TORNEO">
                <a href="{{route('torneo.show', $torneo->id)}}" class="btn btn-info btn-xs">
                  <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                </a>
              </td>
            @if (Auth::user()->rol() < 4)
              <td class = "success text-left" title="ENTRAR TORNEO">
                <a href="{{route('fixture.create', $torneo->id)}}" class="btn btn-success btn-xs">
                  <span class="glyphicon glyphicon-forward" aria-hidden="true"></span>
                </a>          
              </td>              
              <td class = "success text-right" title="EDITAR AL TORNEO">
                <a href="{{route('torneo.edit', $torneo->id)}}" class="btn btn-warning btn-xs">
                  <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                </a>
              </td>
              <td class = "success text-right" title="DAR DE BAJA EL TORNEO">
                <form action="{{route('torneo.destroy', $torneo->id)}}" method="POST"> 
                  <a data-toggle="modal" data-target="#torneoDestroy_{{ $torneo->id }}" class="btn btn-danger btn-xs">
                  <span class=" glyphicon glyphicon-remove" aria-hidden="true"></span>
                  </a>
                  @include('torneo.modals.torneoDestroy')
                </form>
              </td>          
            @endif
            </tr>
          </tbody>  
          @endforeach
        </table>
      </div>
    </div>
  </div>