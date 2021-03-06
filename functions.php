<?php

function antonine_setup() {

	load_theme_textdomain( 'antonine', get_template_directory() . '/languages' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );	
	add_theme_support( 'post-thumbnails' );	
	add_theme_support( 'custom-background' );
	
	$chargs = array(
		'width' => 980,
		'height' => 300,
		'uploads' => true,
	);
	
	set_post_thumbnail_size( 825, 510, true );

	if ( ! isset( $content_width ) ) $content_width = 900;

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'antonine' ),
	) );
	
	$defaults = array(
		'width'                  => 1000,
		'height'                 => 150,
		'flex-height'            => true,
		'flex-width'             => true
	);
	add_theme_support( 'custom-header', $defaults );

	add_theme_support( 'html5', array(
										'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
									) 
	);
	
	add_theme_support( 'post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

}
add_action( 'after_setup_theme', 'antonine_setup' );

function antonine_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Widget Area', 'antonine' ),
		'id'            => 'sidebar-one',
		'description'   => __( 'Add widgets here to appear in your side menu.', 'antonine' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'antonine_widgets_init' );
  
function antonine_scripts() {

	wp_enqueue_style( 'antonine-style', get_template_directory_uri() . '/css/main.css' );
	wp_enqueue_style( 'antonine-style-custom', get_template_directory_uri() . '/css/custom.css' );
	wp_enqueue_style( 'antonine-core-style', get_template_directory_uri() . '/css/wp_core.css' );
	wp_enqueue_style( 'antonine-style-mobile-768', get_template_directory_uri() . '/css/mobile768.css' );
	wp_enqueue_style( 'antonine-main-menu-style', get_template_directory_uri() . '/css/menu/main-menu.css' );
	wp_enqueue_style( 'font-awesome', get_stylesheet_directory_uri() . '/css/font-awesome/font-awesome.min.css'); 
	
	wp_enqueue_style( 'accessibility-spectrum-css', get_template_directory_uri() . '/css/spectrum/spectrum.css' );
	wp_enqueue_style( 'basic-accessibility-style-css', get_template_directory_uri() . '/css/accessibility/style.css' );
	wp_enqueue_style( 'jquery-slider-css', "//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css");

	if ( is_singular() ) wp_enqueue_script( "comment-reply" );

	wp_enqueue_script( 'jquery-ui-slider', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-color', array( 'jquery' ) );
	wp_enqueue_script( 'accessibility-spectrum-js', get_template_directory_uri() . '/js/spectrum/spectrum.js', array( 'jquery', 'jquery-ui-slider' ) );
	wp_enqueue_script( 'accessibility-script', get_template_directory_uri() . '/js/accessibility/accessibility.js', array( 'jquery' ) );
	wp_enqueue_script( 'jquery-cookie', get_template_directory_uri() . '/js/cookie/cookie.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'antonine-table-fix', get_template_directory_uri() . '/js/display/table_fix.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-youtube', get_template_directory_uri() . '/js/display/youtube-fix.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-search', get_template_directory_uri() . '/js/search/search-form.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-access-form', get_template_directory_uri() . '/js/display/front-page-access.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-info', get_template_directory_uri() . '/js/display/front-page-info.js', array( 'jquery' ) );
	
	wp_enqueue_script( 'antonine-update', get_template_directory_uri() . '/js/display/front-page-update.js', array( 'jquery' ) );
	wp_localize_script( 'antonine-update', 'antonine_update', 
																				array( 
																						'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																						'nonce' => wp_create_nonce("antonine_update")
																					)
						);
						
	wp_enqueue_script( 'antonine-subscribe', get_template_directory_uri() . '/js/display/front-page-subscribe.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-widgets', get_template_directory_uri() . '/js/display/front-page-widgets.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-comments', get_template_directory_uri() . '/js/display/front-page-comments.js', array( 'jquery' ) );
	wp_localize_script( 'antonine-comments', 'antonine_comments', 
																			array( 
																					'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																					'nonce' => wp_create_nonce("antonine_comments")
																				)
					);
					
	wp_enqueue_script( 'antonine-files', get_template_directory_uri() . '/js/display/front-page-files.js', array( 'jquery' ) );
	wp_localize_script( 'antonine-files', 'antonine_files', 
																			array( 
																					'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																					'nonce' => wp_create_nonce("antonine_files")
																				)
					);	

	wp_enqueue_script( 'antonine-subscribe', get_template_directory_uri() . '/js/display/front-page-subscribe.js', array( 'jquery' ) );
	wp_localize_script( 'antonine-subscribe', 'antonine_subscribe', 
																			array( 
																					'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																					'nonce' => wp_create_nonce("antonine_subscribe")
																				)
					);				
	
	if(isset($_GET['sub'])){
		wp_enqueue_script( 'antonine-subscribe-process', get_template_directory_uri() . '/js/display/front-page-subscribe-process.js', array( 'jquery' ) );
		wp_localize_script( 'antonine-subscribe-process', 'antonine_subscribe_process', 
																			array( 
																					'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																					'sub' => $_GET['sub'],
																					'nonce' => wp_create_nonce("antonine_subscribe_process")
																				)
						);
	}
	if(isset($_GET['unsub'])){
		wp_enqueue_script( 'antonine-unsubscribe-process', get_template_directory_uri() . '/js/display/front-page-unsubscribe-process.js', array( 'jquery' ) );
		wp_localize_script( 'antonine-unsubscribe-process', 'antonine_unsubscribe_process', 
																			array( 
																					'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																					'unsub' => $_GET['unsub'],
																					'nonce' => wp_create_nonce("antonine_unsubscribe_process")
																				)
						);
	}		
	wp_enqueue_script( 'antonine-main-menu', get_template_directory_uri() . '/js/menus/main-menu.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-library', get_template_directory_uri() . '/js/display/antonine-library.js', array( 'jquery' ) );
	if(!is_single() && !is_search()){
		wp_enqueue_script( 'antonine-page-layout', get_template_directory_uri() . '/js/display/page-layout.js', array( 'jquery' ) );
	}
	if(is_search()){
		wp_enqueue_script( 'antonine-search-page-layout', get_template_directory_uri() . '/js/display/search-page-layout.js', array( 'jquery' ) );
	}
	wp_enqueue_script( 'antonine-front-page-menu', get_template_directory_uri() . '/js/display/front-page-menu.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-front-page-search', get_template_directory_uri() . '/js/display/front-page-search.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-front-page-filter', get_template_directory_uri() . '/js/display/front-page-filter.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-front-page-files', get_template_directory_uri() . '/js/display/front-page-files.js', array( 'jquery' ) );
	wp_enqueue_script( 'antonine-front-page-filter-change', get_template_directory_uri() . '/js/display/front-page-filter-change.js', array( 'jquery' ) );
	wp_localize_script( 'antonine-front-page-filter-change', 'antonine_filter', 
																			array( 
																					'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																					'nonce' => wp_create_nonce("antonine_filter")
																				)
					);
	
	if(is_single() || is_page()){
		wp_enqueue_script( 'antonine-read', get_template_directory_uri() . '/js/display/reading.js', array( 'jquery' ) );
	}
	
	wp_enqueue_script( 'antonine-last-read', get_template_directory_uri() . '/js/display/last-reading.js', array( 'jquery' ) );
	
	if(!is_single()){
		wp_enqueue_script( 'antonine-front-page-resize', get_template_directory_uri() . '/js/display/front-page-resize.js', array( 'jquery' ) );
		wp_enqueue_script( 'antonine-front-page-scroll', get_template_directory_uri() . '/js/display/front-page-scroll.js', array( 'jquery' ) );
		wp_localize_script( 'antonine-front-page-scroll', 'antonine_scroll', 
																				array( 
																						'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																						'nonce' => wp_create_nonce("antonine_scroll")
																					)
						);
						
		wp_enqueue_script( 'antonine-front-page-preview', get_template_directory_uri() . '/js/display/front-page-preview.js', array( 'jquery' ) );
		wp_localize_script( 'antonine-front-page-preview', 'antonine_preview', 
																				array( 
																						'ajaxURL' => network_site_url() . "/wp-admin/admin-ajax.php",
																						'nonce' => wp_create_nonce("antonine_preview")
																					)
						); 
	}
	
	
}
add_action( 'wp_enqueue_scripts', 'antonine_scripts' );

function antonine_hex2rgb($hex) {
   $hex = str_replace("#", "", $hex);

   if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
   } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
   }
   $rgb = array($r, $g, $b);
   //return implode(",", $rgb); // returns the rgb values separated by commas
   return $rgb; // returns an array with the rgb values
}

