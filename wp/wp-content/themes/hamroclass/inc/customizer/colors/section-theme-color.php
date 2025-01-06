<?php
/**
 * Color option for theme
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'hamroclass_theme_color',
    array(
        'default'     => '#0f233a',
        'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control(
        $wp_customize,
        'hamroclass_theme_color',
        array(
            'label'      => esc_html__( 'Theme Color', 'hamroclass' ),
            'section'    => 'colors',
            'priority'   => 20
        )
    )
);
