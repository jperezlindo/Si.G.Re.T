<script>
	function val_tel(){

		var input = document.getElementById("tel");

		var ex_tel = /^(?:(?:00)?549?)?0?(?:11|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/;

		if (ex_tel.test(input.value)){
			document.getElementById("error_tel").innerHTML="";
			var res = true;
		}else{
			document.getElementById("error_tel").innerHTML="FORMATO DE TELEFONO NO VALIDO";
			input.focus();
			input.value = "";
			var res = false;
		}

		return ;
	}

	function val_cel(){

		var input = document.getElementById("cel");

		var ex_cel = /^(?:(?:00)?549?)?0?(?:11|[2368]\d)(?:(?=\d{0,2}15)\d{2})??\d{8}$/;

		if (ex_cel.test(input.value)){
			document.getElementById("error_cel").innerHTML="";
			var res = true;
		}else{
			document.getElementById("error_cel").innerHTML="FORMATO DE CELULAR NO VALIDO";
			input.focus();
			input.value = "";
			var res = false;
		}

		return ;
	}

	function val_dni(){

		var input = document.getElementById("dni");

		var ex_cel = /^\d{8}(?:[-\s]\d{4})?$/;

		if (ex_cel.test(input.value)){
			document.getElementById("error_dni").innerHTML="";
			var res = true;
		}else{
			document.getElementById("error_dni").innerHTML="FORMATO DNI NO VALIDO";
			input.focus();
			input.value = "";
			var res = false;
		}

		return ;
	}

	function hora_partido(){

		var ini = document.getElementById("ini");
		var fin = document.getElementById("fin");

		if (fin.value <= ini.value){
			document.getElementById("error_fin").innerHTML="LA HORA DE FINALIZACION DEBE SER MAYOR A LA DE INICIO";
			fin.focus();

		}else{
			document.getElementById("error_fin").innerHTML="";
		}

		return;

	}

</script>