function antonine_extra_style(){

	?><style>
		
		html{
			background-color: <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>;
			color: <?PHP echo get_theme_mod('site_alltext_colour'); ?>;
		}
		
		.site-navigation ul li a{
			color :  <?PHP echo get_theme_mod('site_menu_text_colour'); ?>;
		}

		li.sub-menu{
			background-color :  <?PHP echo get_theme_mod('site_submenu_background_colour'); ?>;
		}
		
		.site-navigation li a:hover, 
		.site-navigation li a:focus {
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_menu_text_hover_colour'); ?>;
		}
		
		.site-navigation li:hover, 
		.site-navigation li:focus {
			transition: background-color 0.5s ease;
			background-color: <?PHP echo get_theme_mod('site_menu_background_hover_colour'); ?>;
		}
		
		.site-navigation ul li .current-menu-item a{
			background: <?PHP echo get_theme_mod('site_menu_background_current_colour'); ?>;  
			background-color: <?PHP echo get_theme_mod('site_menu_background_current_colour'); ?>;  
		}
		
		<?PHP
			$hex = antonine_hex2rgb(get_theme_mod('pagination_background_colour'));
		?>
		
		.pagination a{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 0.9); 
			color: <?PHP echo get_theme_mod('pagination_link_colour'); ?>; 
		}
		
		<?PHP
			$hex = antonine_hex2rgb(get_theme_mod('site_post_background_colour'));
		?>
	
		article,
		.content-holder,
		.read-more-holder{
			background-color: rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>, 1.0); 
		}
		
		.single article,
		.linkprevious,
		.linknext,
		.single .links,
		#gradient,
		.page{
			background-color: <?PHP echo get_theme_mod("site_single_post_background_colour"); ?>;
		}

		#gradient{		
			background: <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>;
			background: -webkit-linear-gradient(<?PHP echo get_theme_mod('site_single_post_background_colour'); ?>, <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>); 
			background: -o-linear-gradient(<?PHP echo get_theme_mod('site_single_post_background_colour'); ?>, <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>); 
			background: -moz-linear-gradient(<?PHP echo get_theme_mod('site_single_post_background_colour'); ?>, <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>); 
			background: linear-gradient(<?PHP echo get_theme_mod('site_single_post_background_colour'); ?>, <?PHP echo get_theme_mod('site_allsite_background_colour'); ?>); 
		}

		a{
			color: <?PHP echo get_theme_mod('site_alllink_colour'); ?>;
		}
		
		html a:hover,
		html a:focus{
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		header#masthead h1 a,
		header#masthead p a{
			color: <?PHP echo get_theme_mod("site_title_colour"); ?>;
		}
		
		header#masthead h1 a:hover,
		header#masthead p a:hover{
			transition: background-color 0.5s ease;
			color: <?PHP echo get_theme_mod('site_alllink_hover_colour'); ?>;
		}
		
		button,
		input[type=submit]{
			background-color:  <?PHP echo get_theme_mod("site_button_colour"); ?>;
			color:  <?PHP echo get_theme_mod("site_button_text_colour"); ?>;
		}
		
		article .entry-title{
			color:  <?PHP echo get_theme_mod("site_title_colour"); ?>;
		}
		
		.home article .content-holder,
		.search article .content-holder,
		.archive article .content-holder{
			border-right: 1px solid  <?PHP echo get_theme_mod("border_colour"); ?>;
			border-left: 1px solid  <?PHP echo get_theme_mod("border_colour"); ?>;
		}
		
		<?PHP
			$hex = antonine_hex2rgb(get_theme_mod('shadow_colour'));
		?>
		
		.single #content,
		.home #main article, 
		.search #main article, 
		.archive #main article{
			-webkit-box-shadow: 10px 10px 40px 0px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>,0.55);
			-moz-box-shadow: 10px 10px 40px 0px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>,0.55);
			box-shadow: 10px 10px 40px 0px rgba(<?PHP echo $hex[0] . "," . $hex[1] . "," . $hex[2]; ?>,0.55);
		}

		.single #main article .aside{
			border:1px solid <?PHP echo get_theme_mod('shadow_colour'); ?>;
			-webkit-border-radius: 20px;
			-moz-border-radius: 20px;
			border-radius: 20px;
		}
		
	</style><?PHP

}
add_action("wp_head", "antonine_extra_style");

