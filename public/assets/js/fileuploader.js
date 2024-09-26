var ajaxfileupload 	= 	function(){
	 $('#frmimageuploader').ajaxForm({
		forceSync: true,
		resetForm: true,
		dataType: 'json',
		beforeSerialize: function($Form, options){},
		beforeSubmit: beforeSubmit,
		beforeSend: function()
	    {
			$('.fileerror').hide();
			$('#uploadbar').show();
	        $("#progress").show();
	        //clear everything
	        $("#bar").width('0%');
	        $("#message").html("");
	        $("#percent").html("0%");
	    },
		success: function(responseText, statusText, xhr, $form){
			var responseText 	= 	jQuery.parseJSON(xhr.responseText);
			if (responseText.message)
			{	$('.fileupload #output').html(responseText.message);	}
			if (responseText.status)
			{
				if (responseText.setfile)
				{	setfileonUI(responseText);	}
			}
			else
			{
				$('.fileerror').html(responseText.message);
				$('.fileerror').show();
			}

			$('#btnupload').show();
			$('#progressbox').delay( 1000 ).fadeOut();
		},
		uploadProgress: OnProgress,
		complete: function(){
			$('#btncancel').on('click', function(){
				$('.closefacebox').click($.facebox.close);
			});
			$('#btncancel').show();
			$('#btnupload').show();
			$("#output").html("");

		}
	});
};

var setfileonUI	=	function(response){

	$('#'+response.imgTagId).attr('src',response.s3path);
	$('#'+response.imageId).val(response.filename);
  $('#'+response.imageId).trigger('change');
	$('#upload-form-modal').modal('hide');
};

var beforeSubmit	=	function(){
   if (window.File && window.FileReader && window.FileList && window.Blob)
	{
		if( !$('#FileInput').val())
		{
			$("#output").html("Please browse and add a file first.");
			return false;
		}
		var fsize = $('#FileInput')[0].files[0].size; //get file size
		var ftype = $('#FileInput')[0].files[0].type; // get file type

		switch(ftype)
        {
            case 'image/png':
			case 'image/gif':
			case 'image/jpeg':
			case 'image/pjpeg':
			case 'image/webp':
			case 'text/plain':
			case 'text/html':
			case 'application/x-zip-compressed':
			case 'application/pdf':
			case 'application/msword':
			case 'application/vnd.ms-excel':
			case 'video/mp4':
            break;
            default:	$("#output").html("<b>"+ftype+"</b> Unsupported file type!");
						return false;
        }
		$('#uploadbar').show();
		$('#progressbox').show();
		$('#btncancel').hide();
		$('#btnupload').hide();
		$("#output").html("");
	}
	else
	{
		$("#output").html("Please upgrade your browser, because your current browser lacks some new features we need!");
		return false;
	}
};

var OnProgress	=	function(event, position, total, percentComplete)
{
	$('#progressbox').show();
    $('#progressbar').width(percentComplete + '%');
    $('#statustxt').html(percentComplete + '%');
    if(percentComplete>50){ $('#statustxt').css('color','#000');	}
};

var bytesToSize	=	function(bytes) {
   var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
   if (bytes == 0) return '0 Bytes';
   var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
   return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
};

$('.uploadimage').click(function(e){
	e.preventDefault();
	var url = $(this).attr('href');
	$('.modal-content').load(url,function(data){
		 
        $('#upload-form-modal').modal('show');
    });

	
})
