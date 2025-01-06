<?php
/**
 * Custom hooks functions are define.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/

/**
 * Related Posts section
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_related_posts_section' ) ) :
	function hamroclass_related_posts_section() {
		echo '<div class="hmc-related-section-wrapper">';
		$hamroclass_related_option = get_theme_mod( 'centurylib_enable_related_posts', 'show' );
		if( $hamroclass_related_option == 'hide' ) {
			return;
		}
		$hamroclass_related_title = get_theme_mod( 'centurylib_related_posts_title', __( 'Related Posts', 'hamroclass' ) );
		if( !empty( $hamroclass_related_title ) ) {
			echo '<h2 class="hmc-related-title hmc-clearfix">'. esc_html( $hamroclass_related_title ) .'</h2>';
		}
		global $post;
        if( empty( $post ) ) {
            $post_id = '';
        } else {
            $post_id = $post->ID;
        }
        $categories = get_the_category( $post_id );
        $category_ids = array();
        if ( $categories ) {
            foreach( $categories as $category_ed ) {
                $category_ids[] = $category_ed->term_id;
            }
        }
		$hamroclass_post_count = apply_filters( 'hamroclass_related_posts_count', 3 );
		
		$related_args = array(
			'no_found_rows'            	=> true,
			'update_post_meta_cache'   	=> false,
			'update_post_term_cache'   	=> false,
			'ignore_sticky_posts'      	=> 1,
			'orderby'                  	=> 'rand',
			'post__not_in'             	=> array( $post_id ),
			'category__in'				=> $category_ids,
			'posts_per_page' 		   	=> $hamroclass_post_count
		);
		$related_query = new WP_Query( $related_args );
		if( $related_query->have_posts() ) {
			echo '<div class="hmc-related-posts-wrap hmc-clearfix">';
			while( $related_query->have_posts() ) {
				$related_query->the_post();
				?>
				<div class="hmc-single-post hmc-clearfix">
					<div class="hmc-single-post-inner">
						<?php if(has_post_thumbnail( get_the_ID() )): ?>
							<div class="hmc-post-thumb">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'hamroclass-thumb-600x600' ); ?>
								</a>
							</div><!-- .hmc-post-thumb -->
						<?php endif; ?>
						<div class="hmc-post-content">
							<h3 class="hmc-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<div class="hmc-post-meta">
								<?php hamroclass_posted_on(); ?>
							</div>
						</div><!-- .hmc-post-content -->
					</div><!-- .hmc-single-post-inner -->
				</div><!-- .hmc-single-post -->
				<?php
			}
			echo '</div><!-- .hmc-related-posts-wrap -->';
		}
		wp_reset_postdata();
		echo '</div><!-- .hmc-related-section-wrapper -->';
	}
endif;

/**
 * Managed functions for related posts section
 *
 * @since 1.0.0
 */
add_action( 'hamroclass_related_posts', 'hamroclass_related_posts_section', 10 );