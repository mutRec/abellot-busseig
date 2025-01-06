<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$enable_image = get_theme_mod( 'centurylib_enable_featured_image_post', 'show' ); 
	if( $enable_image == 'show' ):
		?>
		<div class="hmc-article-thumb">
			<?php the_post_thumbnail( 'full' ); ?>
		</div><!-- .hmc-article-thumb -->
	<?php endif; ?>
	<header class="entry-header">
		<?php 
		the_title( '<h1 class="entry-title">', '</h1>' );
		$show_categories = get_theme_mod( 'centurylib_enable_categories_post', 'show' );
		if($show_categories=='show'){
			hamroclass_single_post_categories_list();
		}

		$show_date = get_theme_mod( 'centurylib_enable_date_post', 'show' );
		$show_author = get_theme_mod( 'centurylib_enable_authorname_post', 'show' );
		$show_comments = get_theme_mod( 'centurylib_enable_comments_post', 'show' );
		if( ( $show_date == 'show' || $show_author == 'show' || $show_comments == 'show' ) && is_singular('post') ){
			?>
			<div class="entry-meta">
				<?php 
				$args1 = ($show_date=='show') ? true : false;
				$args2 = ($show_author=='show') ? true : false;
				$args3 = ($show_comments=='show') ? true : false;
				hamroclass_inner_posted_on( $args1, $args2, $args3 ); 
				?>
			</div><!-- .entry-meta -->
			<?php 
		}
		?>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php
		the_content( 
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'hamroclass' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) 
		);

		$enable_tags = get_theme_mod( 'centurylib_enable_tags_post', 'show' );
		$show_tags = ($enable_tags=='show') ? true : false;
		?>
		<footer class="entry-footer">
			<?php hamroclass_entry_footer( $show_tags ); ?>
		</footer><!-- .entry-footer -->
		<?php
		
		wp_link_pages( 
			array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'hamroclass' ),
				'after'  => '</div>',
			) 
		);
		?>
	</div><!-- .entry-content -->
	<?php do_action( 'centurylib_reaction_section_icons' ); ?>
	
</article><!-- #post-<?php the_ID(); ?> -->