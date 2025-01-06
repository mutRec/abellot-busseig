<?php
/**
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

/*-----------------------------------------------------------------------------------------------------------------------*/
/**
 * Get author info
 */

if (!function_exists('hamroclass_author_box_callback')):
	
    function hamroclass_author_box_callback(){
        global $post;
        $author_id = $post->post_author;
        $author_avatar = get_avatar($author_id, '150');
        $author_nickname = get_the_author_meta('display_name');
        $hamroclass_author_option = get_theme_mod('centurylib_author_info_post', 'show');
        if ($hamroclass_author_option != 'hide') {
            ?>
            <div class="hamroclass-author-wrapper clearfix">
                <div class="author-avatar">
                    <a class="author-image"
                       href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo $author_avatar; ?></a>
                </div><!-- .author-avatar -->
                <div class="author-desc-wrapper">
                    <a class="author-title"
                       href="<?php echo esc_url(get_author_posts_url(get_the_author_meta('ID'))); ?>"><?php echo esc_html($author_nickname); ?></a>
                    <div class="author-description"><?php echo esc_html(get_the_author_meta('description') ); ?></div>
                    <a href="<?php echo esc_url(get_the_author_meta('user_url')); ?>"
                       target="_blank"><?php echo esc_url(get_the_author_meta('user_url')); ?></a>
                </div><!-- .author-desc-wrapper-->
            </div><!--hamroclass-author-wrapper-->
            <?php
        }
    }
endif;

add_action('hamroclass_author_info_section', 'hamroclass_author_box_callback' );