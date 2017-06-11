/**
 * @license Copyright (c) 2003-2017, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.plugins.setLang( 'simpleuploads', 'en',
{
    // Tooltip for the "add file" toolbar button
    addFile : 'Add a file',
    // Tooltip for the "add image" toolbar button
    addImage: 'Add an image',

    // Shown after the data has been sent to the server and we're waiting for the response
    processing: 'Processing...',

    // File size is over config.simpleuploads_maxFileSize OR the server returns HTTP status 413
    fileTooBig : 'The file is too big, please use a smaller one.',

    // The extension matches one of the blacklisted ones in config.simpleuploads_invalidExtensions
    invalidExtension : 'Invalid file type, please use only valid files.',

    // The extension isn't included in config.simpleuploads_acceptedExtensions
    nonAcceptedExtension: 'The file type is not valid, please use only valid files:\r\n%0',

    // The file isn't an accepted type for images
    nonImageExtension: 'You must select an image',

    // The width of the image is over the allowed maximum
    imageTooWide: 'The image is too wide',

    // The height of the image is over the allowed maximum
    imageTooTall: 'The image is too tall'
});

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here.
	// For complete reference see:
	// http://docs.ckeditor.com/#!/api/CKEDITOR.config

	// The toolbar groups arrangement, optimized for two toolbar rows.
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

	// Remove some buttons provided by the standard plugins, which are
	// not needed in the Standard(s) toolbar.
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';

};
