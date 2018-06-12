function validacion() {
marca = document.getElementById("marca").value;
if( marca == null || marca.length == 0 || /^\s+$/.test(marca) ) {
	alert('ERROR: El campo marca no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

modelo = document.getElementById("modelo").value;
if( modelo == null || modelo.length == 0 || /^\s+$/.test(modelo) ) {
	alert('ERROR: El campo modelo no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

patente = document.getElementById("patente").value;
if( patente == null || patente.length == 0 || /^\s+$/.test(patente) ) {
	alert('ERROR: El campo patente no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

asientos = document.getElementById("asientos").value;
if(asientos == null || asientos.length == 0 || isNaN(asientos)){
	alert('ERROR: Debe ingresar la cantidad de asientos');
	return false;
}

color = document.getElementById("color").value;
if( color == null || color.length == 0 || /^\s+$/.test(color) ) {
	alert('ERROR: El campo color no debe ir vacio o lleno de solamente espacios en blanco');
	return false;
}

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