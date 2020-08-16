jQuery(document).ready(function($) {
    var mediaUploader2;
    console.log(document.location.origin+'/wp-admin/admin-ajax.php')
    $('#wp-admin-bar-linearc_loader_upload').on('click',function (e) {
            e.preventDefault();
            if( mediaUploader2 ){
                mediaUploader2.open();
                return;
            }
            
            mediaUploader2 = wp.media.frames.file_frame = wp.media({
                title: 'Choose a Loader Image/Gif/Video',
                button: {
                    text: 'Choose File'
                },
                multiple: false
            });
            
            mediaUploader2.on('select', function(){
                attachment = mediaUploader2.state().get('selection').first().toJSON();
                $('#l_loader_file').val(attachment.url);
                $('#l-loading-file-preview').attr('src',attachment.url);
                $.ajax({
                    url: document.location.origin+'/wp-admin/admin-ajax.php',
                    type:"POST",
                    data: {
                      action:'change_l_loader_file_action',
                      l_loader_file:attachment.url
                    }, 
                    error: function(response){
                        console.error(response);
                    },
                    success: function(response){ 
                        console.log(response);     
                    }
                });
            });
            
            mediaUploader2.open();
    })
    

    $('#wp-admin-bar-linearc_loader_deactivate').on('click',function (e) {
        e.preventDefault();
        var x=this;
		$.ajax({
			url: document.location.origin+'/wp-admin/admin-ajax.php',
			type:"POST",
			data: {
			  action:'toggle_loader_status_action'
			}, 
			error: function(response){
				console.error(response);
			},
			success: function(response){
                if(response.trim()=='1'){
                    $( x ).find( "div.ab-item.ab-empty-item" ).html('Deactivate')
                }else{
                    $( x ).find( "div.ab-item.ab-empty-item" ).html('Activate')

                }
               
			}
		});
	})
});