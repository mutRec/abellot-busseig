<?php
/**
 * EDM: Banner Ads
 *
 * Widget show the banner ads of different size
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if(!class_exists( 'HamroClass_Call_To_Action_Widget' ) ):

	class HamroClass_Call_To_Action_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_call_to_action_widget hmc-full-widget',
				'description' => esc_html__( 'Call to action widget', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_call_to_action_widget', __( 'HC - Call to Action', 'hamroclass' ), $widget_ops );
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
									'centurylib_widget_field_name'       => 'title',
									'centurylib_widget_field_default'  => esc_html__( 'Enter the title', 'hamroclass' ),
									'centurylib_widget_field_title'      => esc_html__( 'Title', 'hamroclass' ),
									'centurylib_widget_field_type' => 'text'
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
								'cta_heading' => array(
									'centurylib_widget_field_name'       => 'cta_heading',
									'centurylib_widget_field_title'      => esc_html__( 'CTA Heading', 'hamroclass' ),
									'centurylib_widget_field_type' => 'text',
									'centurylib_widget_field_default'  => esc_html__( 'Enter your heading text.', 'hamroclass'),
								),
								'background_color' => array(
									'centurylib_widget_field_name'       => 'background_color',
									'centurylib_widget_field_title'      => esc_html__( 'Select background color', 'hamroclass' ),
									'centurylib_widget_field_type' => 'color',
								),
								'background_image' => array(
									'centurylib_widget_field_name'       => 'background_image',
									'centurylib_widget_field_title'      => esc_html__( 'Select background image', 'hamroclass' ),
									'centurylib_widget_field_type' => 'upload',
								),
								'is_parallax'    => array(
									'centurylib_widget_field_name'       => 'is_parallax',
									'centurylib_widget_field_title'      => esc_html__( 'Enable parallax', 'hamroclass' ),
									'centurylib_widget_field_type' => 'checkbox'
								),
								'description'    => array(
									'centurylib_widget_field_name'       => 'description',
									'centurylib_widget_field_title'      => esc_html__( 'Description', 'hamroclass' ),
									'centurylib_widget_field_type' => 'textarea',
									'centurylib_widgets_row' => 5,
									'centurylib_widget_field_default'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Lobortis scelerisque fermentum dui faucibus in. Mollis nunc sed id semper risus. Tincidunt praesent semper feugiat nibh sed. Massa enim nec dui nunc mattis enim ut.', 'hamroclass')
								),
								'button_text'    => array(
									'centurylib_widget_field_name'       => 'button_text',
									'centurylib_widget_field_title'      => esc_html__( 'Button Text', 'hamroclass' ),
									'centurylib_widget_field_type' => 'text',
									'centurylib_widget_field_default'  => esc_html__( 'View More', 'hamroclass'),
								),
								'button_target' => array(
									'centurylib_widget_field_name'       => 'button_target',
									'centurylib_widget_field_title'      => esc_html__( 'Open in new tab', 'hamroclass' ),
									'centurylib_widget_field_type' => 'select',
									'centurylib_widget_field_default'  => '_self',
									'centurylib_widget_field_options' => centurylib_link_target(),
									'centurylib_widget_field_relation' => array(
                                        'exist' => array(
                                            'show_fields'   => array(
                                                'cta-button-link', 
                                            ),
                                        ),
                                        'empty' => array(
                                            'hide_fields'   => array(
                                                'cta-button-link', 
                                            ),
                                        ),
                                    ),
								),
								'button_url'     => array(
									'centurylib_widget_field_name'       => 'button_url',
									'centurylib_widget_field_title'      => esc_html__( 'Button Link', 'hamroclass' ),
									'centurylib_widget_field_type' => 'url',
									'centurylib_widget_field_default'  => '#',
									'centurylib_widget_field_wraper'   => 'cta-button-link',
								)
							)
						),
						'layout'=>array(
							'centurylib_widget_field_title'=>esc_html__('Layout', 'hamroclass'),
							'centurylib_widget_field_options'=> array(
								'cta_layout' => array(
									'centurylib_widget_field_name'       => 'cta_layout',
									'centurylib_widget_field_title'      => esc_html__( 'CTA Layout', 'hamroclass' ),
									'centurylib_widget_field_type' => 'select',
									'centurylib_widget_field_default' => 'layout1',
									'centurylib_widget_field_options' => array(
										'layout1'	=> esc_html__( 'Layout One', 'hamroclass' ),
										'layout2'	=> esc_html__( 'Layout Two', 'hamroclass' ),
									),
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

			$cta_layout  = isset( $instance['cta_layout'] ) ? esc_attr($instance['cta_layout']) : 'layout1';			
			centurylib_before_widget($args);

			if($cta_layout == 'layout2' ){
				$this->layout_two($args, $instance);
			}else{
				$this->layout_one( $args, $instance );	
			}	
			
			centurylib_after_widget($args);

		}

		public function layout_two($args, $instance){

			extract( $args );

			$title  = isset( $instance['title'] ) ? $instance['title'] : '';
			$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $title_target      = isset( $instance['title_target'] ) ? $instance['title_target']: '';
            $title_link  = isset( $instance['title_link'] ) ? $instance['title_link'] : '';
			$cta_heading    = isset( $instance['cta_heading'] ) ? $instance['cta_heading'] : '';
			$background_color = isset( $instance['background_color'] ) ? $instance['background_color'] : '';
			$background_image = isset( $instance['background_image'] ) ? $instance['background_image'] : '';
			$is_parallax    = isset( $instance['is_parallax'] ) ? true : '';
			$description    = isset( $instance['description'] ) ? $instance['description'] : '';
			$button_url     = isset( $instance['button_url'] ) ? $instance['button_url'] : '';
			$button_text    = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
			$button_target  = isset( $instance['button_target'] ) ? $instance['button_target'] : '';
			?>
			<div class="cta-section" style="background-image:url(<?php echo esc_url($background_image); ?>); background-color: <?php echo esc_attr($background_color); ?>;">
				<div class="hmc-container">
					<div class="section-wrap">
						<div class="subtitle-wrap">
							<h4 class="section-sub_title"><?php echo esc_html( $cta_heading ) ?></h4>
						</div>
						<div class="title-desc-wrap">
							<h2 class="section-title">
								<?php 
								if($title){
									if($title_target){
										?><a href="<?php echo esc_url($title_link); ?>" target="<?php echo esc_attr($title_target); ?>"><?php
									}
									echo $title;
									if($title_target){
										?></a><?php
									}
								}
								?>
							</h2>
							<p><?php echo esc_html( $description ); ?></p>
						</div>
						<div class="button-wrap">
							<a class="read-more" href="<?php echo esc_url($button_url); ?>" target="<?php echo esc_attr($button_target); ?>" ><?php echo esc_html($button_text); ?></a>
						</div>
					</div>
				</div>
			</div>
			<?php
		}

		public function layout_one($args, $instance){

			extract( $args );

			$title  = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
			$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $title_target      = isset( $instance['title_target'] ) ? esc_html( $instance['title_target'] ) : '';
            $title_link  = isset( $instance['title_link'] ) ? esc_html( $instance['title_link'] ) : '';
			$cta_heading    = isset( $instance['cta_heading'] ) ? $instance['cta_heading'] : '';
			$background_color = isset( $instance['background_color'] ) ? $instance['background_color'] : '';
			$background_image = isset( $instance['background_image'] ) ? $instance['background_image'] : '';
			$is_parallax    = isset( $instance['is_parallax'] ) ? true : '';
			$description    = isset( $instance['description'] ) ? $instance['description'] : '';
			$button_url     = isset( $instance['button_url'] ) ? $instance['button_url'] : '';
			$button_text    = isset( $instance['button_text'] ) ? $instance['button_text'] : '';
			$button_target  = isset( $instance['button_target'] ) ? '_blank' : '_self';

			$title_tag_name = 'h4';
			$main_widget_areas = array(
				'hamroclass_home_content_area',
				'hamroclass_home_middle_section_area',
				'hamroclass_home_bottom_section_area',
			);
			$widget_area_id = ($args['id']) ? $args['id'] : '';
			if(in_array($widget_area_id, $main_widget_areas)){
				$title_tag_name = 'h2';
			}
			?>
			<div class="hmc-cta-wrapper">
				<div class="hmc-cta-content <?php echo esc_attr( $is_parallax ) ? 'parallax' : ''; ?> <?php echo esc_attr( $background_image ) ? 'has-overlay' : 'no-overlay'; ?>"
					style="background-image:url(<?php echo esc_url($background_image); ?>); background-color: <?php echo esc_attr($background_color); ?>;">
					<div class="hmc-container">
						<?php 
						if($title){
							?><<?php echo esc_attr($title_tag_name); ?> class="section-title"><?php
							if($title_target){
								?><a href="<?php echo esc_url($title_link); ?>" target="<?php echo esc_attr($title_target); ?>"><?php
							}
							echo $title;
							if($title_target){
								?></a><?php
							}
							?></<?php echo esc_attr($title_tag_name); ?>><?php
						}
						?>
						<?php
						if ( ! empty( $cta_heading ) ) {
							?><h4 class="hmc-cta-heading"><?php echo esc_html( $cta_heading ) ?></h4>
							<?php
						}
						?>
						<p><?php echo esc_html( $description ); ?></p>
						<?php
						if ( ! empty( $button_url ) ) {
							?>
							<a 
							class="button button-primary cta-button" 
							href="<?php echo esc_url( $button_url ); ?>"
							target="<?php echo esc_attr( $button_target ); ?>">
							<?php echo esc_html( $button_text ) ?>
						</a>
						<?php
					}
					?>
				</div>
			</div>
		</div><!-- .hmc-ads-wrapper -->
		<?php

	}

}
endif;