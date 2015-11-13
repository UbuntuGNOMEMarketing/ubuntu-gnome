<?php
//* Start the engine
include_once( get_template_directory() . '/lib/init.php' );

//* Add Image upload to WordPress Theme Customizer
add_action( 'customize_register', 'ubuntu_gnome_customizer' );
function ubuntu_gnome_customizer(){

	require_once( get_stylesheet_directory() . '/lib/customize.php' );
	
}

//* Include Section Image CSS
include_once( get_stylesheet_directory() . '/lib/output.php' );

//* Child theme (do not remove)
define( 'CHILD_THEME_NAME', 'Ubuntu Gnome Theme' );
define( 'CHILD_THEME_URL', 'http://ubuntugnome.org/' );
define( 'CHILD_THEME_VERSION', '1.0.0' );

//* Enqueue scripts and styles
add_action( 'wp_enqueue_scripts', 'mobile_first_scripts_styles' );
function mobile_first_scripts_styles() {

	wp_enqueue_script( 'mobile-first-responsive-menu', get_bloginfo( 'stylesheet_directory' ) . '/js/responsive-menu.js', array( 'jquery' ), '1.0.0' );
  //wp_enqueue_script( 'mobile-first-sticky-message', get_bloginfo( 'stylesheet_directory' ) . '/js/sticky-message.js', array( 'jquery' ), '1.0.0' );

	wp_enqueue_style( 'dashicons' );
	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Open+Sans:400,700,400italic', array(), CHILD_THEME_VERSION );

}

//* Add HTML5 markup structure
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', ) );

//* Add support for structural wraps
add_theme_support( 'genesis-structural-wraps', array(
	'header',
	'nav',
	'subnav',
	'footer-widgets',
	'footer'
) );

//* Add viewport meta tag for mobile browsers
add_theme_support( 'genesis-responsive-viewport' );

//* Add support for custom header
add_theme_support( 'custom-header', array(
	'width'           => 600,
	'height'          => 114,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );


//* Remove the secondary sidebar
unregister_sidebar( 'sidebar-alt' );
unregister_sidebar( 'sidebar' );

//* Remove site layouts
genesis_unregister_layout( 'content-sidebar-sidebar' );
genesis_unregister_layout( 'sidebar-sidebar-content' );
genesis_unregister_layout( 'sidebar-content-sidebar' );
genesis_unregister_layout( 'content-sidebar' );
genesis_unregister_layout( 'sidebar-content' );

//* Hook sticky message before site header
//add_action( 'genesis_before', 'mobile_first_sticky_message' );
function mobile_first_sticky_message() {

	genesis_widget_area( 'sticky-message', array(
		'before' => '<div class="sticky-message">',
		'after'  => '</div>',
	) );

}

//* Remove comment form allowed tags
add_filter( 'comment_form_defaults', 'mobile_first_remove_comment_form_allowed_tags' );
function mobile_first_remove_comment_form_allowed_tags( $defaults ) {
	
	$defaults['comment_notes_after'] = '';
	return $defaults;

}

//* Modify the size of the Gravatar in the author box
add_filter( 'genesis_author_box_gravatar_size', 'mobile_first_author_box_gravatar' );
function mobile_first_author_box_gravatar( $size ) {

	return 160;

}

//* Modify the size of the Gravatar in the entry comments
add_filter( 'genesis_comment_list_args', 'mobile_first_comments_gravatar' );
function mobile_first_comments_gravatar( $args ) {

	$args['avatar_size'] = 100;
	return $args;

}

//* Add support for 4-column footer widgets
add_theme_support( 'genesis-footer-widgets', 4 );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'sticky-message',
	'name'        => __( 'Sticky Message', 'ubuntu-gnome' ),
	'description' => __( 'This is the sticky message widget area.', 'ubuntu-gnome' ),
) );

//* Register widget areas
genesis_register_sidebar( array(
	'id'          => 'home-section-1-left',
	'name'        => __( 'Home Section 1 Left', 'ubuntu-gnome' ),
	'description' => __( 'This is the home section 1 section, left side.', 'ubuntu-gnome' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-1-right',
	'name'        => __( 'Home Section 1 Right', 'ubuntu-gnome' ),
	'description' => __( 'This is the home section 1 section, right side.', 'ubuntu-gnome' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-section-2',
	'name'        => __( 'Home Section 2', 'ubuntu-gnome' ),
	'description' => __( 'This is the home section 2 section.', 'ubuntu-gnome' ),
) );


//* Remove the footer
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );


//* Add banner on top of all pages. Background will be editable in Customizer 
add_action( 'genesis_after_header', 'ubuntu_gnome_banner' );

function ubuntu_gnome_banner() {
?>
	<div class="banner-1">
 	</div>
<?php 
}

//* Customize post info in blog posts
add_filter( 'genesis_post_info', 'sp_post_info_filter' );
function sp_post_info_filter($post_info) {
  $post_tags = do_shortcode('[post_tags before=""]');
	$post_info = '[post_author_posts_link] | [post_date] | '.$post_tags.' | [post_comments before=""] | [post_edit]';
	return $post_info;
}

//* Remove the entry footer markup 
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_open', 5 );
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );
remove_action( 'genesis_entry_footer', 'genesis_entry_footer_markup_close', 15 );

//* Add wrappers to comments

//add_action( 'genesis_before_comments', 'ubuntu_gnome_wrap_start' );
//add_action( 'genesis_before_comment_form', 'ubuntu_gnome_wrap_start' );
//add_action( 'genesis_after_comments', 'ubuntu_gnome_wrap_end' );
//add_action( 'genesis_after_comment_form', 'ubuntu_gnome_wrap_end' );

function ubuntu_gnome_wrap_start() {
  echo '<div class="wrap">';
}

function ubuntu_gnome_wrap_end() {
  echo '</div>';
}
