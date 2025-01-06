<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'hamroclass_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hamroclass_posted_on( $show_date = true, $show_author = true ) {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = ' <a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';

	$byline = ' <span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';

	if($show_date){
		echo '<span class="posted-on">' . $posted_on . '</span>';
	}

	if($show_author){
		echo '<span class="byline"> ' . $byline . '</span>';
	}

	//echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'hamroclass_inner_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function hamroclass_inner_posted_on( $show_date=true, $show_author=true, $show_comments = true ) {
	
	hamroclass_posted_on( $show_date, $show_author );

	if(!$show_comments){
		return;
	}

	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments-link">';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'hamroclass' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			)
		);
		echo '</span>';
	}

}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
if ( ! function_exists( 'hamroclass_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function hamroclass_entry_footer( $show_tag = true, $edit_link=true ){

	if ( $show_tag ) {
		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', ' ' );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'hamroclass' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}

	if(!$edit_link){
		return;
	}
	
	edit_post_link(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__( 'Edit <span class="screen-reader-text">%s</span>', 'hamroclass' ),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			get_the_title()
		),
		'<span class="edit-link">',
		'</span>'
	);
}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function hamroclass_categorized_blog() {
	$all_the_cool_cats = get_transient( 'hamroclass_categories' );
	if ( false === $all_the_cool_cats ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'hamroclass_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 || is_preview() ) {
		// This blog has more than 1 category so hamroclass_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so hamroclass_categorized_blog should return false.
		return false;
	}
}

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Flush out the transients used in hamroclass_categorized_blog.
 */
function hamroclass_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'hamroclass_categories' );
}
add_action( 'edit_category', 'hamroclass_category_transient_flusher' );
add_action( 'save_post',     'hamroclass_category_transient_flusher' );

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Categories list in multiple color background
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_post_categories_list' ) ):
	function hamroclass_post_categories_list() {
		global $post;
		$post_id = $post->ID;
		$categories_list = get_the_category( $post_id );
		if( !empty( $categories_list ) ) {
			$cat_count = apply_filters( 'hamroclass_cat_list_count', 2 );
			$count = 0;
?>
		<div class="post-cats-list">
			<?php 
				foreach ( $categories_list as $cat_data ) {					
					$cat_name = $cat_data->name;
					$cat_slug = $cat_data->slug;
					$cat_id = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
					if( $count < $cat_count ) {
			?>
				<span class="category-button hmc-cat-<?php echo esc_attr( $cat_slug ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
			<?php
					}
					$count++;
				}
			?>
		</div>
<?php
		}
	}
endif;

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Categories list in multiple color background for single post page
 *
 * @since 1.0.0
 */
if( ! function_exists( 'hamroclass_single_post_categories_list' ) ):
	function hamroclass_single_post_categories_list() {
		global $post;
		$post_id = $post->ID;
		$categories_list = get_the_category( $post_id );
		if( !empty( $categories_list ) ) {
?>
		<div class="post-cats-list">
			<?php 
				foreach ( $categories_list as $cat_data ) {					
					$cat_name = $cat_data->name;
					$cat_slug = $cat_data->slug;
					$cat_id = $cat_data->term_id;
					$cat_link = get_category_link( $cat_id );
			?>
				<span class="category-button hmc-cat-<?php echo esc_attr( $cat_slug ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $cat_name ); ?></a></span>
			<?php
				}
			?>
		</div>
<?php
		}
	}
endif;