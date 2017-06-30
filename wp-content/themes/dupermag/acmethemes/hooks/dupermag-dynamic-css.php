<?php
/**
 * Dynamic css
 *
 * @since Dupermag 1.0.1
 *
 * @param null
 * @return null
 *
 */
if ( ! function_exists( 'dupermag_dynamic_css' ) ) :

    function dupermag_dynamic_css() {

	    $supermag_customizer_all_values = supermag_get_theme_options();
        /*Color options */
        $supermag_primary_color = $supermag_customizer_all_values['supermag-primary-color'];

        $custom_css = '';

        /*background*/
        $custom_css .= "
           .widget-title span,
           .widget-title span:after,
           
           .page-header .page-title>span,
           .page-header .page-title>span:after,
           
           .single .entry-header .entry-title > span,
           .single .entry-header .entry-title > span:after,
           
           .page .entry-header .entry-title > span,
           .page .entry-header .entry-title > span:after
           {
                background: {$supermag_primary_color};
                color : #fff;
            }
        ";
	    /*category color*/
	    /*category color options*/
	    $args = array(
		    'orderby' => 'id',
		    'hide_empty' => 0
	    );
	    $categories = get_categories( $args );
	    $wp_category_list = array();
	    $i = 1;
	    foreach ($categories as $category_list ) {
		    $wp_category_list[$category_list->cat_ID] = $category_list->cat_name;

		    $cat_color = 'cat-'.esc_attr( get_cat_id($wp_category_list[$category_list->cat_ID]) );

		    if( isset( $supermag_customizer_all_values[$cat_color] )){
			    $cat_color = $supermag_customizer_all_values[$cat_color];
			    if( !empty( $cat_color )){
				    /*widget tittle*/
				    $custom_css .= "
                    .at-cat-color-wrap-{$category_list->cat_ID} .widget-title span,
                    .at-cat-color-wrap-{$category_list->cat_ID} .widget-title span:after,
                    
                     body.category-{$category_list->cat_ID} .page-header .page-title>span,
                     body.category-{$category_list->cat_ID} .page-header .page-title>span::after
                    {
                      background: {$cat_color};
                      color:#fff;
                    }";
			    }
		    }
		    $i++;
	    }

        wp_add_inline_style( 'supermag-style', $custom_css );

    }
endif;
add_action( 'wp_enqueue_scripts', 'dupermag_dynamic_css', 199 );