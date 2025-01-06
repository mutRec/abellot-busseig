<?php
/**
 * Template Search.php
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_search_options', 
    array(
        'title' => esc_html__('Search Page', 'hamroclass'),
        'panel' => 'site_template_options',
        'priority' => 60,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_breadcrumbs_search', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_breadcrumbs_search', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'hamroclass'),
            'section' => 'template_search_options',
            'settings' => 'centurylib_enable_breadcrumbs_search',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'hamroclass'),
                'disable'=> esc_html__('Disable', 'hamroclass'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before search page.', 'hamroclass'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_default_search_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Centurylib_Customize_Imageoptions_Control(
        $wp_customize,
        'centurylib_default_search_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'hamroclass' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'hamroclass' ),
            'section'  => 'template_search_options',
            'choices'  => array(
                'left_sidebar' => array(
                    'label' => esc_html__( 'Left Sidebar', 'hamroclass' ),
                    'url'   => '%s/inc/centurylib/assets/img/sidebars/left-sidebar.png'
                ),
                'right_sidebar' => array(
                    'label' => esc_html__( 'Right Sidebar', 'hamroclass' ),
                    'url'   => '%s/inc/centurylib/assets/img/sidebars/right-sidebar.png'
                ),
                'no_sidebar' => array(
                    'label' => esc_html__( 'No Sidebar', 'hamroclass' ),
                    'url'   => '%s/inc/centurylib/assets/img/sidebars/no-sidebar.png'
                ),
                'no_sidebar_center' => array(
                    'label' => esc_html__( 'No Sidebar Center', 'hamroclass' ),
                    'url'   => '%s/inc/centurylib/assets/img/sidebars/no-sidebar-center.png'
                ),
                'both_sidebar' => array(
                    'label' => esc_html__( 'Both Sidebar', 'hamroclass' ),
                    'url'   => '%s/inc/centurylib/assets/img/sidebars/both-sidebar.png'
                )
            ),
            'priority' => 20
        )
    )
);

/**
 * Read More Text Search.php 
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_readmore_text_search', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => esc_html__('Read More...', 'hamroclass'),
    )
);
$wp_customize->add_control(
    'centurylib_readmore_text_search', 
    array(
        'type'=>'text',
        'priority' => 30,
        'label' => esc_html__('Readmore Text', 'hamroclass'),
        'section' => 'template_search_options',
        'settings' => 'centurylib_readmore_text_search',
        'description'=> esc_html__('If you can show featured image on search page check on show button.', 'hamroclass'),
    )
);

/**
 * Short Description Length 
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_excerpt_length_search', array(
        'sanitize_callback' => 'absint',
        'default'           => 400,
    )
);
$wp_customize->add_control(
    'centurylib_excerpt_length_search', 
    array(
        'type'=>'number',
        'priority' => 40,
        'label' => esc_html__('Description Length', 'hamroclass'),
        'section' => 'template_search_options',
        'settings' => 'centurylib_excerpt_length_search',
        'description'=> esc_html__('Please choose no of character to display description length in search page.', 'hamroclass'),
    )
);

/**
 * Enable Post Date
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_date_search', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_date_search', 
        array(
            'label' => esc_html__('Show date on posts?', 'hamroclass'),
            'section' => 'template_search_options',
            'priority' => 50,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show post date on search page please check show button.', 'hamroclass'),
        )
    )
);

/**
 * Enable Author Name
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_authorname_search', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_authorname_search', 
        array(
            'label' => esc_html__('Show author name on posts?', 'hamroclass'),
            'section' => 'template_search_options',
            'priority' => 60,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show author name on search page please check show button.', 'hamroclass'),
        )
    )
);
