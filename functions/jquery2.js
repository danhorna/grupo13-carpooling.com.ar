function mostrar(id) {
	if (id == "estudiante") {
		$("#estudiante").show();
		$("#trabajador").hide();
		$("#autonomo").hide();
		$("#paro").hide();
	}
	
	if (id == "trabajador") {
		$("#estudiante").hide();
		$("#trabajador").show();
		$("#autonomo").hide();
		$("#paro").hide();
	}
	
	if (id == "autonomo") {
		$("#estudiante").hide();
		$("#trabajador").hide();
		$("#autonomo").show();
		$("#paro").hide();
	}
	
	if (id == "paro") {
		$("#estudiante").hide();
		$("#trabajador").hide();
		$("#autonomo").hide();
		$("#paro").show();
	}
}