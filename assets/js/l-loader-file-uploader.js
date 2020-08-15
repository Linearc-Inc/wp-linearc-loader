
jQuery(document).ready( function($){
	
	var mediaUploader;
	
	$('#upload-loader-file-button').on('click',function(e) {
		e.preventDefault();
		if( mediaUploader ){
			mediaUploader.open();
			return;
		}
		
		mediaUploader = wp.media.frames.file_frame = wp.media({
			title: 'Choose a Loader Image/Gif/Video',
			button: {
				text: 'Choose File'
			},
			multiple: false
		});
		
		mediaUploader.on('select', function(){
			attachment = mediaUploader.state().get('selection').first().toJSON();
			$('#l_loader_file').val(attachment.url);
			$('#l-loading-file-preview').attr('src',attachment.url);
		});
		
		mediaUploader.open();
		
	});

	$('#remove-custom-loader').on('click',function(e){
		$('#l_loader_file').val('');
		$('#l-loading-file-preview').attr('src',$(e.target).data('default-loader'));
	})
	
});