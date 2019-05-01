(function( $ ) {
	'use strict';

	/**
	 * All of the code for your admin-facing JavaScript source
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
	//Ajax call for edit the record
	$(document).on('click','.edit-record', function(e){
	 	e.preventDefault();
	 	var cthis = $(this);
	 	var action = cthis.text();
	 	var email = $('.crud-email'+$(this).data('id')).html();
	 	var html = '';
	 	if(action == 'Edit')
	 	{
	 		cthis.text('Save');
		    var input = $('<input type="email" name="useremail" id="useremail" >');
		    input.val(email);
		    $('.crud-email'+$(this).data('id')).html(input);
	 	}
	 	else if(action == 'Save'){
	 		var new_val = $('.crud-email'+$(this).data('id')).find('input').val();

		 	$.ajax({
			    type: "post",
			    dataType: "json",
			    url: admin_curd_ajax.ajaxurl,
			    data: {action: "update_record",id: cthis.data('id'), email: new_val },
			    success: function(msg){
			        $('.crud-email'+$(this).data('id')).html(new_val);
	 				cthis.text('Edit');
			    }
			});
	 	}
	});

	//Ajax call for delete record
	$(document).on('click','.delete-record', function(e){
	 	e.preventDefault();
	 	var cthis = $(this);
	 	$.ajax({
		    type: "post",
		    dataType: "json",
		    url: admin_curd_ajax.ajaxurl,
		    data: {action: "delete_record",id: $(this).data('id') },
		    success: function(msg){
		        cthis.closest('tr').html('<td colspan="4">Record deleted!</td>').fadeOut("slow");
		    }
		});
	});

})( jQuery );
