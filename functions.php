<?php
/**
 * @package WordPress
 * @subpackage webtonio
 */

/**
 * Remove code from the <head>
 */
function webtonio_remove_head_links(){ 
	remove_action('wp_head', 'rsd_link'); // Might be necessary if you or other people on this site use remote editors.
	remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
	remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
	remove_action('wp_head', 'index_rel_link'); // Displays relations link for site index
	remove_action('wp_head', 'wlwmanifest_link'); // Might be necessary if you or other people on this site use Windows Live Writer.
	remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
	remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
	remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0); // Display relational links for the posts adjacent to the current post.
	// Hide the version of WordPress you're running from source and RSS feed 
	remove_action('wp_head', 'wp_generator');

	
}
add_action("init","webtonio_remove_head_links");



/* 	NOT cool Matt Mullenweg 
	Get outta my Wordpress codez dangit!
	Removes the capital_P_dangit filter from modifyig the site content.
*/
remove_filter( 'the_content', 'capital_P_dangit' ); // 
remove_filter( 'the_title', 'capital_P_dangit' );
remove_filter( 'comment_text', 'capital_P_dangit' );

function webtonio_remove_version() {return '';}
add_filter('the_generator', 'webtonio_remove_version');

// This function removes the comment inline css
/*function twentyten_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'twentyten_remove_recent_comments_style' );*/


/**
 * Remove meta boxes from Post and Page Screens
 */
function customize_meta_boxes() {
  /* These remove meta boxes from POSTS */
  //remove_post_type_support("post","excerpt");
  //remove_post_type_support("post","author");
  //remove_post_type_support("post","revisions");
  //remove_post_type_support("post","comments");
  //remove_post_type_support("post","trackbacks");
  //remove_post_type_support("post","editor");
  //remove_post_type_support("post","custom-fields");
  //remove_post_type_support("post","title");
  
  /* These remove meta boxes from PAGES */
  //remove_meta_box('postcustom','page','normal');  // Hide Custom Fields Box
  //remove_meta_box('trackbacksdiv','page','normal'); // Hide Trackbacks Box
  //remove_meta_box('commentstatusdiv','page','normal'); // Hide Discussion Box
  //remove_meta_box('commentsdiv','page','normal'); // Hide Comments Box
  //remove_meta_box('authordiv','page','normal'); // Hide Authors Box
  //remove_meta_box('revisionsdiv','page','normal'); // Hide Revisions Box
}
add_action('admin_init','customize_meta_boxes');

//Setup The Admin Editor Interface
function webtonio_setup_editor(){
	/* Removes media buttons above editor */
	//remove_action( 'media_buttons', 'media_buttons' );
	
}

//Get ready to setup the admin interface for users that cannot manage options
if(!current_user_can('manage_options')){
	add_action("admin_head","sup");
	add_action("admin_init","webtonio_configure_menu_page"); //Time to hide Menu items	
}

//Setup the Admin Menus
function webtonio_configure_menu_page(){

	/*Modifies the side navigation */
	//remove_menu_page("link-manager.php"); //Hide Links
	//remove_menu_page("edit-comments.php"); //Hide Comments
	//remove_menu_page("edit.php"); //Hide Posts
	//remove_menu_page("tools.php"); //Hide Tools

}

