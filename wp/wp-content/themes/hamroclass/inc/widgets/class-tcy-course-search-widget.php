<?php
/**
 * Widget: Course Search
 *
 * Widget to show course 
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
if(!class_exists( 'Hamroclass_Course_Search_Widget' ) ):

	class Hamroclass_Course_Search_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_course_search_widget hmc-full-widget',
				'description' => esc_html__( 'Add video block from widget on frontend widgetarea.', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_course_search_widget', esc_html__( 'HC - Course Search', 'hamroclass' ), $widget_ops );
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
									'centurylib_widget_field_title'       => esc_html__( 'Section Title', 'hamroclass' ),
									'centurylib_widget_field_default'  => esc_html__('Search Courses', 'hamroclass'),
									'centurylib_widget_field_description' => esc_html__( 'Enter your block title', 'hamroclass' ),
									'centurylib_widget_field_type'  => 'text'
								),
								'sub_title' => array(
									'centurylib_widget_field_name'        => 'sub_title',
									'centurylib_widget_field_title'       => esc_html__( 'Sub Title', 'hamroclass' ),
									'centurylib_widget_field_description' => esc_html__( 'Enter your sub title', 'hamroclass' ),
									'centurylib_widget_field_type'  => 'text'
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
			if( empty( $instance ) ){
				return;
			}
			$title  = isset( $instance['title'] ) ? $instance['title'] : '';
			$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$sub_title = isset($instance['sub_title']) ? $instance['sub_title'] : '';
			$background_image = isset($instance['background_image']) ? $instance['background_image'] : '';
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
			<div class="course-search" style="background-image:url('<?php echo esc_url($background_image); ?>'); background-size: cover;">
				<div class="container">
					<div class="section-wrap">
						<div class="section-heading">
							<<?php echo esc_attr($title_tag_name); ?> class="section-title"><span><?php echo esc_html($title); ?></span></<?php echo esc_attr($title_tag_name); ?>>
							<h4 class="section-sub_title"><?php echo esc_html($sub_title); ?></h4>
						</div>
						<div class="section-content-wrap">
							<form action="<?php echo esc_url(home_url()); ?>">
								<input type="hidden" name="post_type" value="lp_course"/>
								<span>
									<?php
									$course_args = array(
										'id'		=> '',
										'name'		=> 'course_category',
										'hide_empty' => false,
										'taxonomy' => 'course_category',
										'show_option_all' => esc_html__( 'All Courses', 'hamroclass' )
									);
									wp_dropdown_categories($course_args);
									?>
								</span>
								<span>
									<input type="text" class="course_keyword" placeholder="<?php esc_attr_e( 'Courses Keyword', 'hamroclass'); ?>" name="s">
								</span>
								<span><input type="submit" value="<?php esc_attr_e( 'Search Courses', 'hamroclass' ); ?>"></span>
							</form>
						</div>
					</div>
				</div>
			</div>
			<?php
			centurylib_after_widget($args);
		}

	}

endif;