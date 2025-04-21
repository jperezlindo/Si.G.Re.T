@if (Auth::user()->id == $us->id)
	<label for="">Imagen de Perfil</label>
	<input type="file" name="foto" id="foto" accept="image/*">
@endif