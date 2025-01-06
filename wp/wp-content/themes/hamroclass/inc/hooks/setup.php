<?php
/**
 * hamroclass functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if (!function_exists('hamroclass_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function hamroclass_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on hamroclass, use a find and replace
         * to change 'hamroclass' to the name of your theme in all the template files.
         */
        load_theme_textdomain('hamroclass', get_template_directory() . '/languages');

        /*
         * Add post format support
         */
        add_theme_support( 
            'post-formats',
            array( 
                'aside', 
                'gallery',
                'link',
                'image',
                'quote',
                'status',
                'video',
                'audio',
                'chat'
            )
        );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5', 
            array(
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        // Add theme support for Custom Logo.
        add_theme_support(
            'custom-logo', 
            array(
                'width' => 300,
                'height' => 45,
                'flex-width' => true,
                'flex-height' => true,
            )
        );

        $header_image_args = array(
            'default-image'          => '',
            'flex-height'            => true,
            'flex-width'             => true,
            'uploads'                => true,
            'random-default'         => false,
            'header-text'            => true,
            'video'                  => true,
        );
        add_theme_support( 'custom-header', $header_image_args );

        // Set up the WordPress core custom background feature.
        add_theme_support(
            'custom-background', 
            apply_filters(
                'hamroclass_custom_background_args', 
                array(
                    'default-color'          => '#fff',
                    'default-image'          => '',
                    'default-repeat'         => 'no-repeat',
                    'default-position-x'     => 'center',
                    'default-position-y'     => 'center',
                    'default-size'           => 'cover',
                    'default-attachment'     => 'fixed',
                )
            )
        );

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        // Declare WooCommerce support
        $woocommerce_settings = apply_filters(
            'hamroclass_woocommerce_args',
            array(
                'single_image_width'            => 555,
                'thumbnail_image_width'         => 262,
                'gallery_thumbnail_image_width' => 160,
                'product_grid'                  => array(
                    'default_columns' => 3,
                    'default_rows'    => 4,
                    'min_columns'     => 1,
                    'max_columns'     => 6,
                    'min_rows'        => 1,
                ),
            )
        );
        add_theme_support( 'woocommerce', $woocommerce_settings );

        if ( class_exists( 'WooCommerce', false ) ) {
            add_theme_support( 'wc-product-gallery-zoom' );
            add_theme_support( 'wc-product-gallery-lightbox' );
            add_theme_support( 'wc-product-gallery-slider' );
        }

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');

        add_image_size('hamroclass-thumb-300x200', 300, 200, true);
        add_image_size('hamroclass-thumb-300x300', 300, 300, true);
        add_image_size('hamroclass-thumb-400x600', 400, 600, true);
        add_image_size('hamroclass-thumb-500x365', 500, 365, true);
        add_image_size('hamroclass-thumb-600x600', 600, 600, true);
        add_image_size('hamroclass-thumb-800x600', 800, 600, true);
        add_image_size('hamroclass-thumb-1200x500', 1200, 500, true);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'hamroclass_top_menu' => esc_html__('Top Menu', 'hamroclass'),
            'hamroclass_primary_menu' => esc_html__('Primary Menu', 'hamroclass'),
            'hamroclass_footer_menu' => esc_html__('Footer Menu', 'hamroclass')
        ));

        add_editor_style( hamroclass_fonts_url() );

        add_editor_style( get_template_directory_uri() . '/assets/css/editor-style.css' );

        $remove_src_set = get_theme_mod( 'hamroclass_remove_src_set', 1 );

        if($remove_src_set){
            add_filter( 'wp_calculate_image_srcset', '__return_false' );
        }

    }

endif;

add_action('after_setup_theme', 'hamroclass_setup');

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function hamroclass_content_width()
{
    $GLOBALS['content_width'] = apply_filters('hamroclass_content_width', 640);
}

add_action('after_setup_theme', 'hamroclass_content_width', 0);

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Set the theme version
 *
 * @global int $hamroclass_version
 * @since 1.0.0
 */
