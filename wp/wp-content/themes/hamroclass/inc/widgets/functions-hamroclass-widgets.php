<?php
/**
 * Custom hooks functions for different layout in widget section.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */


/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Default Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_block_one_layout_section' ) ) :
	function hamroclass_block_one_layout_section( $hamroclass_args ) {
		$terms_ids = $hamroclass_args['terms_ids'];
		$thumbnail_size = $hamroclass_args['thumbnail_size'];
		$largeimg_size = $hamroclass_args['largeimg_size'];
		$large_excerpt_length = $hamroclass_args['large_excerpt_length'];
		$small_excerpt_length = $hamroclass_args['small_excerpt_length'];
		$posts_page_page = 5;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ){
				$block_query->the_post();
				if( $post_count == 1 ){
					echo '<div class="hmc-primary-block-wrap">';
					$title_size = 'large-size';
				}elseif ( $post_count == 2 ){
					echo '<div class="hmc-secondary-block-wrap">';
					$title_size = 'small-size';
				}else{
					$title_size = 'small-size';
				}

				$thumbnail_class = (has_post_thumbnail()) ? 'has_thumbnail' : 'no_thumbnail';
				?>
				<div class="hmc-single-post hmc-clearfix">
					<div class="hmc-post-thumb <?php echo esc_attr($thumbnail_class); ?>">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( $post_count == 1 ) {
								the_post_thumbnail( $largeimg_size );
							} else {
								the_post_thumbnail( $thumbnail_size );
							}
							?>
						</a>
					</div><!-- .hmc-post-thumb -->
					<div class="hmc-post-content">
						<h3 class="hmc-post-title <?php echo esc_attr( $title_size ); ?>"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
						<?php if ( $post_count == 1 ) { ?>
							<div class="hmc-post-excerpt"><?php centurylib_the_excerpt($large_excerpt_length, false ); ?></div>
						<?php }else if($small_excerpt_length){ ?>
							<div class="hmc-post-excerpt"><?php centurylib_the_excerpt($small_excerpt_length, false ); ?></div>
						<?php } ?>
					</div><!-- .hmc-post-content -->
				</div><!-- .hmc-single-post -->
				<?php
				if( $post_count == 1 ){
					echo '</div><!-- .hmc-primary-block-wrap -->';
				}elseif( $post_count == $total_posts_count ){
					echo '</div><!-- .hmc-secondary-block-wrap -->';
				}
				$post_count ++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Second Layout
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'hamroclass_block_second_layout_section' ) ) :
	function hamroclass_block_second_layout_section( $hamroclass_args ) {
		$terms_ids = $hamroclass_args['terms_ids'];
		$thumbnail_size = $hamroclass_args['thumbnail_size'];
		$largeimg_size = $hamroclass_args['largeimg_size'];
		$large_excerpt_length = $hamroclass_args['large_excerpt_length'];
		$small_excerpt_length = $hamroclass_args['small_excerpt_length'];
		$posts_page_page = 6;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="hmc-primary-block-wrap">';
				} elseif ( $post_count == 3 ) {
					echo '<div class="hmc-secondary-block-wrap">';
				}
				if ( $post_count <= 2 ) {
					$title_size = 'large-size';
				} else {
					$title_size = 'small-size';
				}
				$thumbnail_class = (has_post_thumbnail()) ? 'has_thumbnail' : 'no_thumbnail';
				?>
				<div class="hmc-single-post hmc-clearfix">
					<div class="hmc-post-thumb <?php echo esc_attr($thumbnail_class); ?>">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( $post_count <= 2 ) {
								the_post_thumbnail( $largeimg_size );
							} else {
								the_post_thumbnail( $thumbnail_size );
							}
							?>
						</a>
					</div><!-- .hmc-post-thumb -->
					<div class="hmc-post-content">
						<h3 class="hmc-post-title <?php echo esc_attr( $title_size ); ?>"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
						<?php if ( $post_count <= 2 ) { ?>
							<div class="hmc-post-excerpt"><?php centurylib_the_excerpt($large_excerpt_length, false ); ?></div>
						<?php } ?>
					</div><!-- .hmc-post-content -->
				</div><!-- .hmc-single-post -->
				<?php
				if ( $post_count == 2 ) {
					echo '</div><!-- .hmc-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .hmc-secondary-block-wrap -->';
				}
				$post_count ++;
			}
		}
		wp_reset_postdata();
	}
