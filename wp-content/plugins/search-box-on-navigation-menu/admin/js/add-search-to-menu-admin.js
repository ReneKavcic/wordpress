/**
 * Dismisses plugin notices
 *
 */
( function( $ ) {
	"use strict";
	$( document ).ready( function() {
		$( '.notice.is-dismissible.add-search-to-menu .notice-dismiss').on( 'click', function() {

			$.ajax( {
				url: search_box_to_menu.ajax_url,
				data: {
					action: 'search_box_to_menu_notice_dismiss'
				}
			} );

		} );
	} );
} )( jQuery );