function antonine_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'antonine_excerpt_length', 999 );

function antonine_add_editor_styles() {
    add_editor_style( get_template_directory_uri() . '/css/main.css' );
}
add_action( 'admin_init', 'antonine_add_editor_styles' );

function antonine_init(){

	if(!get_option("antonine_setup")){
	
		set_theme_mod('site_allsite_background_colour', '#fefefe'); 
		set_theme_mod('site_title_colour', '#555555'); 
		set_theme_mod('site_alltext_colour', '#000000'); 
		set_theme_mod('site_alllink_hover_colour', '#ff0000');
		set_theme_mod('site_menu_text_colour', '#000000'); 
		set_theme_mod('site_menu_text_hover_colour', '#FF0000'); 
		set_theme_mod('site_menu_background_hover_colour', '#aaaaaa'); 
		set_theme_mod('site_menu_background_current_colour', '#cccccc'); 
		set_theme_mod('site_menu_background_colour', '#dddddd');
		set_theme_mod('site_header_colour', '#fefefe');
		set_theme_mod('site_header_background_colour', '#fefefe');
		set_theme_mod('site_single_post_background_colour', '#dddddd');
		set_theme_mod('site_post_background_colour', '#ffffff');
		set_theme_mod('site_alllink_colour', '#550000');
		set_theme_mod("site_button_colour", '#000000'); 
		set_theme_mod("site_button_text_colour", '#ffffff'); 
		set_theme_mod('pagination_background_colour', '#000000');
		set_theme_mod('pagination_link_colour', '#FFFFFF');
		set_theme_mod('shadow_colour', '#aaaaaa');
		set_theme_mod('border_colour', '#0000FF');
		set_theme_mod('info', 'on');
		set_theme_mod('menu', 'on');
		set_theme_mod('search', 'on');
		set_theme_mod('updates', 'on');
		set_theme_mod('filters', 'on');
		set_theme_mod('comments', 'on');
		set_theme_mod('widgets', 'on');
		set_theme_mod('files', 'on');
		set_theme_mod('accessibility', 'on');
		set_theme_mod('subscribe', 'on');	
		add_option("antonine_setup", true);
	}
}
add_action("init", "antonine_init");

