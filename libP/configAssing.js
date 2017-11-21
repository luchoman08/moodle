/**
*@author Hernán Darío Arango C
*@email hernan.arango@correounivalle.edu.co
*creamos el archivo config para que el scroll horizontal funcione solamente con la clase .gradeparent
*/
$(document).ready(function() {
	/*$('#prueba').mousewheel(function(e, delta) {
		this.scrollLeft -= (delta * 40);
		e.preventDefault();
	});*/

	$('.no-overflow').on('mousewheel',function(event, delta) {
		console.log("mouse-")
		this.scrollLeft -= (delta * 40);
		event.preventDefault();
	});
});
