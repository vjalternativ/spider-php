/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.extraPlugins = 'ckeditor_wiris,FMathEditor,tabletools';
	config.allowedContent = true;
	config.mathTypeParameters = {
    editorParameters: {
      language: 'en'
    }
  };
	config.specialChars = config.specialChars.concat([  [ '\u20b9', 'Rupees' ]]);
};