endif;
/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block Box Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_block_box_layout_section' ) ) :
	function hamroclass_block_box_layout_section( $hamroclass_args ) {
		$terms_ids = $hamroclass_args['terms_ids'];
		$thumbnail_size = $hamroclass_args['thumbnail_size'];
		$largeimg_size = $hamroclass_args['largeimg_size'];
		$large_excerpt_length = $hamroclass_args['large_excerpt_length'];
		$small_excerpt_length = $hamroclass_args['small_excerpt_length'];
		$posts_page_page = 4;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_count = 1;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				if ( $post_count == 1 ) {
					echo '<div class="hmc-primary-block-wrap">';
					$title_size = 'large-size';
				} elseif ( $post_count == 2 ) {
					echo '<div class="hmc-secondary-block-wrap hmc-clearfix">';
					$title_size = 'small-size';
				} else {
					$title_size = 'small-size';
				}
				$thumbnail_class = (has_post_thumbnail()) ? 'has_thumbnail' : 'no_thumbnail';
				?>
				<div class="hmc-single-post <?php echo esc_attr($thumbnail_class); ?>">
					<div class="hmc-post-thumb <?php echo esc_attr($thumbnail_class); ?>">
						<a href="<?php the_permalink(); ?>">
							<?php
							if ( $post_count == 1 ) {
								the_post_thumbnail( $largeimg_size );
							} else {
								the_post_thumbnail( $thumbnail_size );
							}
							?>
						</a>
					</div><!-- .hmc-post-thumb -->
					<div class="hmc-post-content">
						<h3 class="hmc-post-title <?php echo esc_attr( $title_size ); ?>"><a
								href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
					</div><!-- .hmc-post-content -->
				</div><!-- .hmc-single-post -->
				<?php
				if ( $post_count == 1 ) {
					echo '</div><!-- .hmc-primary-block-wrap -->';
				} elseif ( $post_count == $total_posts_count ) {
					echo '</div><!-- .hmc-secondary-block-wrap -->';
				}
				$post_count ++;
			}
		}
		wp_reset_postdata();
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Block blog style
 *
 * @since 1.0.0
 */

if ( ! function_exists( 'hamroclass_block_alternate_grid_section' ) ) :

	function hamroclass_block_blog_style_section($hamroclass_args){

		$terms_ids = $hamroclass_args['terms_ids'];
		$thumbnail_size = $hamroclass_args['thumbnail_size'];
		$largeimg_size = $hamroclass_args['largeimg_size'];
		$large_excerpt_length = $hamroclass_args['large_excerpt_length'];
		$small_excerpt_length = $hamroclass_args['small_excerpt_length'];
		$posts_page_page = 3;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_index = 0;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				$post_index++;
				if($post_index > $posts_page_page ){
					break;
				}
				?>
				<article <?php post_class('block-posts-blog'); ?>>
					<div class="blog-post-style">
						<figure class="blog-thumb-wrapper">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( $thumbnail_size ); ?>
							</a>
						</figure><!-- .hmc-post-thumb -->
						<div class="blog-post-content">
							<h4 class="blog-post-title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h4>
							<div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
							<div class="blog-post-excerpt"><?php centurylib_the_excerpt($large_excerpt_length, true ); ?></div>
						</div><!-- .hmc-post-content -->
					</div><!-- .hmc-single-post -->
				</article>
				<?php
			}

		}

		wp_reset_postdata();

	}

