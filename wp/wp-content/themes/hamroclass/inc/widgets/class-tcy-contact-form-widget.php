<?php
/**
 * Widget: Block Partner
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
if(!class_exists( 'Hamroclass_Contact_Form_Widget' ) ):

	class Hamroclass_Contact_Form_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_contact_form_widget hmc-full-widget',
				'description' => esc_html__( 'Display contact form with beautiful layout.', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_contact_form_widget', esc_html__( 'HC - Contact Form', 'hamroclass' ), $widget_ops );
		}

		/**
		 * Helper function that holds widget fields
		 * Array is used in update and form functions
		 */
		public function widget_fields( $instance = array() ) {

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
								'title' => array(
									'centurylib_widget_field_name'        => 'title',
									'centurylib_widget_field_default'  => esc_html__( 'Enter contact form title.', 'hamroclass' ),
									'centurylib_widget_field_title'       => esc_html__( 'Section Title', 'hamroclass' ),
									'centurylib_widget_field_description' => esc_html__( 'Enter your block title', 'hamroclass' ),
									'centurylib_widget_field_type'  => 'text'
								),
								'form_shortcode'         => array(
									'centurylib_widget_field_name'     => 'form_shortcode',
									'centurylib_widget_field_title'    => esc_html__( 'Form Shortcode', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'text',
									'centurylib_widget_description'    => esc_html__('Please add shortcode of contact form here.', 'hamroclass'),
								),
								'background_color'         => array(
									'centurylib_widget_field_name'     => 'background_color',
									'centurylib_widget_field_title'    => esc_html__( 'Background color', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'color',
									'centurylib_widget_description'    => esc_html__('Please add a background color for this section.', 'hamroclass'),
								),
								'background_image'         => array(
									'centurylib_widget_field_name'     => 'background_image',
									'centurylib_widget_field_title'    => esc_html__( 'Background Image', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'upload',
									'centurylib_widget_description'    => esc_html__('Please add a background image for this section.', 'hamroclass'),
								),
							),
						),
					)
				)
			);

			$widget_fields_key = 'fields_'.$this->id_base;
			$widgets_fields = apply_filters( $widget_fields_key, $fields );
			return $widgets_fields;

		}

		/**
		 * Front-end display of widget.
		 *
		 * @see WP_Widget::widget()
		 *
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {

			extract( $args );
			if ( empty( $instance ) ) {
				return;
			}
			$title  = isset( $instance['title'] ) ? $instance['title'] : '';
			$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$form_shortcode = isset($instance['form_shortcode']) ? $instance['form_shortcode'] : '';
			$background_color = isset($instance['background_color']) ? $instance['background_color'] : '';
			$background_image = isset($instance['background_image']) ? $instance['background_image'] : '';
	        centurylib_before_widget($args);
	        ?>
	        <div class="apply-now-section" style="background-color:<?php echo esc_attr($background_color); ?>;background-image:url('<?php echo esc_url($background_image); ?>'); background-size: cover">	
	        	<div class="apply-now-wrap">
	        		<div class="apply-now-left"><?php echo esc_html($title); ?></div>
	        		<div class="apply-now-right">
	        			<?php echo do_shortcode($form_shortcode); ?>
	        		</div>
	        	</div>
	        </div>
	        <?php
	        centurylib_after_widget($args);
	    }

	}

endif;