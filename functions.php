<?php
/**
 *
 * @package    ubuntugnome
 * @version    0.3
 * @author     Gaurav Pareek <grv@magikpress.com>
 * @copyright  Copyright (c) 2014, Gaurav Pareek
 * @author     Ruairi Phelan <rory@cyberdesigncraft.com>
 * @copyright  Copyright (c) 2013, Ruairi Phelan
 * @author     Justin Tadlock <justin@justintadlock.com>
 * @copyright  Copyright (c) 2013, Justin Tadlock

 * @link       http://magikpress.com/themes/ubuntugnome
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* Adds the child theme setup function to the 'after_setup_theme' hook. */
add_action( 'after_setup_theme', 'ubuntugnome_theme_setup', 11 );
add_action( 'after_setup_theme', 'ubuntugnome_unregister_things', 16 );

/**
 * Setup function.  All child themes should run their setup within this function.  The idea is to add/remove
 * filters and actions after the parent theme has been set up.  This function provides you that opportunity.
 *
 * @since  0.1
 * @access public
 * @return void
 */
function ubuntugnome_theme_setup() {

	/* Change default background color. */
	add_theme_support(
	'custom-header',
	array(
		'default-image'      => '',
		'default-text-color' => '272727',
		'default-image' => get_stylesheet_directory_uri() . '/images/headers/material1.jpg'
	));

	add_theme_support(
	'custom-background',
	array(
		'default-color' => 'eeeeee',
		'default-image' => '',
	));

	/*
	 * Registers default headers for the child theme.
	 * @since 0.1.0
	 * @link http://codex.wordpress.org/Function_Reference/register_default_headers
	 */
	register_default_headers(
		array(
			'material1' => array(
				'url'           => '%2$s/images/headers/material1.jpg',
				'thumbnail_url' => '%2$s/images/headers/material1-thumb.jpg',
				/* Translators: Header image description. */
				'description'   => __( 'Material1', 'ubuntugnome' )
			)
		)
	);

	/* Change primary color. */
	add_filter( 'theme_mod_color_primary', 'ubuntugnome_primary_color' );

	/* Add custom stylesheets. */
	add_action( 'wp_enqueue_scripts', 'ubuntugnome_enqueue_styles' );


    /* Theme layouts. */
	add_theme_support(
		'theme-layouts',
		array(
			'1c'        => __( '1 Column Wide',                'stargazer' )
		),
		array( 'default' => '1c' )
	);


    /* Post formats. */
	add_theme_support(
		'post-formats',
		array( 'aside', 'gallery', 'video' )
	);

}

function ubuntugnome_unregister_things() {
  /**
  * Un-Register default Parent Theme headers for the child theme.
  * @since 0.1
  */
  unregister_default_headers(
	  array( 'horizon', 'orange-burn', 'planets-blue', 'planet-burst', 'space-splatters' )
  );

  /* Unregister primary menu */
  unregister_nav_menu( 'primary' );
}

/**
 * Change primary color
 *
 * @since 0.1
 * @access public
 * @param  string  $hex
 * @return string
 */
function ubuntugnome_primary_color( $color ) {
	return $color ? $color : '349F8C';
}

/**
* Loads custom stylesheets for the theme.
*
* @since  0.1
* @access public
* @return void
*/
function ubuntugnome_enqueue_styles() {
	wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Cantarell:400,300,700,400italic');
	wp_enqueue_style( 'googleFonts');
}
