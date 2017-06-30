<?php
/**
 * DuperMag functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Acme Themes
 * @subpackage DuperMag
 */

if ( !function_exists('dupermag_setup') ) :
    function dupermag_setup(){
        load_child_theme_textdomain( 'dupermag', get_stylesheet_directory() . '/languages' );
    }
endif;

add_action( 'after_setup_theme', 'dupermag_setup' );

function dupermag_enqueue_styles() {
    $parent_style = 'dupermag-parent-style';
    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'dupermag-style',
        get_stylesheet_uri(),
        array( $parent_style )
    );
}
add_action( 'wp_enqueue_scripts', 'dupermag_enqueue_styles',98 );

/**
 * Enqueue scripts for customizer
 */
add_action('init', 'dupermag_remove_actions');
function dupermag_remove_actions(){
    remove_action( 'customize_controls_enqueue_scripts', 'supermag_customizer_js' );
}

/**
 * Footer content
 *
 * @since SuperMag 1.0.0
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'supermag_footer' ) ) :

	function supermag_footer() {

		$supermag_customizer_all_values = supermag_get_theme_options();
		if( is_active_sidebar( 'full-width-footer' ) ) :
			dynamic_sidebar( 'full-width-footer' );
		endif;
		?>
		<div class="clearfix"></div>
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="footer-wrapper">
				<div class="top-bottom wrapper">
					<div id="footer-top">
						<div class="footer-columns">
							<?php if( is_active_sidebar( 'footer-col-one' ) ) : ?>
								<div class="footer-sidebar acme-col-3">
									<?php dynamic_sidebar( 'footer-col-one' ); ?>
								</div>
							<?php endif;
							if( is_active_sidebar( 'footer-col-two' ) ) : ?>
								<div class="footer-sidebar acme-col-3">
									<?php dynamic_sidebar( 'footer-col-two' ); ?>
								</div>
							<?php endif;
							if( is_active_sidebar( 'footer-col-three' ) ) : ?>
								<div class="footer-sidebar acme-col-3">
									<?php dynamic_sidebar( 'footer-col-three' ); ?>
								</div>
							<?php endif; ?>
						</div>
					</div><!-- #foter-top -->
					<div class="clearfix"></div>
				</div><!-- top-bottom-->
				<div class="wrapper footer-copyright border text-center">
					<p>
						<?php if( isset( $supermag_customizer_all_values['supermag-footer-copyright'] ) ): ?>
							<?php echo wp_kses_post( $supermag_customizer_all_values['supermag-footer-copyright'] ); ?>
						<?php endif; ?>
					</p>
					<div class="site-info">
						<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'dupermag' ) ); ?>"><?php printf( esc_html__( 'Proudly powered by %s', 'dupermag' ), 'WordPress' ); ?></a>
						<span class="sep"> | </span>
						<?php printf( esc_html__( 'Theme: %1$s by %2$s', 'dupermag' ), 'DuperMag', '<a href="https://www.acmethemes.com/" rel="designer">Acme Themes</a>' ); ?>
					</div><!-- .site-info -->
				</div>
			</div><!-- footer-wrapper-->
		</footer><!-- #colophon -->
		<?php
	}
endif;


function dupermag_archive_title( $title ) {
    if( is_admin() ){
        return $title;
    }

	return "<span>".$title."</span>";
}
add_filter( 'get_the_archive_title', 'dupermag_archive_title' );
add_filter( 'the_title', 'dupermag_archive_title' );

/**
 * require int.
 */
require trailingslashit( get_stylesheet_directory() ).'acmethemes/dupermag-init.php';