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
if(!class_exists( 'Hamroclass_Course_Listing_Widget' ) ):

	class Hamroclass_Course_Listing_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_course_listing_widget hmc-full-widget',
				'description' => esc_html__( 'Display courses with beautiful layout.', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_course_listing_widget', esc_html__( 'HC - Course Listing', 'hamroclass' ), $widget_ops );
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
									'centurylib_widget_field_default'  => esc_html__('Our Courses', 'hamroclass'),
									'centurylib_widget_field_description' => esc_html__( 'Enter your block title', 'hamroclass' ),
									'centurylib_widget_field_type'  => 'text'
								),
								'sub_title'         => array(
									'centurylib_widget_field_name'     => 'sub_title',
									'centurylib_widget_field_title'    => esc_html__( 'Sub Title', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'text',
									'centurylib_widget_description'    => esc_html__('Please add shortcode of contact form here.', 'hamroclass'),
								),
								'background_color'         => array(
									'centurylib_widget_field_name'     => 'background_color',
									'centurylib_widget_field_title'    => esc_html__( 'Background color', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'color',
									'centurylib_widget_description'    => esc_html__('Please add a background color for this section.', 'hamroclass'),
								),
								'no_of_courses'         => array(
									'centurylib_widget_field_name'     => 'no_of_courses',
									'centurylib_widget_field_title'    => esc_html__( 'No of courses', 'hamroclass' ),
									'centurylib_widget_field_default'  => 3,
									'centurylib_widget_field_type'     => 'number',
									'centurylib_widget_description'    => esc_html__('Please choose no of courses.', 'hamroclass'),
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
			$sub_title  = isset( $instance['sub_title'] ) ? $instance['sub_title'] : '';
			$no_of_courses  = isset( $instance['no_of_courses'] ) ? absint( $instance['no_of_courses'] ) : 3;
			$background_color = isset($instance['background_color']) ? $instance['background_color'] : '';
			centurylib_before_widget($args);
			$course_args = array(
				'post_type' => 'lp_course',
				'post_status' => 'publish',
				'posts_per_page' => absint($no_of_courses)
			);
			$course_result = new WP_Query($course_args);
			?>
			<div class="course-section" style="background-color:<?php echo esc_attr($background_color); ?>;">
				<div class="hmc-container">
					<div class="section-wrap">
						<?php if($title || $sub_title): ?>
							<div class="section-heading">
								<h4 class="section-sub_title"><?php echo esc_html($sub_title); ?></h4>
								<h2 class="section-title"><?php echo esc_html($title); ?></h2>
							</div>
							<?php
						endif;
						if( $course_result->have_posts() ) :

							do_action( 'learn-press/before-courses-loop' );

							learn_press_begin_courses_loop();

							while ( $course_result->have_posts() ) : $course_result->the_post();

								learn_press_get_template_part( 'content', 'course' );

							endwhile;

							learn_press_end_courses_loop();

							do_action( 'learn_press_after_courses_loop' );

							wp_reset_postdata();

						else:
							learn_press_display_message( esc_html__( 'No course found.', 'hamroclass' ), 'error' );
						endif;
						?>
					</div>
				</div>
			</div>
			<?php
			centurylib_after_widget($args);

	    }

	}

endif;
