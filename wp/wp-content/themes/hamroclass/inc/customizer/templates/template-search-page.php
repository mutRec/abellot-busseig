<?php
/**
 * Search Settings
 *
 * @since 1.0.0
 */

/**
 * Image Radio field for search layout
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
	'hamroclass_search_layout',
	array(
		'default'           => 'list',
		'sanitize_callback' => 'sanitize_key',
	)
);
$wp_customize->add_control( 
	new Centurylib_Customize_Imageoptions_Control(
		$wp_customize,
		'hamroclass_search_layout',
		array(
			'label'    => esc_html__( 'Search Layouts', 'hamroclass' ),
			'description' => esc_html__( 'Choose layout from available layouts', 'hamroclass' ),
			'section'  => 'template_search_options',
			'choices'  => array(
				'classic' => array(
					'label' => esc_html__( 'Classic', 'hamroclass' ),
					'url'   => '%s/inc/centurylib/assets/img/layouts/layout6.png'
				),
				'grid' => array(
					'label' => esc_html__( 'Grid', 'hamroclass' ),
					'url'   => '%s/inc/centurylib/assets/img/layouts/layout5.png'
				),
				'list' => array(
					'label' => esc_html__( 'List', 'hamroclass' ),
					'url'   => '%s/assets/img/layout-list.png'
				),
			),
			'priority' => 20
		)
	)
);

$wp_customize->get_setting( 'centurylib_readmore_text_search' )->transport = 'postMessage';
$wp_customize->selective_refresh->add_partial( 
	'centurylib_readmore_text_search',
	array(
		'selector' => '.hmc-search-more > a',
		'render_callback' => 'hamroclass_customize_partial_search_more',
	)
);
