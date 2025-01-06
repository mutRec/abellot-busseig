<?php
/**
 * Widget: Testimonail Widget
 *
 * Widget show the posts from selected categories in carousel layouts.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if( !class_exists( 'HamroClass_Testimonial_Section_Widget' ) ):

	class HamroClass_Testimonial_Section_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct(){

			$widget_ops = array(
				'classname'   => 'hamroclass_testimonial_section_widget hmc-full-widget',
				'description' => esc_html__( 'Displays testimonial from repeater data.', 'hamroclass' ),
				'customize_selective_refresh' => true,
			);
			parent::__construct( 'hamroclass_testimonial_section_widget', esc_html__( 'HC - Testimonial Section', 'hamroclass' ), $widget_ops );

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
									'centurylib_widget_field_title'       => esc_html__( 'Block title', 'hamroclass' ),
									'centurylib_widget_field_default'  => esc_html__( 'Client Testimonials', 'hamroclass' ),
									'centurylib_widget_field_description' => esc_html__( 'Enter your block title. (Optional - Leave blank to hide title.)', 'hamroclass' ),
									'centurylib_widget_field_type'  => 'text'
								),
								'title_target'    => array(
									'centurylib_widget_field_name'     => 'title_target',
									'centurylib_widget_field_wraper'   => 'title-target',
									'centurylib_widget_field_title'    => esc_html__( 'Title Target', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type'     => 'select',
									'centurylib_widget_field_options'  => centurylib_link_target(),
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
								'background_image'    => array(
									'centurylib_widget_field_name'     => 'background_image',
									'centurylib_widget_field_wraper'   => 'background-section',
									'centurylib_widget_field_title'    => esc_html__( 'Background Image', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type'     => 'upload',
								),
								'background_overlay' => array(
									'centurylib_widget_field_name'     => 'background_overlay',
									'centurylib_widget_field_title'    => esc_html__( 'Background Overlay', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type'     => 'color',
								),
								'overlay_opacity' => array(
									'centurylib_widget_field_name'     => 'overlay_opacity',
									'centurylib_widget_field_title'    => esc_html__( 'Overlay Opacity', 'hamroclass' ),
									'centurylib_widget_field_default'  => '0.3',
									'centurylib_widget_field_type'     => 'number',
									'centurylib_widget_field_attrs'   => array(
										'min'=> 0,
										'max'=> 1,
										'step' => 0.1,
									),
								),
								'testimonial_list'         => array(
									'centurylib_widget_field_name'     => 'testimonial_list',
									'centurylib_widget_field_title'    => esc_html__( 'Testimonial List', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'repeater',
									'centurylib_widget_description'    => esc_html__('To add client testimonial click to add testimonial.', 'hamroclass'),
									'tcy_repeater_row_title'    => esc_html__('Testimonial Details', 'hamroclass'),
									'tcy_repeater_addnew_label' => esc_html__('Add Testimonial', 'hamroclass'),
									'centurylib_widget_field_wraper'   => 'testimonial-list-wrapper',
									'centurylib_widget_field_default'  => array(
										array(
											'client_name'		=> esc_html__( 'Name One', 'hamroclass' ),
											'client_position'	=> esc_html__( 'Position One', 'hamroclass' ),
											'client_words'		=> esc_html__( 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
											'client_image'		=> '',
										),
										array(
											'client_name'		=> esc_html__( 'Name Two', 'hamroclass' ),
											'client_position'	=> esc_html__( 'Position Two', 'hamroclass' ),
											'client_words'		=> esc_html__( 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
											'client_image'		=> '',
										),
										array(
											'client_name'		=> esc_html__( 'Nmae Three', 'hamroclass' ),
											'client_position'	=> esc_html__( 'Position Three', 'hamroclass' ),
											'client_words'		=> esc_html__( 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
											'client_image'		=> '',
										),
										array(
											'client_name'		=> esc_html__( 'Name Four', 'hamroclass' ),
											'client_position'	=> esc_html__( 'Position Four', 'hamroclass' ),
											'client_words'		=> esc_html__( 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
											'client_image'		=> '',
										),
									),
									'centurylib_widget_field_options'  => array(
										'client_name' => array(
											'centurylib_widget_field_name'     => 'client_name',
											'centurylib_widget_field_title'    => esc_html__( 'Client Name', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'text',
										),
										'client_position' => array(
											'centurylib_widget_field_name'     => 'client_position',
											'centurylib_widget_field_title'    => esc_html__( 'Client Position', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'text',
										),
										
										'client_words' => array(
											'centurylib_widget_field_name'     => 'client_words',
											'centurylib_widget_field_title'    => esc_html__( 'Client Words', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widgets_row'		   => 7,
											'centurylib_widget_field_type'     => 'textarea',
										),
										'client_image' => array(
											'centurylib_widget_field_name'     => 'client_image',
											'centurylib_widget_field_title'    => esc_html__( 'Client Image', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'upload',
										),
									),
								),
							)
						),
						'layout'=>array(
							'centurylib_widget_field_title'=>esc_html__('Layout', 'hamroclass'),
							'centurylib_widget_field_options'=> array(
								'no_of_column' => array(
									'centurylib_widget_field_name'          => 'no_of_column',
									'centurylib_widget_field_title'         => esc_html__( 'No of column', 'hamroclass' ),
									'centurylib_widget_field_default'  => 2,
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_options' => array(
										'1' => esc_html__('Column One', 'hamroclass'),
										'2' => esc_html__('Column Two', 'hamroclass'),
										'3' => esc_html__('Column Three', 'hamroclass'),
									),
								),
								'testimonial_layout' => array(
									'centurylib_widget_field_name'          => 'testimonial_layout',
									'centurylib_widget_field_title'         => esc_html__( 'Testimonial Layout', 'hamroclass' ),
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_default'  => 'layout2',
									'centurylib_widget_field_options' => array(
										'layout1' => esc_html__('Layout One', 'hamroclass'),
										'layout2' => esc_html__('Layout Two', 'hamroclass'),
									),
								),
							)
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
		
			if ( empty( $instance ) ) {
				return;
			}

			$before_title = (isset($args['before_title'])) ? $args['before_title'] : '';
			$after_title = (isset($args['after_title'])) ? $args['after_title'] : '';
			$before_widget = (isset($args['before_widget'])) ? $args['before_widget'] : '';
			$after_widget = (isset($args['after_widget'])) ? $args['after_widget'] : '';

			/*
			 * General Tab
			 */
			$title  = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
			$title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$title_target      = isset( $instance['title_target'] ) ? esc_html( $instance['title_target'] ) : '';
			$title_link  = isset( $instance['title_link'] ) ? esc_html( $instance['title_link'] ) : '';
			$total_posts_show  = isset( $instance['total_posts_show'] ) ? absint($instance['total_posts_show']) : 6;
			$background_image  = isset( $instance['background_image'] ) ? esc_url($instance['background_image']) : '';
			$background_overlay  = isset( $instance['background_overlay'] ) ? esc_url($instance['background_overlay']) : '';
			$overlay_opacity  = isset( $instance['overlay_opacity'] ) ? esc_attr($instance['overlay_opacity']) : '';			
			$testimonial_list  = isset( $instance['testimonial_list'] ) ? $instance['testimonial_list'] : array();

            /*
			 * Layout Tab
			 */
            $testimonial_layout  = isset( $instance['testimonial_layout'] ) ? $instance['testimonial_layout'] : 'layout2';
            $no_of_column  = isset( $instance['no_of_column'] ) ? absint($instance['no_of_column']) : 2;
            centurylib_before_widget($args);
            ?>
            <div class="hamroclass-testimonial-wrapper" style="background-image:url('<?php echo esc_url($background_image); ?>');">
            	<span class="testimonial-overlay" style="background-color: <?php echo esc_attr($background_overlay); ?>; opacity: <?php esc_attr($overlay_opacity); ?>;">&nbsp;</span>
            	<div class="hmc-container">
            		<?php
            		$title_args = array(
            			'title' => $title,
            			'title_target'	=> $title_target,
            			'title_link'	=> $title_link,
            			'before_title'	=> $before_title,
            			'after_title'	=> $after_title
            		);
            		do_action('centurylib_widget_title', $title_args);

            		$testimonial_class = 'column'.$no_of_column.' '.$testimonial_layout;

            		$testimonial_list = apply_filters( 'hamroclass_widget_testimonials_list', $testimonial_list, $instance, $args, $this );

            		$this->testimonials_list_template( $testimonial_list, $testimonial_class, $instance, $args );
            		
            		?>
            	</div>
            </div>
            <?php
            centurylib_after_widget($args);

        }

        public function testimonials_list_template($testimonial_list, $testimonial_class, $instance, $args ){
        	if($testimonial_list):
        		?>
        		<ul class="hamroclass-testimonial-list <?php echo esc_attr( $testimonial_class ); ?>">
        			<?php 
        			foreach($testimonial_list as $testimonial_detail){
        				$client_name = (isset($testimonial_detail['client_name'])) ? $testimonial_detail['client_name'] : '';
        				$client_position = (isset($testimonial_detail['client_position'])) ? $testimonial_detail['client_position'] : '';
        				$client_words = (isset($testimonial_detail['client_words'])) ? $testimonial_detail['client_words'] : '';
        				$client_image = (isset($testimonial_detail['client_image'])) ? $testimonial_detail['client_image'] : '';
        				?>
        				<li>
        					<div class="testimonial-container">
        						<div class="client-words">
        							<p><?php echo esc_textarea($client_words); ?></p>
        						</div>
        						<div class="client-logo-details-wrap">
        							<figure class="client-logo">
        								<img src="<?php echo esc_url($client_image); ?>" title="" alt=""/>
        							</figure>
        							<div class="client-details">
        								<span class="client-name"><?php echo esc_html($client_name); ?></span>
        								<span class="client-position"><?php echo esc_html($client_position); ?></span>
        							</div>
        						</div>
        					</div>
        				</li>
        			<?php } ?>
        		</ul>
        		<?php
        	endif;
        }

    }

endif;