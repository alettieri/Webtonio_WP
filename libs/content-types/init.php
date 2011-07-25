<?php 



/* Add Custom Content Type Stylesheet for admin */
/* add_action('admin_head', 'cpt_webtonio_head'); */

function cpt_webtonio_head(){	
	echo "<link type='text/css' rel='stylesheet' href='" . get_bloginfo("template_url") . "/css/cpt-admin.css"."' />";

}