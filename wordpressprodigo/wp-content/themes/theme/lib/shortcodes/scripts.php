<?php
if( !function_exists ('vuzz_shortcodes_scripts') ) :
	function vuzz_shortcodes_scripts() {
		wp_enqueue_script('jquery');
		wp_register_script( 'vuzz_tabs',  get_template_directory_uri() . '/lib/shortcodes/js/vuzz_tabs.js', array ( 'jquery', 'jquery-ui-tabs'), '1.0', true );
		wp_register_script( 'vuzz_toggle',  get_template_directory_uri() . '/lib/shortcodes/js/vuzz_toggle.js', 'jquery', '1.0', true );
		wp_register_script( 'vuzz_accordion',  get_template_directory_uri() . '/lib/shortcodes/js/vuzz_accordion.js', array ( 'jquery', 'jquery-ui-accordion'), '1.0', true );
		wp_enqueue_style('vuzz_shortcode_styles',  get_template_directory_uri() . '/lib/shortcodes/css/vuzz_shortcodes_styles.css');
	}
	add_action('wp_enqueue_scripts', 'vuzz_shortcodes_scripts');
endif;