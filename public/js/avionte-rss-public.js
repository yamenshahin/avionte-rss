(function( $ ) {

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

	 /**
	 * Fetch result by ajax on change.
	 *
	 * @since      1.0.0
	 */
	jQuery("#location, #category").change(function() {
		jQuery.ajax({
			type: "POST",
			url: frontend_ajax_url.ajaxurl,
			data: { 
				'action': 'fetch_result',
				'keywords': jQuery('#keywords').val(),
				'salary': jQuery('#salary').val(),
				'category': jQuery('#category').val(),
				'location': jQuery('#location').val()
			},
			success: function(response) {
				jQuery('.avionte-result').append(response);
			},
			error: function(response) {
				jQuery('.avionte-result').append('Something wrong happened!');
			}
		});
	});
	/**
	 * Fetch result by ajax on keyup.
	 *
	 * @since      1.0.0
	 */
	jQuery("#keywords, #salary").keyup(function() {
		jQuery.ajax({
			type: "POST",
			url: frontend_ajax_url.ajaxurl,
			data: { 
				'action': 'fetch_result',
				'keywords': jQuery('#keywords').val(),
				'salary': jQuery('#salary').val(),
				'category': jQuery('#category').val(),
				'location': jQuery('#location').val()
			},
			success: function(response) {
				jQuery('.avionte-result').append(response);
			},
			error: function(response) {
				jQuery('.avionte-result').append('Something wrong happened!');
			}
		});
	});

	/**
	 * Fetch result by ajax.
	 *
	 * @since      1.0.0
	 */
	jQuery("#fetch_result").click(function(e) {
		e.preventDefault();
		jQuery.ajax({
			type: "POST",
			url: frontend_ajax_url.ajaxurl,
			data: { 
				'action': 'fetch_result',
				'keywords': jQuery('#keywords').val(),
				'salary': jQuery('#salary').val(),
				'category': jQuery('#category').val(),
				'location': jQuery('#location').val()
			},
			success: function(response) {
				jQuery('.avionte-result').append(response);
			},
			error: function(response) {
				jQuery('.avionte-result').append('Something wrong happened!');
			}
		});
	});
	
})( jQuery );
