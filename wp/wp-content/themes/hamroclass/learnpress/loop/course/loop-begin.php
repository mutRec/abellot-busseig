<?php
/**
 * Template for displaying wrap start of archive course within the loop.
 *
 * This template can be overridden by copying it to yourtheme/learnpress/loop/course/loop-begin.php.
 *
 * @author  ThimPress
 * @package  Learnpress/Templates
 * @version  3.0.0
 */

/**
 * Prevent loading this file directly
 */
defined( 'ABSPATH' ) || exit();

$course_template = apply_filters( 'hamroclass_learpress_course_listing_template', 'layout1' );

?>

<ul class="learn-press-courses <?php echo esc_attr('course-'.$course_template); ?>">
