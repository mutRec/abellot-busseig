<?php
/**
 * Additional features to allow styling of the templates
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function hamroclass_body_classes( $classes ) {

	global $post;
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	/**
	 * Class for archive
	 */
	if ( is_archive() ) {
		$hamroclass_archive_layout = get_theme_mod( 'hamroclass_archive_layout', 'classic' );
		if ( ! empty( $hamroclass_archive_layout ) ) {
			$classes[] = 'archive-' . esc_attr( $hamroclass_archive_layout );
		}
	}

	$hamroclass_preloader_image= get_theme_mod('hamroclass_preloader_image');
	if($hamroclass_preloader_image){
		$classes[] = "body_preloader";
	}

	/**
	 * option for web site layout
	 */
	$hamroclass_site_layout = esc_attr( get_theme_mod( 'hamroclass_site_layout', 'hmc_fullwidth_layout' ) );

	if ( ! empty( $hamroclass_site_layout ) ) {
		$classes[] = $hamroclass_site_layout;
	}

	$sidebar_name = hamroclass_get_sidebar_name();

	switch ($sidebar_name){
		case 'right_sidebar':
			$classes[] = 'right-sidebar';
			break;
		case 'left_sidebar':
			$classes[] = 'left-sidebar';
			break;
		case 'no_sidebar':
			$classes[] = 'no-sidebar';
			break;
		case 'both_sidebar':
			$classes[] = 'both-sidebar';
			break;
		case 'no_sidebar_center':
			$classes[] = 'no-sidebar-center';
			break;
		default:
			$classes[] = 'right-sidebar';
			break;
	}

	return $classes;

}

add_filter( 'body_class', 'hamroclass_body_classes' );

/**
 * Function define about page/post/archive sidebar
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_get_sidebar_name' ) ):

function hamroclass_get_sidebar_name() {

    $default_sidebar = 'right_sidebar';
    $sidebar_name = $default_sidebar;
    if(is_home()){
        $sidebar_name = get_theme_mod( 'centurylib_default_index_sidebar', $default_sidebar );
    }
    if(is_archive()){
        $sidebar_name = get_theme_mod( 'centurylib_default_archive_sidebar', $default_sidebar );
    }
    if(is_search()){
        $sidebar_name = get_theme_mod( 'centurylib_default_search_sidebar', $default_sidebar );
    }
    if(is_404()){
        $sidebar_name = get_theme_mod( 'centurylib_default_notfound_sidebar', $default_sidebar );
    }

    if(is_page()){
        $sidebar_name = get_theme_mod( 'centurylib_default_page_sidebar', $default_sidebar );
    }

    if(is_single()){
        $sidebar_name = get_theme_mod( 'centurylib_default_post_sidebar', $default_sidebar );
    }


    // Metabox For page and posts
    if( is_page() || is_single() ){
        $metabox_sidebar_details = get_post_meta( get_the_ID(), 'centurylib_single_post_sidebar', true );
        $metabox_sidebar_name = (isset($metabox_sidebar_details['sidebar_layout'])) ? esc_attr($metabox_sidebar_details['sidebar_layout']) : '';

        $sidebar_name = ( $metabox_sidebar_name && $metabox_sidebar_name !='default_sidebar' ) ? $metabox_sidebar_name : $sidebar_name; 
    }

    return $sidebar_name;

}
endif;

/**
 * Function to get sidebar name in array
 *
 * @since 1.0.0
 */
