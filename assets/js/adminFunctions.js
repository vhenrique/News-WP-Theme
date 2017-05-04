$ = jQuery.noConflict();
$( document ).ready( function() {

	// Export newsletter
	$( '#menu-users .wp-submenu li' ).last().click( function( a ){
		a.preventDefault(),
		$.ajax({
			url		: $('.tableExport').val(),
			error 	: function(){
				alert("Tempo limite excedido.");
			},
			success 	: function(){
				window.location.replace( $('.tableExport').val() );
			}
		})
	})
})