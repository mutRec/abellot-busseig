<?php
/**
 * Title and tagline checkbox
 *
 * @since 1.0.0
 */
$title_tagline = $wp_customize->get_section('title_tagline');
$title_tagline->priority = 70;
$wp_customize->add_setting(
    'hamroclass_branding_option',
    array(
        'default' => 'officeinfo',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize,
        'hamroclass_branding_option',
        array(
            'priority'    => 70,
            'label' => esc_html__( 'Display on branding section.', 'hamroclass' ),
            'section' => 'title_tagline',
            'type' => 'switch',
            'choices' => array(
                'officeinfo' => esc_html__( 'Office Details', 'hamroclass' ),
                'sidebar' => esc_html__( 'Widget Area', 'hamroclass' ),
            ),
        )
    )
);

$wp_customize->add_setting(
    'harmoclass_branding_alignment',
    array(
        'default' => 'left',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize,
        'harmoclass_branding_alignment',
        array(
            'priority'    => 80,
            'label' => esc_html__( 'Branding alignment', 'hamroclass' ),
            'section' => 'title_tagline',
            'type' => 'switch',
            'choices' => array(
                'left' => esc_html__( 'Left', 'hamroclass' ),
                'center' => esc_html__( 'Center', 'hamroclass' ),
            ),
        )
    )
);

$wp_customize->add_setting(
    'hamroclass_show_branding_header',
    array(
        'default' => 'enable',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize,
        'hamroclass_show_branding_header',
        array(
            'priority'    => 90,
            'label' => esc_html__( 'Enable Branding?', 'hamroclass' ),
            'section' => 'title_tagline',
            'type' => 'switch',
            'choices' => array(
                'enable' => esc_html__( 'Enable', 'hamroclass' ),
                'disable' => esc_html__( 'Disable', 'hamroclass' ),
            ),
        )
    )
);