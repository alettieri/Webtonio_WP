<?php 

/**
 *	The Beginnings of a great shortcode
 */
function webtonio_shorty( $atts ) {
	extract( shortcode_atts( array(
		'name' => 'Shorty'
		
	), $atts ) );

	return "<h2>Shorty is named: $name<h2>";
}
add_shortcode( 'shorty', 'webtonio_shorty' );