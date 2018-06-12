function validacion() {
origen = document.getElementById("origen").value;
if( origen == null || origen.length == 0 || /^\s+$/.test(origen) ) {
	alert('ERROR: El campo origen no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

destino = document.getElementById("destino").value;
if( destino == null || destino.length == 0 || /^\s+$/.test(destino) ) {
	alert('ERROR: El campo destino no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

duracion = document.getElementById("duracion").value;
if(duracion == null || duracion.length == 0 || isNaN(duracion)){
	alert('ERROR: Debe ingresar la duracion');
	return false;
}

costo = document.getElementById("costo").value;
if(costo == null || costo.length == 0 || isNaN(costo)){
	alert('ERROR: Debe ingresar el costo');
	return false;
}


}