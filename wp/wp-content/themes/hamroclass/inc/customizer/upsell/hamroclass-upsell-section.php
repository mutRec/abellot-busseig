<?php

require_once hamroclass_file_directory( 'inc/customizer/upsell/upsell-section.php' );

$wp_customize->register_section_type( 'HamroClass_Customize_Upsell_Section' );

// Register sections.
$wp_customize->add_section(
	new HamroClass_Customize_Upsell_Section(
		$wp_customize,
		'theme_upsell',
		array(
			'title'    => esc_html__( 'HamroClass Pro', 'hamroclass' ),
			'pro_text' => esc_html__( 'View Pro', 'hamroclass' ),
			'pro_url'  => 'https://themecentury.com/downloads/hamroclass-pro-premium-wordpress-plugin/?ref=hamroclass-upsell-button',
			'priority' => 1,
		)
	)
);