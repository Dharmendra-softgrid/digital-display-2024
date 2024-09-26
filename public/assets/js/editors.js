const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
  const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;
const example_image_upload_handler = (blobInfo, progress) => new Promise((success, failure) => {
    
    var xhr, formData;
     xhr = new XMLHttpRequest();
     xhr.withCredentials = false;
     xhr.open('POST', editorimageuploadurl);
     xhr.setRequestHeader("X-CSRF-Token", csrftoken);
     xhr.onload = function() {
         var json;
         if (xhr.status != 200) {
             failure('HTTP Error: ' + xhr.status);
             return;
         }
         json = JSON.parse(xhr.responseText);

         if (!json || typeof json.url != 'string') {
             failure('Invalid JSON: ' + xhr.responseText);
             return;
         }
         return success(json.url);
     };
     formData = new FormData();
     formData.append('FileInput', blobInfo.blob(), blobInfo.filename());
     formData.append('path', "images/uploads");
     xhr.send(formData);
  /*var image_size = blobInfo.blob().size / 1024;  // image size in kbytes
    var max_size   = 1024;                // max size in kbytes
    if( image_size  > max_size ){        
        failure('Image is too large( '+ image_size  + ') ,Maximum image size is:' + max_size + ' kB');
        return;      
    }*/

  //success("data:" + blobInfo.blob().type + ";base64," + blobInfo.base64());

});

  tinymce.init({
    selector: 'textarea.content',
    setup: function (editor) {
                editor.on('init change', function () {
                    editor.save();
                });
            },
    plugins: 'preview autolink directionality code image link media anchor insertdatetime advlist lists ',
    editimage_cors_hosts: ['picsum.photos'],
    /*menubar: 'file edit view insert format',*/
    menubar: false,
    toolbar: ' bold italic underline  |  alignleft aligncenter alignright alignjustify | numlist bullist |  forecolor backcolor | fontfamily fontsize blocks | code insertfile image media  link   ',
    toolbar_sticky: false,
    toolbar_sticky_offset: isSmallScreen ? 102 : 108,   
   
    height: typeof editorsHight!="undefined" ? editorsHight : 500,
    image_caption: true,
    relative_urls : false,
    remove_script_host : false,
    images_file_types: 'svg,jpeg,jpg,png,gif,webp',
    images_upload_handler: example_image_upload_handler
  });

