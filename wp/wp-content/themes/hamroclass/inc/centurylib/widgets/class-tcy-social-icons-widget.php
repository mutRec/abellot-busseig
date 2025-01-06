<?php
/**
 * @widget_name: Social Icons Widget
 * @description: This class handles everything that needs to be handled with the widget:the settings, form, display, and update.  Nice!
 * @package: themecentury
 * @subpackage: centurylib
 * @author: themecentury
 * @author_uri: https://themecentury.com
 * @since 1.0.0
 */
class Centurylib_Social_Icons_Widget extends Centurylib_Master_Widget{
	
	public  function __construct(){

		$widget_options = array(
			'classname' => 'centurylib-social-icons',
			'description' => esc_html__( 'A Widget to display social icons.', 'hamroclass' ));
		parent::__construct('centurylib-social-icons', esc_html__( 'HC - Social Icons', 'hamroclass' ), $widget_options);	

	}

	/**
	 * Helper function that holds widget fields
	 * Array is used in update and form functions
	 */
	public function widget_fields( $instance = array() ){

        $centurylib_link_target = centurylib_link_target();

        $fields = array(
            'centurylib_widget_tab'       => array(
                'centurylib_widget_field_name'     => 'centurylib_widget_tab',
                'centurylib_widget_field_title'    => esc_html__( 'General', 'hamroclass' ),
                'centurylib_widget_field_default'  => 'general',
                'centurylib_widget_field_type'     => 'tabgroup',
                'centurylib_widget_field_options'  => array(
                    'general'=>array(
                        'centurylib_widget_field_title'=>esc_html__('General', 'hamroclass'),
                        'centurylib_widget_field_options'=> array(
                            'title'    => array(
                                'centurylib_widget_field_name'     => 'title',
                                'centurylib_widget_field_wraper'   => 'title',
                                'centurylib_widget_field_title'    => esc_html__( 'Title', 'hamroclass' ),
                                'centurylib_widget_field_default'  => esc_html__( 'Connect with us', 'hamroclass'),
                                'centurylib_widget_field_type'     => 'text',
                            ),
                            'title_target'    => array(
                                'centurylib_widget_field_name'     => 'title_target',
                                'centurylib_widget_field_wraper'   => 'title-target',
                                'centurylib_widget_field_title'    => esc_html__( 'Link Target', 'hamroclass' ),
                                'centurylib_widget_field_default'  => '_self',
                                'centurylib_widget_field_type'     => 'select',
                                'centurylib_widget_field_options'  => $centurylib_link_target,
                                'centurylib_widget_field_relation' => array(
                                    'exist' => array(
                                        'show_fields'   => array(
                                            'title-link', 
                                        ),
                                    ),
                                    'empty' => array(
                                        'hide_fields'   => array(
                                            'title-link', 
                                        ),
                                    ),
                                ),
                            ),
                            'title_link'    => array(
                                'centurylib_widget_field_name'     => 'title_link',
                                'centurylib_widget_field_wraper'   => 'title-link',
                                'centurylib_widget_field_title'    => esc_html__( 'Title link', 'hamroclass' ),
                                'centurylib_widget_field_default'  => '',
                                'centurylib_widget_field_type'     => 'text',
                            ),
                            'social_icon_size'        => array(
                                'centurylib_widget_field_name'         => 'social_icon_size',
                                'centurylib_widget_field_title'        => esc_html__( 'Icons Size', 'hamroclass' ),
                                'centurylib_widget_field_default'      => '',
                                'centurylib_widget_field_type'         => 'select',
                                'centurylib_widget_field_options'      => centurylib_faicon_sizes(),
                            ),
                            'social_media_target'        => array(
                                'centurylib_widget_field_name'         => 'social_media_target',
                                'centurylib_widget_field_title'        => esc_html__( 'Social icon open with', 'hamroclass' ),
                                'centurylib_widget_field_default'      => '_blank',
                                'centurylib_widget_field_type'         => 'select',
                                'centurylib_widget_field_options'      => $centurylib_link_target,
                            ),
                            'social_icon_list'         => array(
                                'centurylib_widget_field_name'     => 'social_icon_list',
                                'centurylib_widget_field_title'    => esc_html__( 'Social Icon List', 'hamroclass' ),
                                'centurylib_widget_field_type'     => 'repeater',
                                'centurylib_widget_description'    => esc_html__('To add social icon click to add icon.', 'hamroclass'),
                                'tcy_repeater_row_title'    => esc_html__('Social Icon', 'hamroclass'),
                                'tcy_repeater_addnew_label' => esc_html__('Add Icon', 'hamroclass'),
                                'centurylib_widget_field_default' => array(
                                    array(
                                        'social_media_link' => 'https://facebook.com/',
                                        'social_media_icon' => 'fa-facebook',
                                        'social_media_color' => '#0f233a',
                                    ),
                                    array(
                                        'social_media_link' => 'https://twitter.com/',
                                        'social_media_icon' => 'fa-twitter',
                                        'social_media_color' => '#214d74',
                                    ),
                                    array(
                                        'social_media_link' => 'https://linkedin.com/',
                                        'social_media_icon' => 'fa-linkedin',
                                        'social_media_color' => '#214d74',
                                    ),
                                ),
                                'centurylib_widget_field_options'  => array(
                                    'social_media_icon'  => array(
                                        'centurylib_widget_field_name'     => 'social_media_icon',
                                        'centurylib_widget_field_title'    => esc_html__( 'Social Media Icon', 'hamroclass' ),
                                        'centurylib_widget_field_default'  => '',
                                        'centurylib_widget_field_type'     => 'icon',
                                    ),
                                    'social_media_link' => array(
                                        'centurylib_widget_field_name'     => 'social_media_link',
                                        'centurylib_widget_field_title'    => esc_html__( 'Social Media Link', 'hamroclass' ),
                                        'centurylib_widget_field_default'  => '',
                                        'centurylib_widget_field_type'     => 'url',
                                    ),
                                    'social_media_color' => array(
                                        'centurylib_widget_field_name'     => 'social_media_color',
                                        'centurylib_widget_field_title'    => esc_html__( 'Social Icon Color', 'hamroclass' ),
                                        'centurylib_widget_field_default'  => '#00a0d2',
                                        'centurylib_widget_field_type'     => 'color',
                                    ),
                                ),
                            ),
                            
                        )
),
),
),
);

$widget_fields_key = 'fields_'.$this->id_base;
$widgets_fields = apply_filters( $widget_fields_key, $fields );
return $widgets_fields;

}

