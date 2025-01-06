<?php
/**
 * Register widget area.
 */
if(!function_exists('hamroclass_homepage_widget_layout')):

    function hamroclass_homepage_widget_layout(){

        $layout = get_theme_mod( 'homepage_widget_layout', 'layout2' );
        if($layout == 'layout1' ){
            $html_layout = '<h2 class="hmc-block-title"><span class="title-wrapper">';
        }else{
            $html_layout = '<h2 class="section-title"><span class="title-wrapper">';
        }
        return $html_layout;

    }

endif;

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
if(!function_exists('hamroclass_register_sidebar') ):

    function hamroclass_register_sidebar() {

        $widget_layout = get_theme_mod( 'homepage_widget_layout', 'layout2' );

        /**
         * Register right sidebar
         *
         * @since 1.0.0
         */
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Right Sidebar', 'hamroclass' ),
                'id'            => 'hamroclass_right_sidebar',
                'description'   => esc_html__( 'Add widgets here.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget-title"><span class="title-wrapper">',
                'after_title'   => '</span></h4>',
            )
        );

        /**
         * Register left sidebar
         *
         * @since 1.0.0
         */
        register_sidebar(
            array(
                'name'          => esc_html__( 'Left Sidebar', 'hamroclass' ),
                'id'            => 'hamroclass_left_sidebar',
                'description'   => esc_html__( 'Add widgets here.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget-title"><span class="title-wrapper">',
                'after_title'   => '</span></h4>',
            )
        );

        /**
         * Header widget area
         *
         * @since 1.0.0
         */
        register_sidebar(
            array(
                'name'          => esc_html__( 'Header Branding Area', 'hamroclass' ),
                'id'            => 'hamroclass_header_branding_area',
                'description'   => esc_html__( 'Add widgets here to display header branding section.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget-title"><span class="title-wrapper">',
                'after_title'   => '</span></h4>',
            )
        );

        /**
         * Register home Content area
         *
         * @since 1.0.0
         */
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Top Home Area (Full Width)', 'hamroclass' ),
                'id'            => 'hamroclass_home_content_area',
                'description'   => esc_html__( 'Add widgets here.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget widget-'.$widget_layout.' %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => hamroclass_homepage_widget_layout(),
                'after_title'   => '</span></h2>',
            ) 
        );

        /**
         * Register home middle section area
         *
         * @since 1.0.0
         */
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Home Left Area( Middle Part )', 'hamroclass' ),
                'id'            => 'hamroclass_home_middle_section_area',
                'description'   => esc_html__( 'Add widgets here.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget widget-'.$widget_layout.' %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => hamroclass_homepage_widget_layout(),
                'after_title'   => '</span></h2>',
            ) 
        );

        /**
         * Register home middle aside area
         *
         * @since 1.0.0
         */
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Home Sidebar( Middle part ) ', 'hamroclass' ),
                'id'            => 'hamroclass_home_middle_aside_area',
                'description'   => esc_html__( 'Add widgets here.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="hmc-block-title"><span class="title-wrapper">',
                'after_title'   => '</span></h4>',
            ) 
        );

        /**
         * Register home bottom section area
         *
         * @since 1.0.0
         */
        register_sidebar( 
            array(
                'name'          => esc_html__( 'Bottom Home Area', 'hamroclass' ),
                'id'            => 'hamroclass_home_bottom_section_area',
                'description'   => esc_html__( 'Add widgets here.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget widget-'.$widget_layout.' %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => hamroclass_homepage_widget_layout(),
                'after_title'   => '</span></h2>',
            ) 
        );

        /**
         * Register 4 different footer area
         *
         * @since 1.0.0
         */
        register_sidebars( 4, 
            array(
                /* translators: %d: Sidebar ID */
                'name'          => esc_html__( 'Footer %d', 'hamroclass' ),
                'id'            => 'hamroclass_footer_sidebar',
                'description'   => esc_html__( 'Added widgets are display at Footer Widget Area.', 'hamroclass' ),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget'  => '</section>',
                'before_title'  => '<h4 class="widget-title"><span class="title-wrapper">',
                'after_title'   => '</span></h4>',
            ) 
        );
        
    }

endif;

add_action('widgets_init', 'hamroclass_register_sidebar');

if(!function_exists('hamroclass_register_widgets')):

    function hamroclass_register_widgets(){

        require_once hamroclass_file_directory('inc/widgets/functions-hamroclass-widgets.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-block-posts-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-call-to-action-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-featured-blocks-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-site-carousel-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-default-tabbed-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-our-team-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-testimonial-section-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-page-block-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-contact-form-widget.php');
        require_once hamroclass_file_directory('inc/widgets/class-tcy-video-block-widget.php');

        register_widget( 'HamroClass_Block_Posts_Widget' );
        register_widget( 'HamroClass_Call_To_Action_Widget' );
        register_widget( 'HamroClass_Featured_Blocks_Widget' );
        register_widget( 'HamroClass_Site_Carousel_Widget' );
        register_widget( 'HamroClass_Default_Tabbed_Widget' );
        register_widget( 'HamroClass_Our_Team_Widget' );
        register_widget( 'HamroClass_Testimonial_Section_Widget' );
        register_widget( 'HamroClass_Page_Block_Widget' );
        register_widget( 'Hamroclass_Contact_Form_Widget' );
        register_widget( 'Hamroclass_Video_Block_Widget' );
        
        if( class_exists('LearnPress') ){
            require_once hamroclass_file_directory('inc/widgets/class-tcy-course-search-widget.php');
            require_once hamroclass_file_directory('inc/widgets/class-tcy-course-listing-widget.php');
            register_widget( 'Hamroclass_Course_Search_Widget' );
            register_widget( 'Hamroclass_Course_Listing_Widget' );
        }

    }

endif;

add_action('widgets_init', 'hamroclass_register_widgets');