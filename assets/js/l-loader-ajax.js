jQuery(document).ready(function($) {
	
	$('#l-toggle-loader-status').on('click', function(e) {
		e.preventDefault();
		$.ajax({
			url: $(e.target).data('ajax-url'),
			type:"POST",
			data: {
			  action:'change_loader_status_action',
			  new_status:$(e.target).val(),
			}, 
			error: function(response){
				console.error(response);
			},
			success: function(response){
				if($(e.target).val()=="1"){
					$(e.target).val('0')
					$(e.target).attr('class','button button-danger');
					$(e.target).html('Deactivate');
				}else{
					$(e.target).val('1')
					$(e.target).attr('class','button button-success');
					$(e.target).html('Activate');
				}
			}
		});
		
	});
});