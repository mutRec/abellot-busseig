<?php
/**
 * The template for header notice
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */


$slider_notice_args = array(
	"item"=>			1,
	"vertical"=>		true,
	"loop"=>			true,
	"verticalHeight"=>	apply_filters( 'hamroclass_notice_section_height', 35 ),
	"pager"=>			false,
	"enableTouch"=>		false,
	"enableDrag"=>		false,
	"auto"=>			true,
	"controls"=>		true,
	"speed"=>			1350,
);
?>
<div class="hmc-notice-wrapper">
	<div class="hmc-container">
		<div class="hmc-notice-block hmc-clearfix">
			<?php
			$hamroclass_notice_caption = get_theme_mod( 'hamroclass_notice_caption', esc_html__( 'Notices', 'hamroclass' ) );
			?>
			<span class="notice-caption"><?php echo esc_html( $hamroclass_notice_caption ); ?></span>
			<div class="notice-content-wrapper">
				<?php
				$hamroclass_notice_cat_id = apply_filters( 'hamroclass_notice_cat_id', null );
				$notice_args                    = array(
					'cat'            => $hamroclass_notice_cat_id,
					'posts_per_page' => '5'
				);
				$notice_query                   = new WP_Query( $notice_args );
				if ( $notice_query->have_posts() ){
					?>
					<ul id="newsNotice" class="cS-hidden" data-notice="<?php echo esc_attr(json_encode($slider_notice_args)); ?>">
						<?php
						while ( $notice_query->have_posts() ){
							$notice_query->the_post();
							?>
							<li>
								<div class="news-notice-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
								</div>
							</li>
							<?php
						}
						?>
					</ul>
					<?php
				}
				?>
			</div><!-- .notice-content-wrapper -->
		</div><!-- .hmc-notice-block -->
	</div><!-- .hmc-container -->
</div><!-- .hmc-notice-wrapper -->