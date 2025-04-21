<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//----Rutas para CLIENTES -------------------------------------------------------------------------------------
Route::group(['middleware'=>['auth', 'client']], function (){
	

//----Rutas para empleado -------------------------------------------------------------------------------------
	Route::group(['middleware'=>['auth', 'employ']], function (){
		
		/*Rutas a Controlador Partido*/
		Route::get('partido/{idp}', 'PartidoController@create')->name('partido.create');
		Route::post('partido', 'PartidoController@store')->name('partido.store');
		
		/*Rutas a Controlador Fixture*/
		Route::post('fixture/inicial', 'FixtureController@primeraRonda')->name('fixture.primeraRonda');
		Route::post('fixture/instancias', 'FixtureController@instancias')->name('fixture.instancias');
		Route::get('fixture/show/{idt}', 'FixtureController@show')->name('fixture.show');
		Route::get('fixture/torneo/{idt}', 'FixtureController@create')->name('fixture.create');
		Route::post('fixture/torneo/category/end', 'FixtureController@finalizar_categoria')->name('fixture.finalizar_categoria');		

		/*Rutas para TorneoController*/
		Route::resource('torneo', 'TorneoController', ['except' => 'show', 'index']);
		
		Route::get('torneo/modificar/categoria/{id}', 'TorneoController@editar_cat')->name('torneo.editar_cat');
		Route::post('torneo/update/categoria', 'TorneoController@update_cat')->name('torneo.update_cat');

		Route::get('torneo/reserva/{id_torneo}', 'Reservas_TorneoController@create')->name('reserva_torneo.create');
		Route::post('torneo/reserva', 'Reservas_TorneoController@store')->name('reserva_torneo.store');
		Route::post('torneo/reserva/delete', 'Reservas_TorneoController@destroy')->name('reserva_torneo.destroy');		

		Route::get('torneo/{id}/agregar/categorias', 'TorneoController@create_cat')->name('torneo.create_cat');
		Route::get('torneo/{id}/editar/categorias', 'TorneoController@edit_cat')->name('torneo.edit_cat');
		Route::post('torneo/agregar/categoria', 'TorneoController@store_cat')->name('torneo.store_cat');
		Route::delete('torneo/quitar/categoria', 'TorneoController@destroy_cat')->name('torneo.destroy_cat');
		
		Route::post('torneo/confirmar', 'TorneoController@confirmar')->name('torneo.confirmar');
		Route::get('torneos/finalizados', 'TorneoController@finalizados')->name('torneo.finalizados');
		
		Route::get('/registerFinish', 'MainController@finish');
		Route::put('/registerFinish/{id}', 'MainController@update')->name('finishUpdate');

		/*Rutas a Controlador User*/
		Route::resource('users', 'UserController', ['except' => 'update']);


		/*Rutas a Controlador Reserva*/
		Route::get('reserva/consular/reservas/', 'ReservaController@consultarReservas')->name('reserva.consultarReservas');
		Route::post('reserva/finalizar/reserva/', 'ReservaController@finalizarReserva')->name('reserva.finalizarReserva');
		
		/*Rutas a Controlador Detalle Reserva*/
		Route::post('reserva/finalizar/detalle/', 'Detalle_ReservaController@finalizarDetalle')
				->name('detalle_reserva.finalizarDetalle');

	//----Rutas para encargado ------------------------------------------------------------------------------------
			Route::group(['middleware'=>['auth', 'attendant']], function (){	

				/*Rutas a Controlador Servicio*/
				Route::resource('servicio', 'ServicioController');
				
				/*Rutas a Controlador Cancha*/
				Route::get('addService', 'CanchaController@addService')->name('cancha.addService');
				Route::post('storeService', 'CanchaController@storeService')->name('cancha.storeService');
				Route::get('editService/{id}', 'CanchaController@editService')->name('cancha.editService');
				Route::post('updateService', 'CanchaController@updateService')->name('cancha.updateService');

				/*Rutas a Controlador Principal*/
				Route::get('consultar/localidades', 'MainController@indexLocalidades')->name('main.indexLocalidades');

				Route::get('newCiudad', 'MainController@createCiudad')->name('main.createCiudad');
				Route::post('newCiudad', 'MainController@storeCiudad')->name('main.storeCiudad');

				Route::get('newProvincia', 'MainController@createProvincia')->name('main.createProvincia');
				Route::post('newProvincia', 'MainController@storeProvincia')->name('main.storeProvincia');

				Route::get('newPais', 'MainController@createPais')->name('main.createPais');
				Route::post('newPais', 'MainController@storePais')->name('main.storePais');
				
				/* Rutas para los reportes*/
				Route::get('cant/res/can/fec', 'InformesController@crcf')->name('informe.crcf');
				Route::get('cant/res/can/fec/query', 'InformesController@get_crcf')->name('informe.get_crcf');

				Route::get('cant/res/use/fec', 'InformesController@cruf')->name('informe.cruf');
				Route::get('cant/res/use/fec/query', 'InformesController@get_cruf')->name('informe.get_cruf');

				Route::get('cant/res/dia/fec', 'InformesController@crdf')->name('informe.crdf');
				Route::get('cant/res/dia/fec/query', 'InformesController@get_crdf')->name('informe.get_crdf');

				Route::get('cant/hs/fec/', 'InformesController@crhf')->name('informe.crhf');
				Route::get('cant/hs/ca/fec/', 'InformesController@crhcf')->name('informe.crhcf');
				Route::get('cant/hs/ca/fec/query', 'InformesController@get_crhf')->name('informe.get_crhf');

				Route::get('servicios/ocupados', 'InformesController@cso')->name('informe.cso');
				Route::get('servicios/ocupados/query', 'InformesController@get_cso')->name('informe.get_cso');

					//----Rutas para administrado ---------------------------------------------------------------------------------
					Route::group(['middleware'=>['auth', 'admin']], function (){

						/*Rutas a Controlador Empresa*/
						Route::get('empresa/{id}/edit', 'EmpresaController@edit')->name('empresa.edit');
						Route::put('empresa/{id}', 'EmpresaController@update')->name('empresa.update');
						Route::get('empresa/turnos', 'EmpresaController@turno_index')->name('empresa.turnos.index');
						Route::get('empresa/turnos/create', 'EmpresaController@turno_create')->name('empresa.turnos.create');
						Route::post('empresa/turnos/store', 'EmpresaController@turno_store')->name('empresa.turnos.store');
						Route::get('empresa/turnos/edit/{id}', 'EmpresaController@turno_edit')->name('empresa.turnos.edit');
						Route::post('empresa/turnos/update', 'EmpresaController@turno_update')->name('empresa.turnos.update');
						Route::post('empresa/turnos/destroy', 'EmpresaController@turno_destroy')->name('empresa.turnos.destroy');

						/*Rutas a Controlador Cancha*/
						Route::resource('cancha', 'CanchaController');

						/*Rutas a Controlador Principal*/
						Route::get('newRol', 'MainController@createRol')->name('main.createRol');
						Route::post('newRol', 'MainController@storeRol')->name('main.storeRol');
						
					});

			});

	});

	/*Rutas para VueJs y AXIOS*/
	Route::post('consultar/fecha/canchas/disponibles', 'CanchaController@getCanchas');
	Route::post('consultar/horas/disponible', 'Detalle_ReservaController@getHoras');
	//Route::get('consultar/horas/disponible/{f}/{c}/{e}', 'Detalle_ReservaController@getHoras');
	Route::post('consultar/horas/a/reservar', 'Detalle_ReservaController@getHsRes');
	Route::get('consultar/servicios/{c}', 'ServicioController@getServicios');
	Route::get('consultar/monto/{c}/{ch}', 'ServicioController@getMonto');
	/*---------------------------------------------------------------------------------*/


	Route::get('/home', 'HomeController@index')->name('home');
	

	Route::get('/registerFinish', 'MainController@finish');
	Route::put('/registerFinish/{id}', 'MainController@update')->name('finishUpdate');

	
	/*Rutas a Controlador User*/
	Route::get('editarPerfil/user/{id}/edit', 'UserController@editProfile')->name('users.editProfile');
	Route::put('user/update/{id}', 'UserController@update')->name('users.update');
	Route::get('editarPass/user', 'UserController@editPass')->name('users.editPass');
	Route::put('editarPass/{id}/user', 'UserController@updatePass')->name('users.updatePass');


	/*Rutas a Controlador Reserva*/
	Route::resource('reserva', 'ReservaController', ['except' => 'edit']);
	Route::get('reserva/user/actuales', 'ReservaController@getReservas')
			->name('reserva.misReservas');
	Route::post('reserva/confirmar/reserva/', 'ReservaController@confirmarReserva')
			->name('reserva.confirmarReserva');
	Route::get('/reserva/pdf/reserva/', 'ReservaController@pdf_reserva')
			->name('reserva.pdf_reserva');

	
	/*Rutas a Controlador Detalle_Reserva*/
	Route::get('detalle_reserva', 'Detalle_ReservaController@index')->name('detalle_reserva.index');
	Route::get('detallereserva_edit', 'Detalle_ReservaController@edit')->name('detalle_reserva.edit');
	Route::PUT('detalle_reserva', 'Detalle_ReservaController@update')->name('detalle_reserva.update');
	Route::get('detalle_reserva/asociar/servicios/{id}', 'Detalle_ReservaController@asociarServicios')
			->name('detalle_reserva.asociarServicios');
	Route::post('detalle_reserva', 'Detalle_ReservaController@store')->name('detalle_reserva.store');
	Route::delete('detalle_reserva/anular/{iddr}', 'Detalle_ReservaController@destroy')->name('detalle_reserva.destroy');
	Route::post('detalle_reserva/confirmar/detalle/', 'Detalle_ReservaController@confirmarDetalle')
			->name('detalle_reserva.confirmarDetalle');


	/*Rutas a Controlador Servicios_Requeridos*/
		
	Route::post('servicios_requeridos', 'Servicios_RequeridosController@store')->name('servicios_requeridos.store');
	Route::post('servicios_requeridos/agregar/cancha', 'Servicios_RequeridosController@addCancha')
				->name('servicios_requeridos.storeCancha');
	Route::delete('servicios_requeridos/{s}/{dr}/{e}', 'Servicios_RequeridosController@destroy')
				->name('servicios_requeridos.destroy');
	Route::get('servicios_requeridos/editar/servicios/{id}', 'Servicios_RequeridosController@editarServicios')
				->name('servicios_requeridos.editarServicios');
	
	/*Rutas a Controlador Jugadores*/
	Route::get('jugadores/{iddr}', 'JugadoresController@create')->name('jugadores.create');
	Route::get('jugadores/participantes/{iddr}', 'JugadoresController@create1')->name('jugadores.create1');
	Route::get('addUser/{idus}/{iddr}/{flag}/add', 'JugadoresController@addUser')->name('jugadores.addUser');
	Route::DELETE('delUser/{idju}/{iddr}/{flag}/del', 'JugadoresController@delUser')->name('jugadores.delUser');
	
	Route::get('/jugadores/avisar/juego/{idr}', 'JugadoresController@avisarJugadores')
			->name('jugadores.avisarJugadores');
	
	Route::get('/jugadores/avisar/juego/{iddr}/edit', 'JugadoresController@avisarJugadores1')
			->name('jugadores.avisarJugadores1');

	Route::get('/jugadores/juegos/invitaciones', 'JugadoresController@getJuegos')->name('jugadores.getJuegos');
	
	Route::post('/jugadores/aconfirmar/juego/', 'JugadoresController@confirmarJuego')->name('jugadores.confirmarJuego');
	Route::post('/jugadores/cancelar/juego/', 'JugadoresController@cancelarJuego')->name('jugadores.cancelarJuego');
	Route::post('/jugadores/anular/invitacion/', 'JugadoresController@anularInvitacion')->name('jugadores.anularInvitacion');


	/*Rutas a InscripcionesCOntroller */
	Route::resource('inscripciones', 'InscripcionesController', ['except' => 'update', 'edit']);

	/*Rutas para TorneoController*/
	Route::get ('torneo', 'TorneoController@index')->name('torneo.index');
	Route::get ('torneo/{id}', 'TorneoController@show')->name('torneo.show');
	Route::get ('torneo/end/{id}', 'TorneoController@show_end')->name('torneo.show_end');
	Route::get ('torneo/avisar/{idtor}/{ideq}', 'InscripcionesController@avisarTorneo')->name('torneo.avisar');
	Route::get('torneos/finalizados', 'TorneoController@finalizados')->name('torneo.finalizados');
	Route::get('torneo/pdf/{idt}/{idct}', 'TorneoController@torneo_pdf')->name('torneo.pdf');

	/*Rutas a Controlador Fixture*/
	Route::get('fixture/show/{idt}', 'FixtureController@show')->name('fixture.show');
	Route::get('fixture/fixture/{idt}', 'FixtureController@fixture')->name('fixture.fixture');

	/*Rutas a Controlador Ranking*/
	Route::get('ranking', 'RankingController@index')->name('ranking.index');
	Route::get('ranking/pdf/xcat', 'RankingController@pdf_x_categoria')
			->name('ranking.pdf_x_categoria');
	
	/*Rutas a Controlador Equipo*/
	Route::resource('equipo', 'EquipoController');
	
	/*Rutas a MiEquipoCOntroller */
	Route::get('mi/equipo', 'MiEquipoController@create')->name('miequipo.create');
	Route::post('mi/equipo', 'MiEquipoController@store')->name('miequipo.store');
	Route::delete('mi/equipo/quitar/judagor', 'MiEquipoController@quitar_jugador')->name('miequipo.quitar.jugador');
	Route::get('mi/equipo/{id}', 'MiEquipoController@show')->name('miequipo.show');


	/*Rutas a Controlador Partido*/
	Route::get('partido/show/{idp}', 'PartidoController@show')->name('partido.show');
	
});
Route::group(['middleware'=>['auth', 'auditor']], function (){

	/*Rutas a Controlador Auditorias*/
    Route::get('auditoria', 'AuditoriasController@index')->name('auditoria.index');
    Route::get('auditoria/show/{id}', 'AuditoriasController@show')->name('auditoria.show');
    Route::get('auditoria/pdf/{id}', 'AuditoriasController@pdf')->name('auditoria.pdf');	

	Route::get('auditoria/empresa', 'AuditoriasController@empresa')->name('auditoria.empresa');
	Route::get('auditoria/empresa/movimiento/{id}', 'AuditoriasController@empresa_movimiento')
			->name('auditoria.empresa.movimiento');
	Route::get('auditoria/empresa/movimiento/pdf/{id}', 'AuditoriasController@empresa_movimiento_pdf')
			->name('auditoria.empresa.movimiento.pdf');
			/*-------------------------*/
	Route::get('auditoria/torneo', 'AuditoriasController@torneo')->name('auditoria.torneo');
	Route::get('auditoria/torneo/movimiento/{id}', 'AuditoriasController@torneo_movimiento')
			->name('auditoria.torneo.movimiento');
	Route::get('auditoria/torneo/movimiento/pdf/{id}', 'AuditoriasController@torneo_movimiento_pdf')
			->name('auditoria.torneo.movimiento.pdf');
			/*-------------------------*/
	Route::get('auditoria/reserva', 'AuditoriasController@reserva')->name('auditoria.reserva');
	Route::get('auditoria/reserva/movimiento/{id}', 'AuditoriasController@reserva_movimiento')
			->name('auditoria.reserva.movimiento');
	Route::get('auditoria/reserva/movimiento/pdf/{id}', 'AuditoriasController@reserva_movimiento_pdf')
			->name('auditoria.reserva.movimiento.pdf');
});