<?php
/**
 * Section Preloader Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'hamroclass_image_settings',
    array(
        'title'         => esc_html__( 'Image Settings', 'hamroclass' ),
        'description'   => esc_html__( 'You can manage image related settings here.', 'hamroclass' ),
        'priority'      => 40,
        'panel'         => 'site_setting_options',
    )
);

$wp_customize->add_setting(
    'hamroclass_remove_src_set',
    array( 
        'default'           => 1,
        'sanitize_callback' => 'esc_url',
    )
);

$wp_customize->add_control(
    'hamroclass_remove_src_set',
    array(
        'type'      => 'checkbox',
        'priority'  => 10,
        'label'     => esc_html__('Remove image src set?', 'hamroclass' ),
        'section'   => 'hamroclass_image_settings',
        'settings'  => 'hamroclass_remove_src_set',
    )
);