/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a span' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .bypostauthor .fn' ).css( {
					'clip': 'auto',
					'color': to,
					'position': 'relative'
				} );
				$( '.site-description' ).css( 'position', 'relative' );
			}
		} );
	} );
	// Accent color.
	wp.customize( 'accent_color', function( value ) {
		value.bind( function( to ) {
			$( '.site-title .background-path' ).css( {
				'fill': to
			} );
			$( '.sticky' ).css( {
				'border-color': to
			} );
			$( '.bypostauthor .fn' ).css( {
				'background-color': to
			} );
		} );
	} );
	// Link color.
	wp.customize( 'link_color', function( value ) {
		$( '<style type="text/css" />' ).attr( 'id', 'manuscript-link-color-css' ).appendTo( 'body' );
		value.bind( function( to ) {
			$( '#manuscript-link-color-css' )
				.html(
					'a { border-bottom-color: ' + to + '; }' +
					'.entry-content a, .comment-content a { background-color: ' + to + '; }' +
					'a:hover, a:focus, a:active, .main-navigation li:hover > a { background-color: ' + to + '; }' +
					'.site-title:hover .background-path { fill: ' + to + '; }' 
				);
		} );
	} );
} )( jQuery );
