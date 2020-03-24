/**
 * -----------------------------------------------------------------------------
 * Purpose: Core headless theme scripts.
 * Copyright 2020, Code Potent, https://codepotent.com
 * -----------------------------------------------------------------------------
 */

jQuery(document).ready(function($) {

	// Remove customizer panels/sections; replace with note.
	$('#customize-theme-controls .customize-pane-parent').html('<li><p>'+theme_info+'</p></li>');

});