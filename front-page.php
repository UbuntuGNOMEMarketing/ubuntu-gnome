<?php

add_action( 'genesis_meta', 'parallax_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 */
function parallax_home_genesis_meta() {

	if ( is_active_sidebar( 'home-section-1' ) || is_active_sidebar( 'home-section-2' ) || is_active_sidebar( 'home-section-3' ) || is_active_sidebar( 'home-section-4' ) || is_active_sidebar( 'home-section-5' ) ) {

		//* Remove breadcrumbs
		remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs');

		//* Remove the default Genesis loop
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		//* Add homepage widgets
		add_action( 'genesis_after_header', 'parallax_homepage_widgets' );

	}
}

//* Add markup for homepage widgets
function parallax_homepage_widgets() {
	
  echo '<div class="home-odd home-section-1"><div class="wrap">';
	genesis_widget_area( 'home-section-1-left', array(
		'before' => '<div class="one-third first widget-area">',
		'after'  => '</div>',
	) );
  
  genesis_widget_area( 'home-section-1-right', array(
		'before' => '<div class="two-thirds widget-area">',
		'after'  => '</div>',
	) );
  
  echo '</div></div>';

	genesis_widget_area( 'home-section-2', array(
		'before' => '<div class="home-even home-section-2 widget-area"><div class="wrap">',
		'after'  => '</div></div>',
	) );

}

genesis();