/**
 * @license Copyright (c) 2003-2014, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.toolbar_CusToolbar = [
		{ name: 'document', groups: [ 'mode', 'document' ], items: [ 'Source' ] },
		{ name: 'clipboard', groups: [ 'clipboard', 'align' ], items: [ 'Undo', 'Redo', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
		{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar' ] },
		'/',
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'RemoveFormat' ] },
		{ name: 'paragraph',   groups: [ 'list' ], items: [ 'NumberedList', 'BulletedList','-','Outdent','Indent','-','Blockquote' ] },
		{ name: 'links', items: [ 'Link', 'Unlink' ] },
		{ name: 'styles', items: [ 'Styles', 'Format' ] },
		{ name: 'colors', items : [ 'TextColor','BGColor' ] },
		{ name: 'mediaembed', items: [ 'MediaEmbed' ] },
	];
};
