<?php
/**
 * Template Archive
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_notfound_options', 
    array(
        'title' => esc_html__('404 Options', 'hamroclass'),
        'panel' => 'site_template_options',
        'priority' => 70,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_breadcrumbs_notfound', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_breadcrumbs_notfound', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'hamroclass'),
            'section' => 'template_notfound_options',
            'settings' => 'centurylib_enable_breadcrumbs_notfound',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'hamroclass'),
                'disable'=> esc_html__('Disable', 'hamroclass'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before notfound page.', 'hamroclass'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_default_notfound_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Centurylib_Customize_Imageoptions_Control(
        $wp_customize,
        'centurylib_default_notfound_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'hamroclass' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'hamroclass' ),
            'section'  => 'template_notfound_options',
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
 * 404 Page Title
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_notfound_page_title', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => esc_html__( 'Oops! That page cant be found.', 'hamroclass'),
    )
);
$wp_customize->add_control(
    'centurylib_notfound_page_title', 
    array(
        'type'=>'text',
        'priority' => 30,
        'label' => esc_html__('404 Page Title', 'hamroclass'),
        'section' => 'template_notfound_options',
        'settings' => 'centurylib_notfound_page_title',
        'description'=> esc_html__('Please enter title to display on 404 page.', 'hamroclass'),
    )
);

/**
 * 404 Page Title
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_notfound_page_description', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => esc_html__( 'It looks like nothing was found at this location. Maybe try a search?', 'hamroclass'),
    )
);
$wp_customize->add_control(
    'centurylib_notfound_page_description', 
    array(
        'type'=>'text',
        'priority' => 40,
        'label' => esc_html__('404 Page Description', 'hamroclass'),
        'section' => 'template_notfound_options',
        'settings' => 'centurylib_notfound_page_description',
        'description'=> esc_html__('Please enter description to display on 404 page.', 'hamroclass'),
    )
);