<?php
/**
 * Template Post
 * @package themecentury
 * @subpackage centurylib
 * @since 1.0.0
 */
$wp_customize->add_section(
    'template_post_options', 
    array(
        'title' => esc_html__('Post Options', 'hamroclass'),
        'panel' => 'site_template_options',
        'priority' => 20,
    )
);

/**
 * Enable Breadcrumbs
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_breadcrumbs_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'enable',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_breadcrumbs_post', 
        array(
            'label' => esc_html__('Enable Breadcrumbs?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 10,
            'type'=>'switch',
            'choices'=> array(
                'enable'=> esc_html__('Enable', 'hamroclass'),
                'disable'=> esc_html__('Disable', 'hamroclass'),
            ),
            'description'=> esc_html__('You can enable breadcrumbs to show before post details.', 'hamroclass'),
        )
    )
);

/**
 * Enable Reactions
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_default_post_sidebar',
    array(
        'default'           => 'right_sidebar',
        'sanitize_callback' => 'sanitize_key',
    )
);
$wp_customize->add_control( 
    new Centurylib_Customize_Imageoptions_Control(
        $wp_customize,
        'centurylib_default_post_sidebar',
        array(
            'label'    => esc_html__( 'Sidebar Layout', 'hamroclass' ),
            'description' => esc_html__( 'Choose sidebar from available layouts', 'hamroclass' ),
            'section'  => 'template_post_options',
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
    'centurylib_enable_featured_image_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_featured_image_post', 
        array(
            'label' => esc_html__('Show Featured Image?', 'hamroclass'),
            'section' => 'template_post_options',
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

/**
 * Enable Categories
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_categories_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_categories_post', 
        array(
            'label' => esc_html__('Show Categories?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 40,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show categories list of related post on post details please check show button.', 'hamroclass'),
        )
    )
);

/**
 * Enable Post Date
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_date_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_date_post', 
        array(
            'label' => esc_html__('Show date on post?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 50,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show post date on post details please check show button.', 'hamroclass'),
        )
    )
);

/**
 * Enable Author Name
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_authorname_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_authorname_post', 
        array(
            'label' => esc_html__('Show author name on post?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 60,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show author name on post details please check show button.', 'hamroclass'),
        )
    )
);


/**
 * Enable Tagged
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_tags_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_enable_tags_post', 
        array(
            'label' => esc_html__('Show tags name on post?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 70,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show tags name on post details please check show button.', 'hamroclass'),
        )
    )
);

/**
 * Enable Prev and Next post on single post
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_prev_next_button_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_prev_next_button_post', 
        array(
            'label' => esc_html__('Show before and after post link on post?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 80,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show before and after post link on post details please check show button.', 'hamroclass'),
        )
    )
);

/**
 * Enable author info
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_author_info_post', array(
        'sanitize_callback' => 'esc_attr',
        'default'           => 'show',
    )
);
$wp_customize->add_control(
    new Centurylib_Customize_Switch_Control(
        $wp_customize, 
        'centurylib_author_info_post', 
        array(
            'label' => esc_html__('Show author info on post?', 'hamroclass'),
            'section' => 'template_post_options',
            'priority' => 90,
            'type'=>'switch',
            'choices'=> array(
                'show'=> esc_html__('Show', 'hamroclass'),
                'hide'=> esc_html__('Hide', 'hamroclass'),
            ),
            'description'=> esc_html__('If you can show author info on post details please check show button.', 'hamroclass'),
        )
    )
);


/**
 * Related Posts
 *
 * @since 1.0.0
 */
$wp_customize->add_setting(
    'centurylib_enable_related_posts',
    array(
        'default' => 'show',
        'sanitize_callback' => 'esc_attr',
    )
);


$wp_customize->add_control( 
    new Centurylib_Customize_Switch_Control(
        $wp_customize,
        'centurylib_enable_related_posts',
        array(
            'type'      => 'switch',
            'label'     => esc_html__( 'Related Post Option', 'hamroclass' ),
            'description'   => esc_html__( 'Show/Hide option for related posts section at single post page.', 'hamroclass' ),
            'section'   => 'template_post_options',
            'choices'   => array(
                'show'  => esc_html__( 'Show', 'hamroclass' ),
                'hide'  => esc_html__( 'Hide', 'hamroclass' )
            ),
            'priority'  => 110,
        )
    )
);
$wp_customize->add_setting(
    'centurylib_related_posts_title',
    array(
        'default'    => esc_html__( 'Related Posts', 'hamroclass' ),
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'centurylib_related_posts_title',
    array(
        'type'      => 'text',
        'label'     => esc_html__( 'Related Post Title', 'hamroclass' ),
        'section'   => 'template_post_options',
        'priority'  => 120
    )
);

$wp_customize->add_setting(
    'centurylib_related_posts_from',
    array(
        'default'    => 'category',
        'sanitize_callback' => 'esc_attr'
    )
);
$wp_customize->add_control(
    'centurylib_related_posts_from',
    array(
        'type'      => 'select',
        'label'     => esc_html__( 'Related Posts from?', 'hamroclass' ),
        'section'   => 'template_post_options',
        'priority'  => 130,
        'choices'   => centurylib_taxonomy_list( 'post' ),
    )
);