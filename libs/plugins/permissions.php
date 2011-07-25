<?php 
	
	function webtonio_roles(){

	$site_manager = array(
	
	"manage_sites" => true,
	"read" => true,
	"publish_posts" => true,
	"edit_posts" => true,
	"edit_others_posts" => true,
	"edit_published_posts" => true,
	"edit_private_posts" => true,
	"read_private_posts" => true,
	"delete_posts" => true,
	"delete_others_posts" => true,
	"delete_published_posts" => true,
	"delete_private_posts" => true,
	"edit_pages" => true,
	"edit_others_pages" => true,
	"edit_published_pages" => true,
	"edit_theme_options" => true,
	"upload_files" => true,
	"delete_published_pages" => false,
	"delete_themes" => false,
	"manage_options" => false
	
	);
	add_role("webtonio_site_manager","Site Manager", $site_manager);
	
}

add_action("init","webtonio_roles");