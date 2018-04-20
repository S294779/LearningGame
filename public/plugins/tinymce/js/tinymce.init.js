$(function () {
    tinymce.init({
        selector: 'textarea.editor',
        body_class: 'zzzs',
        language: 'en',
        //inline: true,
        height : "320",
        plugins: "textcolor colorpicker",
        toolbar: "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect,forecolor backcolor,fullscreen",
        init_instance_callback: function(editor){
            editor.on('focus', function (e) {
                $(editor.editorContainer).addClass('focused');
              console.log(editor);
            });
            editor.on('blur', function (e) {
                $(editor.editorContainer).removeClass('focused');
              console.log(editor.editorContainer);
            });
        }
    })
})