endif;

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Block alternate grid
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_block_alternate_grid_section' ) ) :
	function hamroclass_block_alternate_grid_section( $hamroclass_args ){
		$terms_ids = $hamroclass_args['terms_ids'];
		$thumbnail_size = $hamroclass_args['thumbnail_size'];
		$largeimg_size = $hamroclass_args['largeimg_size'];
		$large_excerpt_length = $hamroclass_args['large_excerpt_length'];
		$small_excerpt_length = $hamroclass_args['small_excerpt_length'];
		$posts_page_page = 3;
		$block_args = array(
			'post_type' => 'post',
			'posts_per_page' => absint( $posts_page_page ),
		);
		if( ! empty( $terms_ids ) ){
			$block_args['tax_query'] = array(
				array(
					'taxonomy' => 'category',
					'field'    => 'term_id',
					'terms'    => $terms_ids,
					'operator' => 'IN',
				),
			);
		}
		$block_query                 = new WP_Query( $block_args );
		$total_posts_count           = $block_query->post_count;
		if ( $block_query->have_posts() ) {
			$post_index=0;
			while ( $block_query->have_posts() ) {
				$block_query->the_post();
				$post_index++;
				if($post_index > $posts_page_page ){
					break;
				}
				?>
				<article <?php post_class( 'hamroclass-alternative-block' ); ?> >
					<div class="alternate-block-inner">
						<figure class="alternate-block-thumb">
							<a href="<?php the_permalink(); ?>" style="background-image: url(<?php echo esc_url(get_the_post_thumbnail_url(null, $thumbnail_size)); ?>); ">&nbsp;</a>
						</figure><!-- .hmc-post-thumb -->
						<div class="alternative-post-content">
							<div class="alternate-content-inner">
								<div class="alternate-center-part">
									<h3 class="alt-grid-post-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
									<div class="alternate-post-excerpt"><?php centurylib_the_excerpt($large_excerpt_length, false ); ?></div>
								</div>
							</div><!-- .hmc-post-content -->
						</div>
					</div><!-- .hmc-single-post -->
				</article>
				<?php
			}
		}
		wp_reset_postdata();

	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Carousel Default Layout
 *
 * @since 1.0.0
 */
if ( ! function_exists( 'hamroclass_carousel_layout_section' ) ) :
	function hamroclass_carousel_layout_section( $block_args ) {

		$query_args = $block_args['query_args'];
		$carousel_settings = $block_args['carousel_settings'];
		$thumbnail_size = $carousel_settings['thumbnail_size'];
		$no_of_column = $carousel_settings['no_of_column'];
		$excerpt_length = $carousel_settings['excerpt_length'];
		$carousel_args = array(
			'auto'			=> true,
			'loop'			=> true,
			'pauseOnHover'	=> true,
			'pager'			=> false,
			'controls'		=> false,
			'adaptiveHeight'=> false,
			'slideMargin'	=> 15,
			'item' 			=> $no_of_column,
			'responsive'	=> array(
				array(
					'breakpoint'		=> 991,
					'settings'			=> array(
						'slideMove'		=> 1,
						'item'			=> ($no_of_column>=2) ? 2 : $no_of_column,
					),
				),
				array(
					'breakpoint'		=> 480,
					'settings'			=> array(
						'item'			=> 1,
						'slideMove'		=> 1,
					)
				)
			)
		);
		$hamroclass_block_query = new WP_Query( $query_args );
		if ( $hamroclass_block_query->have_posts() ) {
			echo '<ul class="hamroclass-block-carousel cS-hidden" data-carousel='.esc_attr(json_encode( $carousel_args ) ).'>';
			while ( $hamroclass_block_query->have_posts() ){
				$hamroclass_block_query->the_post();
				?>
				<li class="hmc-carousel-list <?php echo esc_attr( 'column'.$no_of_column ) ?>">
					<div class="hmc-single-post hmc-clearfix">
						<div class="hmc-post-thumb">
							<a href="<?php the_permalink(); ?>" class="<?php echo (has_post_thumbnail(get_the_ID())) ? 'has-thumbnail' : 'no-thumbnail'; ?>">
								<?php the_post_thumbnail( $thumbnail_size ); ?>
							</a>
						</div><!-- .hmc-post-thumb -->
						<div class="hmc-post-content">
							<?php hamroclass_post_categories_list(); ?>
							<h3 class="hmc-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
							<?php if($excerpt_length): ?>
								<div class="hmc-post-excerpt"><?php centurylib_the_excerpt($excerpt_length, false ); ?></div>
							<?php endif; ?>
						</div><!-- .hmc-post-content -->
					</div><!-- .hmc-single-post -->
				</li>
				<?php
			}
			echo '</ul>';
		}

		wp_reset_postdata();

		
	}
endif;
