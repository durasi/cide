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
		// A11y: move focus into the modal (close button is the first focusable).
		var closeBtn = menuList ? menuList.querySelector( '.menu-close' ) : null;
		if ( closeBtn ) {
			closeBtn.focus();
		}
	}

	function closeMenu() {
		nav.classList.remove( 'toggled' );
		document.body.classList.remove( 'cide-menu-open' );
		toggle.setAttribute( 'aria-expanded', 'false' );
		if ( overlay ) {
			overlay.classList.remove( 'is-active' );
		}
		document.body.style.overflow = '';
		var hadFocus = menuList && menuList.contains( document.activeElement );
		reattachList();
		// A11y: return focus to the toggle when the modal is dismissed.
		if ( hadFocus ) {
			toggle.focus();
		}
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
		if ( ! nav.classList.contains( 'toggled' ) ) {
			return;
		}
		if ( 'Escape' === e.key ) {
			closeMenu();
			return;
		}
		// A11y: trap keyboard focus inside the off-canvas menu (modal pattern).
		// Tab on the last item wraps to the close button (first focusable);
		// Shift+Tab on the close button wraps to the last item.
		if ( 'Tab' === e.key && menuList && isMobile() ) {
			var focusables = menuList.querySelectorAll( 'a[href], button:not([disabled]), input, select, textarea, [tabindex]:not([tabindex="-1"])' );
			if ( ! focusables.length ) {
				return;
			}
			var first = focusables[ 0 ];
			var last = focusables[ focusables.length - 1 ];
			if ( e.shiftKey && document.activeElement === first ) {
				e.preventDefault();
				last.focus();
			} else if ( ! e.shiftKey && document.activeElement === last ) {
				e.preventDefault();
				first.focus();
			} else if ( ! menuList.contains( document.activeElement ) ) {
				// Focus escaped (e.g. body) — pull it back into the modal.
				e.preventDefault();
				first.focus();
			}
		}
	} );

	// If resized to desktop while open, reset cleanly.
	window.addEventListener( 'resize', function() {
		if ( ! isMobile() && nav.classList.contains( 'toggled' ) ) {
			closeMenu();
		}
	} );
}() );
