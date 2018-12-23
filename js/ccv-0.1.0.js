/**
 *	Masked CCV plugin for jQuery (http://bridge-belarus.org/Misc/ccv/ccv.html)
 *	Copyright (c) 2010 Yauhen Kutsuk (jauhen@gmail.com)
 *	Licensed under the MIT license	
 *	Version: 0.1.0 (10/13/2010 12:26:06)
 *	Masked Input plugin for jQuery is needed to run
 */
(function($) {
	
	$.ccv = {
		//Predefined cards mask
		amex : '3999 9999 9999 999',
		visa : '4999 9999 9999 9999',
		mc : '5999 9999 9999 9999',
		dc : '9999 9999 9999 99?99',
		cup : '6999 9999 9999 9999?999'
	};
	
	$.fn.extend ({
		ccv : function (type) {
			
			$.mask.definitions['3']='[3]';
			$.mask.definitions['4']='[4]';
			$.mask.definitions['5']='[5]';
			$.mask.definitions['6']='[6]';
						
			var pass = $(this[0]);
			var text = null;
		
			var ieChange = function(ev) {
				if ( event.propertyName == "value" ) {
					text.unbind ( "propertychange" ) .change();
				}
			}
			if ( $.browser.msie ) {
				var htm = this[0].outerHTML.replace ( "password", "text" );
				text = $( htm ).val( pass.val() ).bind( "propertychange", ieChange );
				pass.closest( "form" ).submit( function() {
					text.attr ( "disabled", "disabled" );
				});
			} else {
				text = pass.clone().attr( "type", "text" );
			}
			
			text.attr ( "autocomplete", "off" ).removeAttr( "name" );
			pass.removeAttr ( "id" );

			pass.before( text ).hide ();	
			
			text.bind( "focus", unmaskccv ).mask ( type );
			
			function maskccv() {
				var value = text.val();
				for ( var i = 0 ; i < value.length ; i++ ) {
					if ( value [i] == '\u25CF' ) {
						value = value.substr ( 0, i ) + value.substr ( i );
					}
				}
				
				pass.val ( value.replace( /\s/g, '' ) ); 
				
				value = value.substr( 0, 15 ).replace( /\d/g, '\u25CF' ).concat( value.substr ( 15 ) );
				
				text.val ( value );
			}
			
			function unmaskccv () {
				text.val ( pass.val () );
			}
			
			maskccv ();
			
			text.bind ( "blur", maskccv );
			
			text.bind ( "setmask", function ( e, newmask ) {
				text.unmask ();
				text.unbind ( "blur", maskccv );
				text.mask ( newmask );
				maskccv ();
				text.bind( "blur", maskccv );
			});
		},
		
		newccv : function (newmask) {
			$(this).trigger( "setmask", newmask );
		}
	});
	
})(jQuery);