//Setup the THEME
function webtonio_setup_theme(){
	/**
	* Make theme available for translation
	* Translations can be filed in the /languages/ directory
	*/
	load_theme_textdomain( 'webtonio', TEMPLATEPATH . '/languages' );
	
	$locale = get_locale();
	$locale_file = TEMPLATEPATH . "/languages/$locale.php";
	if ( is_readable( $locale_file ) )
		require_once( $locale_file );
	
	/**
	* Set the content width based on the theme's design and stylesheet.
	*/
	if ( ! isset( $content_width ) )
		$content_width = 640;
	
	/** 
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );
	
	/**
	 * This theme uses post thumbnails
	 */
	add_theme_support( 'post-thumbnails' );
	
	
	/**
	 *	Add Editor Style Support
	 */
		
	add_editor_style("/css/editor-styles.css");
	
	/**
	 * Disable the admin bar in 3.1
	 */
	//show_admin_bar( false );
	
	/**
	 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
	 */
	//add_theme_support( 'post-formats', array( 'aside', 'audio', 'image', 'video', 'gallery', 'chat', 'link', 'quote', 'status' ) );

	
	/**
	 * This theme uses wp_nav_menus() for the header menu, utility menu and footer menu.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'webtonio' )
	) );
	
	//Let's add some custom images support
	if(function_exists("add_image_size"))
		webtonio_image_sizes();
	
	
	
}
add_action("after_setup_theme","webtonio_setup_theme");


/**
 * Add more image sizes to the theme
 */
function webtonio_image_sizes(){

	add_image_size("custom-thumb",160,160);

}

/**
 *	Add custom upload file types 
 */ 
/*
function webtonio_add_file_types($mimes){
	 $mimes = array_merge($mimes, array(
        'webm' => 'video/webm' //(need webm support)
    ));
    return $mimes;
}
add_filter('upload_mimes', 'webtonio_add_file_types');
*/



/**
 * Register widgetized area and update sidebar with default widgets
 */
function webtonio_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'webtonio' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar(array(
		 'name' => __( 'Left Footer Area', 'webtonio' ),
		 'id' => "ft-left",
		 'before_widget' => '<section class="footer-widget widget %2$s" role="complementary">',
		 'after_widget' => "</section>",
		 'before_title' => '<h4 class="widget-title footer-widget-title">',
		 'after_title' => '</h4>',
	));
	
	register_sidebar(array(
		 'name' => __( 'Right Footer Area', 'webtonio' ),
		 'id' => "ft-right",
		 'before_widget' => '<section class="footer-widget widget %2$s" role="complementary">',
		 'after_widget' => "</section>",
		 'before_title' => '<h4 class="widget-title footer-widget-title">',
		 'after_title' => '</h4>',
	));
	
}
add_action( 'init', 'webtonio_widgets_init' );

/*
 * Remove senseless dashboard widgets for non-admins. (Un)Comment or delete as you wish.
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;

	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']); // Plugins widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']); // WordPress Blog widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']); // Other WordPress News widget
	//unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']); // Right Now widget
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']); // Quick Press widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']); // Incoming Links widget
	//unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_recent_drafts']); // Recent Drafts widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']); // Recent Comments widget
}
if (!current_user_can('manage_options')) {
	add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );
} 

/**
 *	Remove the Protected: or Private: strings from the Title
 */
function clean_title($title) {
       return '%s';
}
add_filter('protected_title_format', 'clean_title'); //We don't need our titles to say Protected: blah


/**
 * Register our theme scripts
 */
function webtonio_register_scripts(){
	$template_url = get_bloginfo("template_url");
	
	//wp_dequeue_script("jquery");
	
	
	
	wp_enqueue_script("core"/*Script name*/,
					  "$template_url/js/script.js"/*Script path*/,
					  array() /*dependencies*/,
					  "1"/*Version*/,
					  true/*Add to footer*/);
	
}
add_action("wp_enqueue_scripts","webtonio_register_scripts");


/**
 * Custom Rewrite rules
 *
 * Uncomment the next three sections to enable custom rewrite rule
 * 
 */

/*
function webtonio_flush_player_rules(){
	global $wp_rewrite;
	$wp_rewrite->flush_rules();
}
add_filter("wp_loaded","webtonio_flush_player_rules");
*/
/**
 *	Add Customized rewrite path (adds custom slug)
 */
/*
function webtonio_add_custom_rewrite_rule($rules){
	$newrule = array();
	$newrule['(custom-rewrite)/(\d*)$']  = 'index.php?pagename=$matches[1]&vid_id=$matches[2]';
	return $newrule + $rules;
}
add_filter("rewrite_rules_array","webtonio_add_custom_rewrite_rule");
*/
/**
 *	Add custom query variable
 */
/*
function webtonio_add_custom_vars($vars){
	array_push($vars,"custom_id");
	return $vars;
}
add_filter("query_vars","webtonio_add_custom_vars");
*/




include_once("libs/init.php");
include_once("libs/plugins.php"); //Include any plugin scripts - for example shortcodes

