<?php
/**
 * Template for displaying thumbnail of course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/thumbnail.php.
 *
 * @author   ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.1
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course = LP_Global::course();
?>

<div class="course-thumbnail">
	<a href="<?php the_permalink(); ?>" class="course-permalink">
		<?php 
		$featured_image_data = $course->get_image( 'hamroclass-thumb-500x365' );
		echo apply_filters( 'hamroclass_learnpress_thumbnail', $featured_image_data );
		?>
	</a>
	<?php learn_press_get_template( 'single-course/buttons.php' ); ?>
	<?php learn_press_get_template( 'loop/course/price.php' ); ?>
</div>

<?php
do_action( 'hamroclass_learnpress_course_featured_icon' );
