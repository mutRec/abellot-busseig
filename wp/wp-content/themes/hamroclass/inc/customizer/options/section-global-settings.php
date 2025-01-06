<?php
/**
 * Section Global Settings
 *
 * @since 1.0.0
 */
$wp_customize->add_section(
    'hamroclass_global_settings_section',
    array(
        'title'         => esc_html__( 'Global Settings', 'hamroclass' ),
        'description'   => esc_html__( 'Choose a site to display your website more effectively.', 'hamroclass' ),
        'priority'      => 10,
        'panel'         => 'site_setting_options',
    )
);

$wp_customize->add_setting(
    'hamroclass_site_layout',
    array(
        'default'           => 'hmc_fullwidth_layout',
        'sanitize_callback' => 'sanitize_hamroclass_site_layout',
    )
);
$wp_customize->add_control(
    'hamroclass_site_layout',
    array(
        'type' => 'radio',
        'priority'    => 10,
        'label' => esc_html__( 'Site Layout', 'hamroclass' ),
        'section' => 'hamroclass_global_settings_section',
        'choices' => array(
            'hmc_fullwidth_layout'   => esc_html__( 'Full Width', 'hamroclass' ),
            'hmc_boxed_width_layout' => esc_html__( 'Box Width', 'hamroclass' )
     ),
    )
);
