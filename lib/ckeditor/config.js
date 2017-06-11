/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config
	config.skin = 'office2013';
	config.extraPlugins = 'widget,image2,lineutils,dialog,dialogui,widgetselection,youtube,codesnippet';
	//config.codeSnippet_theme = 'school_book';
	config.codeSnippet_theme = 'default';
	config.codeSnippet_languages = {
		javascript: 'JavaScript',
		php: 'PHP',
		java : 'JAVA',
		html : 'HTML',
		mysql : 'MYSQL'
	};
	//config.toolbar = 'Basic';

	

	config.toolbar_Full = [ 
			['Source','-','Save','NewPage','Preview','-','Templates','Bold','Italic','Underline','Strike'], 
			['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'], 
			['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'], 
			['Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 'HiddenField'], 
			['BidiLtr', 'BidiRtl'], '/', ['Subscript','Superscript'], 
			['NumberedList','BulletedList','-','Outdent','Indent','Blockquote','CreateDiv'], 
			['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'], 
			['Link','Unlink','Anchor'], 
			['Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak'], 
			'/', 
			['Styles','Format','Font','FontSize'], 
			['TextColor','BGColor'], ['Maximize', 'ShowBlocks','-','About'] 
		]; 
	
	config.toolbar_Basic = [ 
			['Styles','Format','Font','FontSize','Bold', 'Italic', '-', 'NumberedList', 'BulletedList', '-', 'Link', 'Unlink','-'],
			['TextColor','BGColor','-','Table','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','Image','insert']
		];

	// The toolbar groups arrangement, optimized for two toolbar rows.

	config.toolbarGroups = [
		{ name: 'styles', groups: [ 'styles' ] },
		{ name: 'colors', groups: [ 'colors' ] },
		{ name: 'insert', groups: [ 'insert' ] },
		{ name: 'paragraph', groups: [ 'indent', 'list', 'blocks', 'align', 'bidi', 'paragraph' ] },
		{ name: 'document', groups: [ 'doctools', 'document' ] }
	];
	
	
	/*
	
	config.toolbarGroups = [
		{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
		{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
		{ name: 'links' },
		{ name: 'insert' },
		{ name: 'forms' },
		{ name: 'tools' },
		{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
		{ name: 'others' },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
		{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
		{ name: 'styles' },
		{ name: 'colors' },
		{ name: 'about' }
	];
	*/
	

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript,Preview,Flash,SpecialChar,Iframe,Doctools,CreateDiv,NumberedList,BulletedList,Language';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

};
