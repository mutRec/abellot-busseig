<?php
/*
 * @package themecentury
 * @subpackage hamroclass
 * @version 1.0.0
 */
$default_value = array( );
$hamroclass_main_services = apply_filters( 'hamroclass_default_main_services', $default_value );
$services_details = apply_filters( 'hamroclass_main_services', $hamroclass_main_services );
$other_options	= $services_details['other_options'];
$main_services 	= $services_details['services_list'];
$noof_columns 	= $other_options['noof_columns'];
$enable_overlap	= $other_options['enable_overlap'];
if(empty($main_services)){
	return;
}
?>
<div class="hmc-main-wrapper">
	<div class="hmc-container">
		<div class="hmc-service-container <?php echo ($enable_overlap) ? 'overlap' : 'no-overlap'; ?>">
			<?php
			foreach ( $main_services as $index => $service_detail ) {
				
				$font_color			= isset($service_detail['font_color']) ? sanitize_hex_color( $service_detail['font_color'] ) : '#fff';
				$background_color			= isset($service_detail['background_color']) ? sanitize_hex_color( $service_detail['background_color'] ) : '#1e73be';
				$service_fa_icon			= isset($service_detail['service_fa_icon']) ? esc_attr( $service_detail['service_fa_icon'] ) : 'fa-star';
				$post_type_item			= isset($service_detail['post_type_item']) ? absint( $service_detail['post_type_item'] ) : 0;
				if ( ! empty( $post_type_item ) ) {
					$service_args = array( 
						'post_type' => 'page',
						'posts_per_page' => 1,
						'p'				=> absint($post_type_item),
					);
					$main_services = new WP_Query($service_args);
					$featured_slider_status = 'home-page';
					while($main_services->have_posts()): 
						$main_services->the_post();
						?>
						<div class="hmc-single-service hmc-service-col-<?php echo esc_attr( $noof_columns ); ?>" style="<?php if($featured_slider_status == 'home-page'){echo '';}else{echo 'margin-top:64px;';} ?> background-color:<?php echo esc_attr( $background_color ); ?>; color: <?php echo esc_attr($font_color); ?>">
							<div class="hmc-service-wrapper">
								<div class="icon_alignment">
									<i class="fa <?php echo esc_attr( $service_fa_icon ); ?>"></i>
								</div> <!-- align icons -->
								<div class="service-content">
									<h3 class="service-title"><a
										href="<?php echo esc_url(get_permalink( $post->ID ) ); ?>"><?php the_title(); ?></a>
									</h3>
									<?php centurylib_the_excerpt(200, false); ?>
								</div>
								<div style="clear:both"></div>
							</div>
							<div style="clear:both"></div>
						</div>
						<?php 
					endwhile;
				}
			} 
			?>
		</div>
	</div>
</div>
<?php
wp_reset_postdata();
wp_reset_query();
