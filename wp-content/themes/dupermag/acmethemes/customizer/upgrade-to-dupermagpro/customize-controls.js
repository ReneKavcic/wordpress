( function( api ) {

	// Extends our custom "dupermag" section.
	api.sectionConstructor['dupermag'] = api.Section.extend( {

		// No events for this type of section.
		attachEvents: function () {},

		// Always make the section active.
		isContextuallyActive: function () {
			return true;
		}
	} );

} )( wp.customize );
