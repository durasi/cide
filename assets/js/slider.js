/**
 * Cide hero slider.
 */
( function() {
	var slider = document.querySelector( '.cide-hero-slider' );
	if ( ! slider ) {
		return;
	}

	var slides = slider.querySelectorAll( '.cide-slide' );
	var dots = slider.querySelectorAll( '.cide-slider-dots button' );
	var prev = slider.querySelector( '.cide-slider-prev' );
	var next = slider.querySelector( '.cide-slider-next' );
	var current = 0;
	var timer = null;

	if ( slides.length < 2 ) {
		return;
	}

	function show( index ) {
		if ( index < 0 ) {
			index = slides.length - 1;
		}
		if ( index >= slides.length ) {
			index = 0;
		}
		slides[ current ].classList.remove( 'is-active' );
		slides[ current ].setAttribute( 'aria-hidden', 'true' );
		if ( dots[ current ] ) {
			dots[ current ].classList.remove( 'is-active' );
		}
		current = index;
		slides[ current ].classList.add( 'is-active' );
		slides[ current ].removeAttribute( 'aria-hidden' );
		if ( dots[ current ] ) {
			dots[ current ].classList.add( 'is-active' );
		}
	}

	function start() {
		stop();
		timer = window.setInterval( function() {
			show( current + 1 );
		}, 6000 );
	}

	function stop() {
		if ( timer ) {
			window.clearInterval( timer );
			timer = null;
		}
	}

	if ( next ) {
		next.addEventListener( 'click', function() {
			show( current + 1 );
			start();
		} );
	}
	if ( prev ) {
		prev.addEventListener( 'click', function() {
			show( current - 1 );
			start();
		} );
	}
	for ( var i = 0; i < dots.length; i++ ) {
		dots[ i ].addEventListener( 'click', function() {
			show( parseInt( this.getAttribute( 'data-goto' ), 10 ) );
			start();
		} );
	}

	slider.addEventListener( 'mouseenter', stop );
	slider.addEventListener( 'mouseleave', start );

	start();
}() );
