<?php
/**
 * EDM: Page Block
 *
 * Widget show the banner ads of different size
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if(!class_exists( 'HamroClass_Page_Block_Widget' ) ):

	class HamroClass_Page_Block_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_page_block_widget hmc-full-widget',
				'description' => esc_html__( 'Call to action widget', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_page_block_widget', esc_html__( 'HC - Page Block', 'hamroclass' ), $widget_ops );
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
								'block_page_id' => array(
									'centurylib_widget_field_name'       => 'block_page_id',
									'centurylib_widget_field_title'      => esc_html__( 'Choose Page', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type' => 'pagelist',
								),
								'thumbnail_size' => array(
									'centurylib_widget_field_name'       => 'thumbnail_size',
									'centurylib_widget_field_title'      => esc_html__( 'Page thumbnail size', 'hamroclass' ),
									'centurylib_widget_field_default'  => 'full',
									'centurylib_widget_field_type' => 'select',
									'centurylib_widget_field_options'   => centurylib_get_image_sizes(),
								),
								'readmore_text' => array(
									'centurylib_widget_field_name'       => 'readmore_text',
									'centurylib_widget_field_title'      => esc_html__( 'Readmore Button Text', 'hamroclass' ),
									'centurylib_widget_field_default'  => esc_html__( 'Read More', 'hamroclass' ),
									'centurylib_widget_field_type' => 'text',
								),
								'primary_button_text' => array(
									'centurylib_widget_field_name'       => 'primary_button_text',
									'centurylib_widget_field_title'      => esc_html__( 'Primary Button Text', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type' => 'text',
								),
								'primary_button_url' => array(
									'centurylib_widget_field_name'       => 'primary_button_url',
									'centurylib_widget_field_title'      => esc_html__( 'Primary Button url', 'hamroclass' ),
									'centurylib_widget_field_default'  => '#',
									'centurylib_widget_field_type' => 'url',
								),
								'background_color' => array(
									'centurylib_widget_field_name'       => 'background_color',
									'centurylib_widget_field_title'      => esc_html__( 'Background color', 'hamroclass' ),
									'centurylib_widget_field_default'  => '#fff',
									'centurylib_widget_field_type' => 'color',
								),
								'background_image' => array(
									'centurylib_widget_field_name'       => 'background_image',
									'centurylib_widget_field_title'      => esc_html__( 'Background Image', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type' => 'upload',
								),
							)
						)
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
           
            $block_page_id  = isset( $instance['block_page_id'] ) ? $instance['block_page_id'] : '';
            $thumbnail_size  = isset( $instance['thumbnail_size'] ) ? $instance['thumbnail_size'] : 'full';
            $readmore_text  = isset( $instance['readmore_text'] ) ? $instance['readmore_text'] : '';
            $primary_button_text  = isset( $instance['primary_button_text'] ) ? $instance['primary_button_text'] : '';
            $primary_button_url  = isset( $instance['primary_button_url'] ) ? $instance['primary_button_url'] : '';
            $background_color  = isset( $instance['background_color'] ) ? sanitize_hex_color( $instance['background_color'] ) : '';        
            $background_image  = isset( $instance['background_image'] ) ? esc_url( $instance['background_image'] ) : '';

			$page_args = array(
				'post_type' 	=> 'page',
				'post_status' 	=> 'publish',
				'posts_per_page' => 1,
			);
			if($block_page_id){
				$page_args['p'] = absint($block_page_id);
			}
			$page_result = new WP_Query($page_args);
			centurylib_before_widget($args);

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
			<div class="about-us-wrapper" style="background-color: <?php echo esc_attr($background_color); ?>; background-image:url(<?php echo esc_url($background_image); ?>);">
				<div class="hmc-container">
					<div class="row about-content-media-wrap">
						<?php 
						if($page_result->have_posts()){
							while($page_result->have_posts()):
								$page_result->the_post();
								?>
								<div class="about-content-part <?php echo (has_post_thumbnail( get_the_ID() )) ? 'has-thumbnail' : 'no-thumbnail';  ?>">
									<div class="about-content-inner">
										<div class="about-block-title">
											<<?php echo esc_attr($title_tag_name); ?>><?php the_title(); ?></<?php echo esc_attr($title_tag_name); ?>>
										</div>
										<?php centurylib_the_excerpt(350, false ); ?>
										<div class="about-btns-wrap buttons-wrap">
											<?php if($readmore_text){ ?>
												<a class="custom-button button-secondary" href="<?php the_permalink(); ?>"><?php echo esc_html($readmore_text); ?></a>
											<?php } ?>
											<?php if($primary_button_text){ ?>
												<a class="custom-button button-primary" href="<?php echo esc_url($primary_button_url); ?>"><?php echo esc_html($primary_button_text); ?></a>
											<?php } ?>
										</div>
									</div> 
								</div>
								<?php if(has_post_thumbnail( get_the_ID() )): ?>
									<div class="about-media-part" style="">
										<figure class="page-thumbnail-wrap">
											<?php the_post_thumbnail( $thumbnail_size ); ?>
										</figure>
									</div>
									<?php
								endif;
							endwhile;
							wp_reset_postdata();
						}
						?>
					</div>
				</div>
			</div>
			<?php
			centurylib_after_widget($args);

		}

	}

endif;