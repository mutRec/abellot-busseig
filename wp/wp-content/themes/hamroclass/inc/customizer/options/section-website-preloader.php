<?php
/**
 * Section Preloader Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'hamroclass_wesbsite_preloader',
    array(
        'title'         => esc_html__( 'Preloader for Website', 'hamroclass' ),
        'description'   => esc_html__( 'Choose a Image For Website Preloader', 'hamroclass' ),
        'priority'      => 30,
        'panel'         => 'site_setting_options',
    )
);

$wp_customize->add_setting(
    'hamroclass_preloader_image',
    array( 
        'default'           => '',
        'sanitize_callback' => 'esc_url',
    )
);

$wp_customize->add_control(
    new WP_Customize_Image_Control(
        $wp_customize,
        'hamroclass_preloader_image',
        array(
            'priority'      => 10,
            'label'      => esc_html__('Upload preloader image', 'hamroclass' ),
           'section'    => 'hamroclass_wesbsite_preloader',
           'settings'   => 'hamroclass_preloader_image',
       )
    )    
);