function antonine_toolbar_items($wp_admin_bar){     
	$args = array(
		'id' => 'antonine_admin_menus',
		'title' => __('Change Menus', 'antonine'), 
		'href' => admin_url("customize.php?autofocus%5Bpanel%5D=nav_menus"), 
		'meta' => array(
			'class' => 'antonine_admin_menus', 
			'title' => 'Manage menus'
			)
	);
	$wp_admin_bar->add_node($args);
	
	$args = array(
		'id' => 'antonine_admin_widgets',
		'title' => __('Change Widgets', 'antonine'), 
		'href' => admin_url("customize.php?autofocus%5Bpanel%5D=widgets"), 
		'meta' => array(
			'class' => 'antonine_admin_widgets', 
			'title' => 'Manage widgets'
			)
	);
	$wp_admin_bar->add_node($args);
	
	$args = array(
		'id' => 'antonine_admin_side_menu',
		'title' => __('Change Side Menu', 'antonine'), 
		'href' => admin_url("customize.php?autofocus%5Bsection%5D=menu_layout"), 
		'meta' => array(
			'class' => 'antonine_admin_side_menu', 
			'title' => 'Manage side menu'
			)
	);
	$wp_admin_bar->add_node($args);
	
	$args = array(
		'id' => 'antonine_admin_colours',
		'title' => __('Change Colours', 'antonine'), 
		'href' => admin_url("customize.php?autofocus%5Bsection%5D=site_colours"), 
		'meta' => array(
			'class' => 'antonine_admin_colours', 
			'title' => 'Manage colours'
			)
	);
	$wp_admin_bar->add_node($args);

}
add_action('admin_bar_menu', 'antonine_toolbar_items', 100); 

function antonine_featured_category_create(){
	if(!get_option("antonine_featured")){
		$id = wp_create_category(__("Featured Content", "antonine"));
		add_option("antonine_featured", $id);
	}
}
add_action("admin_head", "antonine_featured_category_create");

function antonine_setup_options () {
		
	global $wpdb;
		
	if(!get_option("antonine_db_setup")){

		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');

		$table_name = $wpdb->prefix . "antonine_subscribe";

		$sql = "CREATE TABLE " . $table_name . " (
			  id bigint(20) NOT NULL AUTO_INCREMENT,
			  email_address varchar(255),
			  verify varchar(255),
			  unsubscribe varchar(255),
			  UNIQUE KEY id(id)
			);";
			
		dbDelta($sql);
								
		add_option("antonine_db_setup", TRUE);
		
	}

}
add_action('after_switch_theme', 'antonine_setup_options');

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/infinite_scroll.php';
require get_template_directory() . '/inc/comments.php';
require get_template_directory() . '/inc/subscribe.php';
require get_template_directory() . '/inc/files.php';
require get_template_directory() . '/inc/updates.php';
require get_template_directory() . '/inc/antonine_filter.php';
require get_template_directory() . '/inc/page_preview.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/menus/Walker_Menu_Antonine.php';
