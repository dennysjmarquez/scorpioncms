CKEDITOR.plugins.add( 'mediamger', {
    icons: 'icon',
	lang : 'es,en',
    init: function( editor ) {

	var editorx = editor.name;
			editor.ui.addButton('ck_mlib_button_'+editorx, { // add new button and bind our command
			label: editor.lang.mediamger.labelName,
			command: 'mediamger',
			toolbar: 'insert',
			icon: this.path + 'icons/icon.png'
			});
	
	setTimeout(function() {
		
		init_ckeditor_mediamger(editorx);
	
	}, 1000);

        
    }
});