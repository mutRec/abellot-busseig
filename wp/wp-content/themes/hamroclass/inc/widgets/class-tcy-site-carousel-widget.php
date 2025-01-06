<?php
/**
 * Widget: Carousel
 *
 * Widget show the posts from selected categories in carousel layouts.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if( !class_exists( 'HamroClass_Site_Carousel_Widget' ) ):

	class HamroClass_Site_Carousel_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {

			$widget_ops = array(
				'classname'   => 'hamroclass_site_carousel_widget hmc-full-widget',
				'description' => esc_html__( 'Displays posts from selected categories in carousel layouts.', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_site_carousel_widget', esc_html__( 'HC - Site Carousel', 'hamroclass' ), $widget_ops );

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
								'block_term_ids' => array(
									'centurylib_widget_field_name'          => 'block_term_ids',
									'centurylib_widget_field_title'         => esc_html__( 'Block Categories', 'hamroclass' ),
									'centurylib_widget_field_type'   => 'multitermlist',
									'centurylib_widget_taxonomy_type' => 'category',
								),
								'total_posts_show' => array(
									'centurylib_widget_field_name'          => 'total_posts_show',
									'centurylib_widget_field_title'         => esc_html__( 'No of post to show', 'hamroclass' ),
									'centurylib_widget_field_default'  => 6,
									'centurylib_widget_field_type'   => 'number',
								),
								'no_of_column' => array(
									'centurylib_widget_field_name'          => 'no_of_column',
									'centurylib_widget_field_title'         => esc_html__( 'No of column', 'hamroclass' ),
									'centurylib_widget_field_default'  => 3,
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_options' => array(
										'1' => esc_html__('Column One', 'hamroclass'),
										'2' => esc_html__('Column Two', 'hamroclass'),
										'3' => esc_html__('Column Three', 'hamroclass'),
										'4' => esc_html__('Column Four', 'hamroclass'),
									),
								),
								'excerpt_length' => array(
                                	'centurylib_widget_field_name'         => 'excerpt_length',
                                	'centurylib_widget_field_title'        => esc_html__( 'Description Length', 'hamroclass' ),
                                	'centurylib_widget_field_default'      => '150',
                                	'centurylib_widget_field_type'   => 'number',
                                	'centurylib_widget_field_description'  => esc_html__( 'Enter the short description length in character.', 'hamroclass'),
                                ),
                                'thumbnail_size' => array(
									'centurylib_widget_field_name'         => 'thumbnail_size',
									'centurylib_widget_field_title'        => esc_html__( 
										'Thumbnail Image Size', 'hamroclass' ),
									'centurylib_widget_field_default'=> 'hamroclass-thumb-600x600',
									'centurylib_widget_field_type' => 'select',
									'centurylib_widget_field_options'   => centurylib_get_image_sizes(),
								),
							)
						),
						'layout'=>array(
							'centurylib_widget_field_title'=>esc_html__('Layout', 'hamroclass'),
							'centurylib_widget_field_options'=> array(
								'carousel_layout' => array(
									'centurylib_widget_field_name'          => 'carousel_layout',
									'centurylib_widget_field_title'         => esc_html__( 'Carousel Layout', 'hamroclass' ),
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_default'  => 'layout2',
									'centurylib_widget_field_options' => array(
										'layout1' => esc_html__('Layout One', 'hamroclass'),
										'layout2' => esc_html__('Layout Two', 'hamroclass'),
									),
								),
								'enable_navigation' => array(
									'centurylib_widget_field_name'          => 'enable_navigation',
									'centurylib_widget_field_title'         => esc_html__( 'Enable Navigation', 'hamroclass' ),
									'centurylib_widget_field_type'   => 'checkbox',
									'centurylib_widget_field_default'  => 1
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
	
			/*
			 * Title Section
			 */			
			$before_title = (isset($args['before_title'])) ? $args['before_title'] : '';
			$after_title = (isset($args['after_title'])) ? $args['after_title'] : '';

			/*
			 * General Tab
			 */
			$title  = isset( $instance['title'] ) ? esc_html( $instance['title'] ) : '';
            $title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $title_target      = isset( $instance['title_target'] ) ? esc_html( $instance['title_target'] ) : '';
            $title_link  = isset( $instance['title_link'] ) ? esc_html( $instance['title_link'] ) : '';
            $block_term_ids  = isset( $instance['block_term_ids'] ) ? $instance['block_term_ids'] : '';
            $total_posts_show  = isset( $instance['total_posts_show'] ) ? absint($instance['total_posts_show']) : 6;
            $no_of_column  = isset( $instance['no_of_column'] ) ? absint($instance['no_of_column']) : 3;
            $excerpt_length  = isset( $instance['excerpt_length'] ) ? absint($instance['excerpt_length']) : 0;
            $thumbnail_size  = isset( $instance['thumbnail_size'] ) ? esc_attr($instance['thumbnail_size']) : 'hamroclass-thumb-600x600';

            /*
			 * Layout Tab
			 */
            $carousel_layout  = isset( $instance['carousel_layout'] ) ? $instance['carousel_layout'] : 'layout2';
            $enable_navigation  = isset( $instance['enable_navigation'] ) ? absint($instance['enable_navigation']) : 0;

			$hamroclass_block_args   = array(
				'query_args' => array(
					'post_type'	=> 'post',
					'posts_per_page' => absint( $total_posts_show )
				),
				'carousel_settings'		=> array(
					'thumbnail_size'	=> $thumbnail_size,
					'no_of_column'		=> $no_of_column,
					'excerpt_length'	=> $excerpt_length,
				),
			);
			if($block_term_ids){
				$hamroclass_block_args['query_args']['tax_query'][] = array(
					array(
						'taxonomy' => 'category',
						'field'    => 'term_id',
						'terms'    => $block_term_ids,
					),
				);
			}

			centurylib_before_widget($args);
			?>
			<div class="hmc-container">
				<div data-layout="<?php echo esc_attr( $carousel_layout ); ?>"
					class="hmc-block-wrapper hmc-carousel-posts hmc-clearfix <?php echo esc_attr( $carousel_layout ); ?>">
					<div class="hmc-block-title-nav-wrap">
						<?php
						$title_args = array(
							'title' => $title,
							'title_target'	=> $title_target,
							'title_link'	=> $title_link,
							'before_title'	=> $before_title,
							'after_title'	=> $after_title,
						);
						do_action('centurylib_widget_title', $title_args);
						?>
					</div> <!-- hmc-full-width-title-nav-wrap -->
					<div class="hmc-block-posts-wrapper">
						<?php hamroclass_carousel_layout_section( $hamroclass_block_args ); ?>
						<?php if($enable_navigation): ?>
							<div class="carousel-nav-action">
								<div class="hmc-navPrev carousel-controls"><i class="fa fa-angle-left"></i></div>
								<div class="hmc-navNext carousel-controls"><i class="fa fa-angle-right"></i></div>
							</div>
						<?php endif; ?>
					</div><!-- .hmc-block-posts-wrapper -->
				</div><!--- .hmc-block-wrapper -->
			</div>
			<?php
			centurylib_after_widget($args);
		}

	}

endif;