<?php
/**
 * Template Post
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_page_options', 
    array(
        'title' => esc_html__('Page Options', 'hamroclass'),
        'panel' => 'site_template_options',
        'priority' => 30,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_breadcrumbs_page', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_breadcrumbs_page', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'hamroclass'),
            'section' => 'template_page_options',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'hamroclass'),
                'disable'=> esc_html__('Disable', 'hamroclass'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before page details.', 'hamroclass'),
        )
    )
);

/**
 * Sidebar Layouts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_default_page_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Centurylib_Customize_Imageoptions_Control(
        $wp_customize,
        'centurylib_default_page_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'hamroclass' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'hamroclass' ),
            'section'  => 'template_page_options',
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
 * Enable Featured Image
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_featured_image_page', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_featured_image_page', 
        array(
            'label' => esc_html__('Show Featured Image?', 'hamroclass'),
            'section' => 'template_page_options',
            'priority' => 30,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show featured image on single page check on show button.', 'hamroclass'),
        )
    )
);


