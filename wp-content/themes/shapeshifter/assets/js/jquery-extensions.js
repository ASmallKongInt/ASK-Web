jQuery.fn.extend({
	exists: function() { 
		return Boolean( this.length > 0 ); 
	},
	animateCss: function( animationName ) {
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		jQuery( this ).addClass( 'animated ' + animationName ).one( animationEnd, function() {
			jQuery( this ).removeClass( 'animated ' + animationName );
		});
	},
	animateCssEnter: function( animationName ) {
		jQuery( this ).removeClass( 'shapeshifter-hidden' );
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		jQuery( this ).addClass( 'animated ' + animationName ).one( animationEnd, function() {
			jQuery( this ).removeClass( 'animated ' + animationName );
		});
	},
	animateCssExit: function( animationName ) {
		var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
		jQuery( this ).addClass( 'shapeshifter-hidden animated ' + animationName ).one( animationEnd, function() {
			jQuery( this ).removeClass( 'animated ' + animationName );
		});
	},
});