$(document).ready(function() {

    "use strict";

   $('#summernote').summernote({
      height: 200,   //set editable area's height
      codemirror: { // codemirror options
        theme: 'monokai'
      },
        
      placeholder: 'write here...',
      toolbar: [
      ['style', ['style']],
      ['font', ['bold', 'underline']],
      ['color', ['forecolor' , 'backcolor']],
      ['para', ['ul', 'ol', 'paragraph']],
      ['style', ['fontsize']],
      ['insert', ['link', 'picture', 'video']],
      ['view'],
    ]
});

$('#summernote').summernote({
  shortcuts: false
});

});

