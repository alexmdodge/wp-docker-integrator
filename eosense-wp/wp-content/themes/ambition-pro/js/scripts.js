jQuery( function() {
		// Search toggle.
		jQuery( '.search-toggle' ).on( 'click', function( event ) {
			var that    = jQuery( this ),
				wrapper = jQuery( '#search-box' );
			that.toggleClass( 'active' );
			wrapper.toggleClass( 'hide' );
			if ( that.is( '.active' ) || jQuery( '.search-toggle' )[0] === event.target ) {
				wrapper.find( '.s' ).focus();
			}
		} );
		// Enable menu toggle for small screens.
		( function() {
			var nav = jQuery( '.main-navigation' ), button, menu;
			if ( ! nav ) {
				return;
			}
			button = nav.find( '.menu-toggle' );
			if ( ! button ) {
				return;
			}
			// Hide button if menu is missing or empty.
			menu = nav.find( '.nav-menu' );
			if ( ! menu || ! menu.children().length ) {
				button.hide();
				return;
			}
			jQuery( '.menu-toggle' ).on( 'click', function() {
				nav.toggleClass( 'toggled-on' );
			} );
		} )();
} );

jQuery(document).ready(function(){
	// hide #back-top first
	jQuery(".back-to-top").hide();
	// fade in #back-top
	jQuery(function () {
		jQuery(window).scroll(function () {
			if (jQuery(this).scrollTop() > 1000) {
				jQuery('.back-to-top').fadeIn();
			} else {
				jQuery('.back-to-top').fadeOut();
			}
		});
		// scroll body to 0px on click
		jQuery('.back-to-top a').click(function () {
			jQuery('body,html,header').animate({
				scrollTop: 0
			}, 800);
			return false;
		});
	});
});
