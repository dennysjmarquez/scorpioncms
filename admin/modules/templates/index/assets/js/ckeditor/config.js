/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */
 
 
	

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.allowedContent = true;
	config.extraPlugins = 'readmore,mediamger'; // Add 'WPMore' plugin - must be in plugins folder
	config.toolbarGroups = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker', 'editing' ] },
		{ name: 'forms', groups: [ 'forms' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'links', groups: [ 'links' ] },
		{ name: 'insert', groups: [ 'insert'] },
		{ name: 'readmore', groups: [ 'readmore' ] },
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'tools', groups: [ 'tools' ] },
		{ name: 'others', groups: [ 'others' ] },
		{ name: 'about', groups: [ 'about' ] }
		
	];
	

	config.removeButtons = 'Save,Preview,Form,HiddenField,Radio,Checkbox,TextField,Textarea,Select,Button,ImageButton,Language,BidiLtr,BidiRtl,Anchor,Flash,Smiley,About,Scayt';
	//config.removePlugins = 'resize';
	config.height = '350px';
	
	
	// Use <br> as break and not enclose text in <p> when pressing <Enter> or <Shift+Enter>
	config.enterMode = CKEDITOR.ENTER_BR;
	config.shiftEnterMode = CKEDITOR.ENTER_BR;
	config.fillEmptyBlocks = false;    // Prevent filler nodes in all empty blocks	
    
	
};