function hamroclass_theme_version()
{
    $hamroclass_theme_info = wp_get_theme();
    $GLOBALS['hamroclass_version'] = $hamroclass_theme_info->get('Version');
}

add_action('after_setup_theme', 'hamroclass_theme_version', 10);

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function hamroclass_pingback_header()
{
    if (is_singular() && pings_open()) {
        echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
    }
}

add_action('wp_head', 'hamroclass_pingback_header');

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles for only admin
 *
 * @since 1.0.0
 */
function hamroclass_admin_scripts( $hook ) {

    global $hamroclass_version;

    wp_enqueue_style( 'hamroclass-admin-style', get_template_directory_uri() . '/assets/css/hmc-admin-style.min.css', array(), esc_attr( $hamroclass_version ) );

    if ( 'widgets.php' != $hook && 'customize.php' != $hook && 'edit.php' != $hook && 'post.php' != $hook && 'post-new.php' != $hook ) {
        return;
    }

    wp_enqueue_script( 'jquery-ui-button' );

    wp_enqueue_script( 'hamroclass-admin-script', get_template_directory_uri() . '/assets/js/admin.min.js', array( 'jquery' ), esc_attr( $hamroclass_version ), true );
    
}

add_action( 'admin_enqueue_scripts', 'hamroclass_admin_scripts' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Enqueue scripts and styles.
 *
 * @since 1.0.0
 */
function hamroclass_enqueue_scripts(){

    global $hamroclass_version;

    wp_enqueue_style( 'hamroclass-fonts', hamroclass_fonts_url(), array(), null );

    wp_enqueue_style( 'font-awesome', centurylib_assets_url('library/font-awesome/css/font-awesome.min.css'), array(), '4.7.0');

    wp_enqueue_style( 'lightslider-style', get_template_directory_uri() . '/assets/vendor/lightslider/css/lightslider.min.css', array(), '1.1.6' );

    wp_enqueue_style( 'magnific-popup-style', get_template_directory_uri() . '/assets/vendor/magnific-popup/css/magnific-popup.min.css', array(), '1.1.0' );

    wp_enqueue_style( 'hamroclass-main', get_template_directory_uri() . '/assets/css/hamroclass.min.css', array(), esc_attr( $hamroclass_version ) );
    wp_style_add_data( 'hamroclass-main', 'rtl', 'replace' );

    wp_enqueue_style( 'hamroclass-style', get_stylesheet_uri(), array(), esc_attr( $hamroclass_version ) );

    wp_enqueue_script( 'hamroclass-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), esc_attr( $hamroclass_version ), true );

    $menu_sticky_option = get_theme_mod( 'hamroclass_menu_sticky_option', 'show' );
    if ( $menu_sticky_option == 'show' ) {
        wp_enqueue_script( 'jquery-sticky', get_template_directory_uri() . '/assets/vendor/sticky/jquery.sticky.js', array( 'jquery' ), '20150416', true );

        wp_enqueue_script( 'hmc-sticky-menu-setting', get_template_directory_uri() . '/assets/vendor/sticky/sticky-setting.js', array( 'jquery-sticky' ), '20150309', true );
    }

    wp_enqueue_script( 'hamroclass-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.min.js', array(), esc_attr( $hamroclass_version ), true );

    wp_enqueue_script( 'lightslider', get_template_directory_uri() . '/assets/vendor/lightslider/js/lightslider.min.js', array( 'jquery' ), '1.1.6', true );

    wp_enqueue_script( 'jquery-ui-tabs' );

    wp_enqueue_script( 'magnific-popup-js', get_template_directory_uri() . '/assets/vendor/magnific-popup/js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );

    wp_enqueue_script( 'hamroclass-custom-script', get_template_directory_uri() . '/assets/js/main.min.js', array( 'jquery' ), esc_attr( $hamroclass_version ), true );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
}

add_action( 'wp_enqueue_scripts', 'hamroclass_enqueue_scripts', 20 );

