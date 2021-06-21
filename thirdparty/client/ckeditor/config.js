/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'FMathEditor,tabletools,mathjax';
	config.mathJaxLib = fwbaseurl + 'thirdparty/client/ckeditor/plugins/mathjax/plugin.js?config=TeX-AMS_HTML-full.js';

	config.specialChars = config.specialChars.concat([  [ '\u20b9', 'Rupees' ]]);
};
