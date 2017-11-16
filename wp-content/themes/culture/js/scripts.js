/*---------------------------------------------------------------*/
/*--------- CULTURE : REQUIRED CUSTOM JQUERY SCRIPTS ------------*/
/*---------------------------------------------------------------*/

// SITE MENU + MOBILE  MENU SCRIPT
//---------------------------------------------------------------
(function( jQuery ) {
	jQuery.fn.cultureMobMenu = function( options ) { 
		var defaults = {
			'activewidth': 1024
		};
		//call in the default otions
		var options = jQuery.extend(defaults, options);
		var obj     = jQuery(this);
		var mobactive = true;
		
		return this.each(function() {
			if(jQuery(window).width() <= options.activewidth) {
				cmsMobRes();
			}else{
				cmsDeskRes();
			}
			
			jQuery(window).resize(function() {
				if(jQuery(window).width() <= options.activewidth) {
					if(mobactive){
						cmsMobRes();
					}
				}else{
					cmsDeskRes();
				}
			});
			function cmsMobRes() {
				mobactive = false;
				jQuery('#main-nav').superfish('destroy');
				obj.addClass('mobile-menu-active').hide();
				obj.parent().css('position','relative');
				if(obj.prev('.mobmenu-toggle').length === 0) {
					obj.before('<div class="fa fa-bars mobmenu-toggle" id="mobmenu-toggle"></div>');
				}
				obj.parent().find('.mobmenu-toggle').removeClass('active');
			}
			function cmsDeskRes() {
				mobactive = true;
				jQuery('#main-nav').superfish('init');
				obj.removeClass('mobile-menu-active').show();
				if(obj.prev('.mobmenu-toggle').length) {
					obj.prev('.mobmenu-toggle').remove();
				}
			}
			obj.parent().on('click','.mobmenu-toggle',function() {
				if(!jQuery(this).hasClass('active')){
					jQuery(this).addClass('active');
					jQuery(this).next('ul').stop(true,true).fadeIn(300);
				}
				else{
					jQuery(this).removeClass('active');
					jQuery(this).next('ul').stop(true,true).fadeOut(300);
				}
			});
		});
	};
})( jQuery );

// MOBILE NAVIGATION ACTIVATION FUNCTION
jQuery('document').ready(function(){
	jQuery('#main-nav').cultureMobMenu({'activewidth':object_name.activewidth});
});

// HEADER STICKY SCRIPT
if(object_name.header_sticky == 'on')
{
	jQuery(window).load(function(){
		if( jQuery(window).width() > 1024 ){
			if(jQuery('#header .header-nav').length > 0){
				if(jQuery('body.admin-bar').length > 0){
					jQuery("#header .header-nav").sticky({ topSpacing: 32 });
				}else{
					jQuery("#header .header-nav").sticky({ topSpacing: 0 });
				}
			}
		}
	});
}