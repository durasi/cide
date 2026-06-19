/**
 * Off-canvas mobile menu for Cide theme.
 */
( function() {
	var toggle = document.querySelector( '.menu-toggle' );
	var nav = document.querySelector( '.main-navigation' );
	var overlay = document.querySelector( '.cide-menu-overlay' );
	var closeBtn = document.querySelector( '.menu-close' );

	if ( ! toggle || ! nav ) {
		return;
	}

	function openMenu() {
		nav.classList.add( 'toggled' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		if ( overlay ) {
			overlay.classList.add( 'is-active' );
		}
		document.body.style.overflow = 'hidden';
	}

	function closeMenu() {
		nav.classList.remove( 'toggled' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		if ( overlay ) {
			overlay.classList.remove( 'is-active' );
		}
		document.body.style.overflow = '';
	}

	toggle.addEventListener( 'click', function() {
		if ( nav.classList.contains( 'toggled' ) ) {
			closeMenu();
		} else {
			openMenu();
		}
	} );

	if ( overlay ) {
		overlay.addEventListener( 'click', closeMenu );
	}
	if ( closeBtn ) {
		closeBtn.addEventListener( 'click', closeMenu );
	}

	document.addEventListener( 'keydown', function( e ) {
		if ( 'Escape' === e.key && nav.classList.contains( 'toggled' ) ) {
			closeMenu();
		}
	} );
}() );
