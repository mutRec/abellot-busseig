<?php
/*
 * @package themecentury
 * @subpackage hamroclass
 * @version 1.0.0
 */
$default_value = array( );
$default_slider_details = apply_filters( 'hamroclass_default_banner_slider_details', $default_value );
$slider_details = apply_filters( 'hamroclass_banner_slider_details', $default_slider_details );

if ( empty( $slider_details ) ) {
	return;
}

$other_details			= $slider_details['other_details'];
$posttype   			= $other_details['post_type'];
$readmore_text			= $other_details['readmore_text'];
$transition_effect  	= $other_details['transition_effect'];
$enable_description		= $other_details['enable_description'];
$arrow_layout 			= $other_details['arrow_layout'];
$enable_autoplay		= $other_details['enable_autoplay'];
$enable_overlay			= $other_details['enable_overlay'];
$transition_duration	= $other_details['transition_duration'];
$transition_delay		= $other_details['transition_delay'];
$thumbnail_size			= $other_details['thumbnail_size'];
$description_length		= $other_details['description_length'];

$banner_slide_items = $slider_details['slides'];

if(empty($banner_slide_items) ){
	return;
}

$slide_data = array(
	'item'					=> 1,
	'mode'					=> esc_attr($transition_effect),
	'speed'					=> absint($transition_duration)*1000,
	'loop'					=> true,
	'controls'				=> false,
	'slideMove'				=> 1,
	//'useCSS'				=> false,
	//'autoWidth'				=> true,
	'slideMargin'			=> 0,
	'pager'					=> false,
	'pause'					=> absint($transition_delay)*1000,
	'enableDrag'			=> false,
	'enableTouch'			=> false,
	'auto'					=> ($enable_autoplay) ? true : false,
);

$overlay_class = ( $enable_overlay ) ? 'overlay-enabled' : 'overlay-disabled';
?>
<div class="main-banner-slider-wrapper">
	<div class="hamroclass-banner-nav">
		<?php 
		if ( $arrow_layout && $arrow_layout!='disable' ) : ?>
			<div class="cycle-prev <?php echo esc_attr($arrow_layout); ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></div>
			<div class="cycle-next <?php echo esc_attr($arrow_layout); ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></div>
			<?php 
		endif;
		?>
	</div>
	<div class="cycle-slideshow hamroclass-main-banner <?php echo esc_attr( $overlay_class ); ?>" data-carousel="<?php echo esc_attr(json_encode($slide_data)); ?>">
		<?php
		$banner_slider_args = array(
			'post_type' 		=> $posttype,
			'post_status' 		=> 'publish',
			'posts_per_page' 	=> 1,
			'p' 				=> 0,
		);
		foreach ( $banner_slide_items as $key => $slide ): 
			
			$posttype_item 		= $slide['post_type_item'];
			$description_alignment 	= $slide['description_alignment'];
			$primary_button_label 	= $slide['primary_button_label'];
			$primary_button_url 	= $slide['primary_button_url'];
			$primary_button_target 	= $slide['primary_button_target'];
			$secondary_button_label = $slide['secondary_button_label'];
			$secondary_button_url 	= $slide['secondary_button_url'];
			$secondary_button_target= $slide['secondary_button_target'];
			$slide_item_target 		= '_self';

			if(!$posttype_item){
				continue;
			}

			$banner_slider_args['p'] = $posttype_item;
			$banner_slide_post = new WP_Query($banner_slider_args);

			while( $banner_slide_post->have_posts() ): 

				$banner_slide_post->the_post();
				// Buttons stuff.
				$buttons_markup        = '';
				if ( ! empty( $primary_button_label ) || ! empty( $secondary_button_label ) ) {
					$buttons_markup .= '<div class="buttons-wrap">';
					if ( ! empty( $primary_button_label ) ) {
						$buttons_markup .= '<a href="' . esc_url( $primary_button_url ) . '" class="custom-button slider-button button-primary">' . esc_html( $primary_button_label ) . '</a>';
					}
					if ( ! empty( $secondary_button_label ) ) {
						$buttons_markup .= '<a href="' . esc_url( $secondary_button_url ) . '" class="custom-button slider-button button-secondary">' . esc_html( $secondary_button_label ) . '</a>';
					}
					$buttons_markup .= '</div>';
				}
				?>
				<article <?php post_class('hamroclass-banner-post'); ?> data-cycle-title="<?php echo esc_attr( get_the_title() ); ?>" data-cycle-url="<?php echo esc_url( get_the_permalink() ); ?>"  data-cycle-excerpt="<?php echo esc_attr( get_the_excerpt() ); ?>" >
					<div class="hamroclass-banner-image <?php echo (has_post_thumbnail(get_the_ID())) ? 'has-thumbnail' : 'no-thumbnail'; ?>">
						<?php the_post_thumbnail( $thumbnail_size ); ?>
					</div>
					<?php
					if ( $enable_description ) : ?>
						<?php
						if ( isset( $description_alignment ) && ! empty( $description_alignment ) ) {
							$alignment_class = 'caption-alignment-' . esc_attr( $description_alignment );
						} else {
							$alignment_class = 'caption-alignment-' . esc_attr( $alignment_class );
						}
						?>
						<div class="cycle-caption-container <?php echo esc_attr( $alignment_class ); ?>">
							<div class="cycle-caption">
								<div class="caption-wrap">
									<h3>
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<?php 
									centurylib_the_excerpt($description_length, false);
									echo wp_kses_post( $buttons_markup ); 
									?>
								</div><!-- .cycle-wrap -->
							</div><!-- .cycle-caption -->
						</div>
					<?php endif; ?>
				</article>
				<?php 
			endwhile;
		endforeach; 
		?>
	</div><!-- #main-slider -->
</div><!-- #featured-slider -->
<?php
wp_reset_postdata();
