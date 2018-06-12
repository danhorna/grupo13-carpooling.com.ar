function mostrar(id) {
	if (id == "Ocasional") {
		$("#Seleccione").hide();
		$("#Ocasional").show();
		$("#Semanal").hide();
		$("#Diario").hide();
	}
	
	if (id == "Semanal") {
		$("#Seleccione").hide();
		$("#Ocasional").hide();
		$("#Semanal").show();
		$("#Diario").hide();
	}
	
	if (id == "Diario") {
		$("#Seleccione").hide();
		$("#Ocasional").hide();
		$("#Semanal").hide();
		$("#Diario").show();
	}
	
	if (id == "Seleccione") {
		$("#Seleccione").show();
		$("#Ocasional").hide();
		$("#Semanal").hide();
		$("#Diario").hide();
	}
}