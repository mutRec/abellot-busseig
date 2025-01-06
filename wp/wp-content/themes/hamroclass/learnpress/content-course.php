<?php
/**
 * Template for displaying course content within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/content-course.php
 *
 * @author  ThimPress
 * @package LearnPress/Templates
 * @version 3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();
$post_type = get_post_type(get_the_ID());
if($post_type== 'lp_course' ){
    $user = LP_Global::user();
    ?>
    <li id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="course-inner">
            <?php
            // @deprecated
            do_action( 'learn_press_before_courses_loop_item' );

            // @since 3.0.0
            do_action( 'learn-press/before-courses-loop-item' );

            // @deprecated
            do_action( 'learn_press_courses_loop_item_title' );

            // @since 3.0.0
            do_action( 'learn-press/courses-loop-item-title' );

            // @since 3.0.0
            do_action( 'learn-press/after-courses-loop-item' );

	       // @deprecated
            do_action( 'learn_press_after_courses_loop_item' );
            ?>
        </div>
    </li>
    <?php
}
