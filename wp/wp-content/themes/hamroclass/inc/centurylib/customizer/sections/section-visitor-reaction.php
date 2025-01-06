<?php
/**
 * Visitor Reactions Section
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'visitor_reaction_section', 
    array(
        'title' => esc_html__('Visitor Reactions', 'hamroclass'),
        'panel' => 'site_additional_sections',
        'priority' => 20,
        'description' => esc_html__('Set reaction format and display visitor reactions in perentage and number.', 'hamroclass'),
    )
);

/**
 * Visitor Reaction Heading
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'visitor_reaction_heading', array(
        'default' => esc_html__('Share your feeling about this article.', 'hamroclass'),
        'sanitize_callback' => 'esc_html',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Control(
        $wp_customize,
        'visitor_reaction_heading',
        array(
            'label'    => esc_html__( 'Reactions Heading', 'hamroclass' ),
            'section'  => 'visitor_reaction_section',
            'settings' => 'visitor_reaction_heading',
            'type'     => 'text',
            'priority' => 10,
        )
    )
);

/**
 * Visitor Reaction Type
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'display_reaction_value', array(
        'default' => 'percentage',
        'sanitize_callback' => 'esc_attr',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Control(
        $wp_customize,
        'display_reaction_value',
        array(
            'label'    => esc_html__( 'Display Reactions Type', 'hamroclass' ),
            'description' => esc_html__('Choose display reaction type.', 'hamroclass'),
            'section'  => 'visitor_reaction_section',
            'settings' => 'display_reaction_value',
            'type'     => 'select',
            'priority' => 10,
            'choices'  => array(
                'percentage' => esc_html__( 'Percentage', 'hamroclass' ),
                'total_number' => esc_html__( 'Total Values', 'hamroclass' ),
            ),
        )
    )
);

/**
 * Repeater field for social media icons
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_reaction_icons', 
    array(
        'sanitize_callback' => 'centurylib_sanitize_repeater_data',
        'default' => '',
    )
);
$wp_customize->add_control(
    new Centurylib_Customizer_Repeater_Control(
        $wp_customize, 
        'centurylib_reaction_icons', 
        array(
            'label' => esc_html__('Visitor reaction icons.', 'hamroclass'),
            'section' => 'visitor_reaction_section',
            'settings' => 'centurylib_reaction_icons',
            'priority' => 20,
            'add_row_label' => esc_html__('Add Reaction', 'hamroclass'),
            'wraper_item_label' => esc_html__('Reaction Details', 'hamroclass'),
        ), 
        array(
            'reaction_icon_name' => array(
                'type' => 'reaction',
                'label' => esc_html__('Reaction Icon', 'hamroclass'),
                'description' => esc_html__('Choose reaction icon.', 'hamroclass')
            ),
            'reaction_icon_title' => array(
                'type' => 'text',
                'label' => esc_html__('Reaction Title', 'hamroclass'),
                'description' => esc_html__('Enter reaction title here.', 'hamroclass')
            ),

        )
    )
);
