<?php
/**
 * Template Index.php
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_index_options', 
    array(
        'title' => esc_html__('Blog/Home Page', 'hamroclass'),
        'panel' => 'site_template_options',
        'priority' => 50,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_breadcrumbs_index', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'disable',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_breadcrumbs_index', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'hamroclass'),
            'section' => 'template_index_options',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'hamroclass'),
                'disable'=> esc_html__('Disable', 'hamroclass'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before blog page.', 'hamroclass'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_default_index_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Centurylib_Customize_Imageoptions_Control(
        $wp_customize,
        'centurylib_default_index_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'hamroclass' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'hamroclass' ),
            'section'  => 'template_index_options',
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
 * Read More Text Index.php 
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_readmore_text_index', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => esc_html__('Read More...', 'hamroclass'),
    )
);
$wp_customize->add_control(
    'centurylib_readmore_text_index', 
    array(
        'type'=>'text',
        'priority' => 30,
        'label' => esc_html__('Readmore Text', 'hamroclass'),
        'section' => 'template_index_options',
        'description'=> esc_html__('If you can show featured image on blog page check on show button.', 'hamroclass'),
    )
);

/**
 * Short Description Length 
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_excerpt_length_index', array(
        'sanitize_callback' => 'absint',
        'default'           => 400,
    )
);
$wp_customize->add_control(
    'centurylib_excerpt_length_index', 
    array(
        'type'=>'number',
        'priority' => 40,
        'label' => esc_html__('Description Length', 'hamroclass'),
        'section' => 'template_index_options',
        'description'=> esc_html__('Please choose no of character to display description length in blog page.', 'hamroclass'),
    )
);

/**
 * Enable Post Date
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_date_index', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_date_index', 
        array(
            'label' => esc_html__('Show date on posts?', 'hamroclass'),
            'section' => 'template_index_options',
            'priority' => 50,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show post date on blog page please check show button.', 'hamroclass'),
        )
    )
);

/**
 * Enable Author Name
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_authorname_index', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_authorname_index', 
        array(
            'label' => esc_html__('Show author name on posts?', 'hamroclass'),
            'section' => 'template_index_options',
            'priority' => 60,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show author name on blog page please check show button.', 'hamroclass'),
        )
    )
);