	/**
	 * Display the widget
	 */	
	function widget( $args, $instance ) {

        /*
         * Args Values
         */
        $before_title = isset( $args['before_title'] ) ? $args['before_title'] : '';
        $after_title  = isset( $args['after_title'] ) ? $args['after_title'] : '';

        $title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $title_link = isset( $instance['title_link'] ) ? esc_url($instance['title_link']) : '';
        $title_target = isset( $instance['title_target'] ) ? esc_attr($instance['title_target']) : '';
        $social_icon_size = isset( $instance['social_icon_size'] ) ? esc_attr($instance['social_icon_size']) : '';
        $social_media_target = isset( $instance['social_media_target'] ) ? esc_attr($instance['social_media_target']) : '';
        $social_icon_list = isset( $instance['social_icon_list'] ) ? $instance['social_icon_list'] : array();

		/* Before widget (defined by themes).
		 * Display the widget title if one was input (before and after defined by themes). 
		 */
		centurylib_before_widget($args);

        $title_args = array(
            'title' => $title,
            'title_target'=> $title_target,
            'title_link' => $title_link,
            'before_title'=>$before_title,
            'after_title'=>$after_title
        );
        do_action('centurylib_widget_title', $title_args);
        ?>
        <div class="social-icons">
            <?php
            foreach($social_icon_list as $index=>$social_media_details){

                $social_media_link = (isset($social_media_details['social_media_link'])) ? esc_attr($social_media_details['social_media_link']) : '';
                $social_media_icon = (isset($social_media_details['social_media_icon'])) ? esc_attr($social_media_details['social_media_icon']) : '';
                $social_media_color = (isset($social_media_details['social_media_color'])) ? esc_attr($social_media_details['social_media_color']) : '';
                ?><a 
                title="<?php esc_attr_e('HamroClass Social Media Icons', 'hamroclass'); ?>" 
                target="<?php echo esc_attr($social_media_target); ?>" 
                <?php if($social_media_target){ ?>
                    href="<?php echo esc_attr($social_media_link); ?>" 
                <?php } ?> 
                style="background-color:<?php echo esc_attr( $social_media_color ); ?>"
                ><i 
                class="fa <?php echo esc_attr($social_media_icon).' '.esc_attr($social_icon_size); ?>" 
                ></i></a><?php
            }
            ?>
        </div>
        <!-- End  social-icons -->
        <?php	
        /* After widget (defined by themes). */
        centurylib_after_widget($args);

    }

}
