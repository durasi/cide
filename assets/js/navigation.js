/**
 * Off-canvas mobile menu for Cide theme.
 */
( function() {
	var toggle = document.querySelector( '.menu-toggle' );
	var nav = document.querySelector( '.main-navigation' );
	var overlay = document.querySelector( '.cide-menu-overlay' );

	if ( ! toggle || ! nav ) {
		return;
	}

	var menuList = nav.querySelector( 'ul' );
	var placeholder = null;

	// The site header uses backdrop-filter, which creates a containing block
	// that traps position:fixed descendants. Move the menu list to <body> when
	// open so the off-canvas drawer is positioned against the viewport.
	function detachList() {
		if ( ! menuList || placeholder ) {
			return;
		}
		placeholder = document.createComment( 'cide-menu-placeholder' );
		menuList.parentNode.insertBefore( placeholder, menuList );
		document.body.appendChild( menuList );
	}

	function reattachList() {
		if ( ! menuList || ! placeholder ) {
			return;
		}
		placeholder.parentNode.insertBefore( menuList, placeholder );
		placeholder.parentNode.removeChild( placeholder );
		placeholder = null;
	}

	function isMobile() {
		return window.matchMedia( '(max-width: 860px)' ).matches;
	}

	function openMenu() {
		if ( isMobile() ) {
			detachList();
		}
		nav.classList.add( 'toggled' );
		document.body.classList.add( 'cide-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'true' );
		if ( overlay ) {
			overlay.classList.add( 'is-active' );
		}
		document.body.style.overflow = 'hidden';
	}

	function closeMenu() {
		nav.classList.remove( 'toggled' );
		document.body.classList.remove( 'cide-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		if ( overlay ) {
			overlay.classList.remove( 'is-active' );
		}
		document.body.style.overflow = '';
		reattachList();
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

	// Close button is inside the menu list (delegated, survives the move).
	document.addEventListener( 'click', function( e ) {
		if ( e.target && e.target.closest && e.target.closest( '.menu-close' ) ) {
			closeMenu();
		}
	} );

	document.addEventListener( 'keydown', function( e ) {
		if ( 'Escape' === e.key && nav.classList.contains( 'toggled' ) ) {
			closeMenu();
		}
	} );

	// If resized to desktop while open, reset cleanly.
	window.addEventListener( 'resize', function() {
		if ( ! isMobile() && nav.classList.contains( 'toggled' ) ) {
			closeMenu();
		}
	} );
}() );
