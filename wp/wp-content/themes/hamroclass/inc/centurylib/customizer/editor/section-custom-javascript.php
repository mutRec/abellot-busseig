<?php
/*
 * Additional JS
 */
$section_description  = '<p>';
$section_description .= esc_html__( 'Add your own JS code here to customize the appearance and layout of your site.', 'hamroclass' );
$section_description .= '</p>';

$section_description .= '<p id="editor-keyboard-trap-help-1">' . esc_html__( 'When using a keyboard to navigate:', 'hamroclass' ) . '</p>';
$section_description .= '<ul>';
$section_description .= '<li id="editor-keyboard-trap-help-2">' . esc_html__( 'In the editing area, the Tab key enters a tab character.', 'hamroclass' ) . '</li>';
$section_description .= '<li id="editor-keyboard-trap-help-3">' . esc_html__( 'To move away from this area, press the Esc key followed by the Tab key.', 'hamroclass' ) . '</li>';
$section_description .= '<li id="editor-keyboard-trap-help-4">' . esc_html__( 'Screen reader users: when in forms mode, you may need to press the escape key twice.', 'hamroclass' ) . '</li>';
$section_description .= '</ul>';

if ( 'false' !== wp_get_current_user()->syntax_highlighting ) {
	$section_description .= '<p>';
	$section_description .= sprintf(
		/* translators: 1: link to user profile, 2: additional link attributes, 3: accessibility text */
		__( 'The edit field automatically highlights code syntax. You can disable this in your <a href="%1$s" %2$s>user profile%3$s</a> to work in plain text mode.', 'hamroclass' ),
		esc_url( get_edit_profile_url() ),
		'class="external-link" target="_blank"',
		sprintf(
			'<span class="screen-reader-text"> %s</span>',
			/* translators: accessibility text */
			esc_html__( '(opens in a new tab)', 'hamroclass' )
		)
	);
	$section_description .= '</p>';
}

$section_description .= '<p class="section-description-buttons">';
$section_description .= '<button type="button" class="button-link section-description-close">' . esc_html__( 'Close', 'hamroclass' ) . '</button>';
$section_description .= '</p>';

$wp_customize->add_section(
	'additional_js_section',
	array(
		'title'              => esc_html__( 'Additional JS', 'hamroclass' ),
		'priority'           => 20,
		'panel'				=> 'site_code_editor',
		'description_hidden' => true,
		'description'        => $section_description,
	)
);
$wp_customize->add_setting(
	'custom_javascript_code',
	array(
		'type' => 'option',
		'sanitize_callback' => 'centurylib_sanitize_javascript',
	)
);
$wp_customize->add_control(
	new WP_Customize_Code_Editor_Control(
		$wp_customize,
		'custom_javascript_code',
		array(
			'label'       => esc_html__( 'Additional JS', 'hamroclass' ),
			'section'     => 'additional_js_section',
			'code_type'   => 'javascript',
			'input_attrs' => array(
				'aria-describedby' => 'editor-keyboard-trap-help-1 editor-keyboard-trap-help-2 editor-keyboard-trap-help-3 editor-keyboard-trap-help-4',
			),
		)
	)
);