if(!function_exists('hamroclass_sidebar_name_arrray') ){

    function hamroclass_sidebar_name_array(){
        $sidebar_name = hamroclass_get_sidebar_name();
        $hamroclass_sidebars = array();
        switch ($sidebar_name){
            case 'left_sidebar':
                $hamroclass_sidebars[] = 'hamroclass_left_sidebar';
                break;
            case 'right_sidebar':
                $hamroclass_sidebars[] = 'hamroclass_right_sidebar';
                break;
            case 'both_sidebar':
                $hamroclass_sidebars[] = 'hamroclass_left_sidebar';
                $hamroclass_sidebars[] = 'hamroclass_right_sidebar';
                break;
            case 'no_sidebar':
            case 'no_sidebar_center':
                $hamroclass_sidebars = array();
                break;
            default:
                $hamroclass_sidebars[] = 'hamroclass_right_sidebar';
                break;
        }

        return $hamroclass_sidebars;
    }

}


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Register Google fonts for hamroclass.
 *
 * @return string Google fonts URL for the theme.
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_fonts_url' ) ) :
    function hamroclass_fonts_url() {
        
        $fonts_url = '';
        $font_families = array();


        /* translators: If there are characters in your language that are not supported by Roboto, translate this to 'off'. Do not translate into your own language. */
		if ( 'off' !== _x( 'on', 'Roboto font: on or off', 'hamroclass' ) ) {
			$font_families[] = 'Roboto:400italic,700italic,300,400,500,600,700';
		}

        $font_families = apply_filters( 'hamroclass_google_font_families', $font_families );
        if( $font_families ) {
            $query_args = array(
                'family' => urlencode( implode( '|', $font_families ) ),
                //'subset' => urlencode( 'latin,latin-ext' ),
            );

            $fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/*---------------------------------------------------------------------------------------------------------------*/
/**
 * Social media function
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'hamroclass_social_media' ) ):
	function hamroclass_social_media() {
		$get_social_media_icons  = get_theme_mod( 'social_media_icons', '' );
		if(!$get_social_media_icons){
			return;
		}
		$get_decode_social_media = json_decode( $get_social_media_icons );
		if ( ! empty( $get_decode_social_media ) ) {
			?>
			<div class="hmc-social-icons-wrapper">
			<?php
			foreach ( $get_decode_social_media as $single_icon ) {
				$icon_class = $single_icon->icon_class;
				$icon_url   = $single_icon->icon_url;
				$icon_background   = $single_icon->icon_background;
				if ( ! empty( $icon_url ) ) {
					?><span class="social-link" style="background-color:<?php echo esc_attr($icon_background); ?>"><a href="<?php echo esc_url( $icon_url ); ?>" target="_blank"><i class="fa <?php echo esc_attr( $icon_class ); ?>"></i></a></span><?php
				}
			}
			echo '</div><!-- .hmc-social-icons-wrapper -->';
		}
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category list
 *
 * @return array();
 */
if ( ! function_exists( 'hamroclass_categories_lists' ) ):
	function hamroclass_categories_lists() {
		$hamroclass_categories       = get_categories( array( 'hide_empty' => 1 ) );
		$hamroclass_categories_lists = array();
		foreach ( $hamroclass_categories as $category ) {
			$hamroclass_categories_lists[ $category->term_id ] = $category->name;
		}

		return $hamroclass_categories_lists;
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Category dropdown
 *
 * @return array();
 */
if ( ! function_exists( 'hamroclass_categories_dropdown' ) ):
	function hamroclass_categories_dropdown() {
		$hamroclass_categories            = get_categories( array( 'hide_empty' => 1 ) );
		$hamroclass_categories_lists      = array();
		$hamroclass_categories_lists['0'] = esc_html__( 'Select Category', 'hamroclass' );
		foreach ( $hamroclass_categories as $category ) {
			$hamroclass_categories_lists[ $category->term_id ] = $category->name;
		}

		return $hamroclass_categories_lists;
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get minified css and removed space
 *
 * @since 1.0.0
 */
function hamroclass_css_strip_whitespace( $css ) {
	$replace = array(
		"#/\*.*?\*/#s" => "",  // Strip C style comments.
		"#\s\s+#"      => " ", // Strip excess whitespace.
	);
	$search  = array_keys( $replace );
	$css     = preg_replace( $search, $replace, $css );

	$replace = array(
		": "  => ":",
		"; "  => ";",
		" {"  => "{",
		" }"  => "}",
		", "  => ",",
		"{ "  => "{",
		";}"  => "}", // Strip optional semicolons.
		",\n" => ",", // Don't wrap multiple selectors.
		"\n}" => "}", // Don't wrap closing braces.
		"} "  => "}\n", // Put each rule on it's own line.
	);
	$search  = array_keys( $replace );
	$css     = str_replace( $search, $replace, $css );

	return trim( $css );
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Generate darker color
 * Source: http://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_hover_color' ) ) :
	
	function hamroclass_hover_color( $hex, $steps ) {
		// Steps should be between -255 and 255. Negative = darker, positive = lighter
		$steps = max( - 255, min( 255, $steps ) );

		// Normalize into a six character long hex string
		$hex = str_replace( '#', '', $hex );
		if ( strlen( $hex ) == 3 ) {
			$hex = str_repeat( substr( $hex, 0, 1 ), 2 ) . str_repeat( substr( $hex, 1, 1 ), 2 ) . str_repeat( substr( $hex, 2, 1 ), 2 );
		}

		// Split into three parts: R, G and B
		$color_parts = str_split( $hex, 2 );
		$return      = '#';

		foreach ( $color_parts as $color ) {
			$color = hexdec( $color ); // Convert to decimal
			$color = max( 0, min( 255, $color + $steps ) ); // Adjust color
			$return .= str_pad( dechex( $color ), 2, '0', STR_PAD_LEFT ); // Make two char hex code
		}

		return $return;
	}
endif;


/*------------------------------------------------------------------------------------------------*/
/**
 * Define font awesome social media icons
 *
 * @return array();
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_font_awesome_social_icon_array' ) ) :
	function hamroclass_font_awesome_social_icon_array() {
		return array(
			"fa fa-facebook-square",
			"fa fa-facebook-f",
			"fa fa-facebook",
			"fa fa-facebook-official",
			"fa fa-twitter-square",
			"fa fa-twitter",
			"fa fa-yahoo",
			"fa fa-google",
			"fa fa-google-wallet",
			"fa fa-google-plus-circle",
			"fa fa-google-plus-official",
			"fa fa-instagram",
			"fa fa-linkedin-square",
			"fa fa-linkedin",
			"fa fa-pinterest-p",
			"fa fa-pinterest",
			"fa fa-pinterest-square",
			"fa fa-google-plus-square",
			"fa fa-google-plus",
			"fa fa-youtube-square",
			"fa fa-youtube",
			"fa fa-youtube-play",
			"fa fa-vimeo",
			"fa fa-vimeo-square",
		);
	}
endif;


if( !function_exists( 'hamroclass_get_post') ):

	function hamroclass_get_post( $args = array() ){
		$default_args = array(
			'post_type' => 'page',
			'post_status' => 'publish',
			'sort_column' => 'post_title',
			'posts_per_page' => -1,
			'orderby' => 'date',
			'order' => 'ASC',
		);
		$post_type_args = wp_parse_args( $args, $default_args );
		$post_list = get_posts( $post_type_args );
		$post_list = wp_list_pluck( $post_list, 'post_title', 'ID' );
		return $post_list;

	}

endif;


if(!function_exists('hamroclass_custom_fallback_menu')):

	function hamroclass_custom_fallback_menu(){
		?>
		<div class="menu-primary-menu-container">
			<ul id="primary-menu" class="menu">
				<li class="menu-item"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php echo esc_html_e( 'Home', 'hamroclass' ); ?></a></li>
			</ul>
		</div>
		<?php
	}

endif;