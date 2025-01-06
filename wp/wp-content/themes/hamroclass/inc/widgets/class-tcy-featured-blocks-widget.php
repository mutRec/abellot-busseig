<?php
/**
 * EDM: Featured Posts
 *
 * Widget show the featured posts from selected categories in different layouts.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if( !class_exists( 'HamroClass_Featured_Blocks_Widget' ) ):

    class HamroClass_Featured_Blocks_Widget extends Centurylib_Master_Widget {

        /**
         * Register widget with WordPress.
         */
        public function __construct() {

            $widget_ops = array(
                'classname' => 'hamroclass_featured_posts hmc-full-widget',
                'description' => esc_html__( 'Displays featured posts from selected categories in different layouts.', 'hamroclass' )
            );
            parent::__construct( 'hamroclass_featured_posts', esc_html__( 'HC - Featured Posts', 'hamroclass' ), $widget_ops );

        }

        /**
         * Helper function that holds widget fields
         * Array is used in update and form functions
         */
        public function widget_fields( $instance = array() ) {

            $fields = array(
                'centurylib_widget_tab'       => array(
                    'centurylib_widget_field_name'     => 'centurylib_widget_tab',
                    'centurylib_widget_field_title'    => esc_html__( 'General', 'hamroclass' ),
                    'centurylib_widget_field_default'  => 'general',
                    'centurylib_widget_field_type'     => 'tabgroup',
                    'centurylib_widget_field_options'  => array(
                        'general'=>array(
                            'centurylib_widget_field_title'=>esc_html__('General', 'hamroclass'),
                            'centurylib_widget_field_options'=> array(
                                'title' => array(
                                    'centurylib_widget_field_name'         => 'title',
                                    'centurylib_widget_field_title'        => esc_html__( 'Block title', 'hamroclass' ),
                                    'centurylib_widget_field_description'  => esc_html__( 'Enter your block title. (Optional - Leave blank to hide title.)', 'hamroclass' ),
                                    'centurylib_widget_field_type'   => 'text'
                                ),
                                'title_target'    => array(
                                    'centurylib_widget_field_name'     => 'title_target',
                                    'centurylib_widget_field_wraper'   => 'title-target',
                                    'centurylib_widget_field_title'    => esc_html__( 'Title Target', 'hamroclass' ),
                                    'centurylib_widget_field_default'  => '',
                                    'centurylib_widget_field_type'     => 'select',
                                    'centurylib_widget_field_options'  => centurylib_link_target(),
                                    'centurylib_widget_field_relation' => array(
                                        'exist' => array(
                                            'show_fields'   => array(
                                                'title-link', 
                                            ),
                                        ),
                                        'empty' => array(
                                            'hide_fields'   => array(
                                                'title-link', 
                                            ),
                                        ),
                                    ),
                                ),
                                'title_link'    => array(
                                    'centurylib_widget_field_name'     => 'title_link',
                                    'centurylib_widget_field_wraper'   => 'title-link',
                                    'centurylib_widget_field_title'    => esc_html__( 'Title link', 'hamroclass' ),
                                    'centurylib_widget_field_default'  => '',
                                    'centurylib_widget_field_type'     => 'text',
                                ),
                                'block_term_ids' => array(
                                    'centurylib_widget_field_name'         => 'block_term_ids',
                                    'centurylib_widget_field_title'        => esc_html__( 'Block Categories', 'hamroclass' ),
                                    'centurylib_widget_field_type'   => 'multitermlist',
                                    'centurylib_widget_taxonomy_type' => 'category',
                                ),
                                'show_author' => array(
                                    'centurylib_widget_field_name'          => 'show_author',
                                    'centurylib_widget_field_wraper'        => 'show-author',
                                    'centurylib_widget_field_title'         => esc_html__( 
                                        'Show Author', 'hamroclass' ),
                                    'centurylib_widget_field_default'       => 0,
                                    'centurylib_widget_field_type'          => 'checkbox',
                                ),
                                'show_postdate' => array(
                                    'centurylib_widget_field_name'          => 'show_postdate',
                                    'centurylib_widget_field_wraper'        => 'show-postdate',
                                    'centurylib_widget_field_title'         => esc_html__( 
                                        'Show Post Date', 'hamroclass' ),
                                    'centurylib_widget_field_default'       => 0,
                                    'centurylib_widget_field_type'          => 'checkbox',
                                ),
                            )
                        ),
                        'layout'=>array(
                            'centurylib_widget_field_title'=>esc_html__('Layout', 'hamroclass'),
                            'centurylib_widget_field_options'=> array(
                                'thumbnail_size' => array(
                                    'centurylib_widget_field_name'         => 'thumbnail_size',
                                    'centurylib_widget_field_wraper'   => 'thumbnail-size',
                                    'centurylib_widget_field_title'        => esc_html__( 
                                        'Image Size', 'hamroclass' ),
                                    'centurylib_widget_field_default'=> 'thumbnail',
                                    'centurylib_widget_field_type' => 'select',
                                    'centurylib_widget_field_options'   => centurylib_get_image_sizes(),
                                ),
                                'show_excerpt' => array(
                                    'centurylib_widget_field_name'         => 'show_excerpt',
                                    'centurylib_widget_field_wraper'   => 'show-excerpt',
                                    'centurylib_widget_field_title'        => esc_html__( 'Show Description?', 'hamroclass' ),
                                    'centurylib_widget_field_default'=> 1,
                                    'centurylib_widget_field_description'  => esc_html__( 'Check to show short description.', 'hamroclass' ),
                                    'centurylib_widget_field_type'   => 'checkbox'
                                ),
                                'excerpt_length' => array(
                                    'centurylib_widget_field_name'         => 'excerpt_length',
                                    'centurylib_widget_field_wraper'   => 'excerpt-length',
                                    'centurylib_widget_field_title'        => esc_html__( 'Description Length', 'hamroclass' ),
                                    'centurylib_widget_field_default'=> '150',
                                    'centurylib_widget_field_description'  => esc_html__( 'Choose excerpt length in character. default length description length is 150. you can set zero if you want to hide description.', 'hamroclass' ),
                                    'centurylib_widget_field_type'   => 'number'
                                ),
                            )
                        ),
                    )
                )
            );

            $widget_fields_key = 'fields_'.$this->id_base;
            $widgets_fields = apply_filters( $widget_fields_key, $fields );
            return $widgets_fields;

        }

        /**
         * Front-end display of widget.
         *
         * @see WP_Widget::widget()
         *
         * @param array $args     Widget arguments.
         * @param array $instance Saved values from database.
         */
        public function widget( $args, $instance ) {
                       
            if( empty( $instance ) ) {
                return ;
            }

            centurylib_before_widget($args);

            $featured_widget_layout = apply_filters( 'hamroclass_featured_post_widget_layout', 'layout1', $instance );
            if($featured_widget_layout == 'layout1' ){
                $this->default_template($args, $instance);
            }else{
                do_action( 'hamroclass_featured_post_widget_template', $args, $instance, $this );
            }
            
            centurylib_after_widget($args);
            wp_reset_postdata();

            ?>
            
            <?php

        }

        public function default_template($args, $instance){

            extract($args);

            $title  = isset( $instance['title'] ) ? $instance['title'] : '';
            $title  = apply_filters( 'widget_title', $title, $instance, $this->id_base );
            $title_target      = isset( $instance['title_target'] ) ? $instance['title_target'] : '';
            $title_link  = isset( $instance['title_link'] ) ? $instance['title_link'] : '';
            $block_term_ids  = empty( $instance['block_term_ids'] ) ? '' : $instance['block_term_ids'];
            $show_postdate  = isset( $instance['show_postdate'] ) ? $instance['show_postdate'] : 0;
            $show_author  = isset( $instance['show_author'] ) ? $instance['show_author'] : 0;

             /*
             * Layout tabs
             */
             $thumbnail_size = isset( $instance['thumbnail_size'] ) ? $instance['thumbnail_size'] : 'thumbnail';
             $show_excerpt = isset( $instance['show_excerpt'] ) ? $instance['show_excerpt'] : 0;
             $excerpt_length = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] : 0;
            ?>
            <div class="hmc-container">
                <div class="hmc-block-wrapper featured-posts hmc-clearfix">
                    <?php
                    $title_args = array(
                        'title'         => $title,
                        'title_target'  => $title_target,
                        'title_link'    => $title_link,
                        'before_title'  => $before_title,
                        'after_title'   => $after_title
                    );
                    do_action('centurylib_widget_title', $title_args);
                    ?>
                    <div class="hmc-featured-posts-wrapper">
                        <?php
                        $hamroclass_post_count = apply_filters( 'hamroclass_featured_posts_block_count', 4, $instance, $args );
                        $hamroclass_posts_args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => absint( $hamroclass_post_count )
                        );
                        if( $block_term_ids ) {
                            $hamroclass_posts_args['tax_query'][] = array(
                                'taxonomy' => 'category',
                                'field'    => 'term_id',
                                'terms'    => $block_term_ids,
                            );
                        }
                        $hamroclass_posts_query = new WP_Query( $hamroclass_posts_args );
                        if( $hamroclass_posts_query->have_posts() ) {
                            while( $hamroclass_posts_query->have_posts() ) {
                                $hamroclass_posts_query->the_post();
                                ?>
                                <div class="hmc-single-post-wrap hmc-clearfix">
                                    <div class="hmc-single-post">
                                        <div class="hmc-post-thumb">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                if( has_post_thumbnail() ) {
                                                    the_post_thumbnail( $thumbnail_size );
                                                }
                                                ?>
                                            </a>
                                        </div><!-- .hmc-post-thumb -->
                                        <div class="hmc-post-content">
                                            <h3 class="hmc-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                            <div class="hmc-post-meta"><?php hamroclass_posted_on( $show_postdate, $show_author ); ?></div>
                                            <?php if($excerpt_length>0 && $show_excerpt ){ ?>
                                                <div class="hmc-post-description">
                                                    <?php centurylib_the_excerpt($excerpt_length, false); ?>
                                                </div><!-- .hamroclass-post-description -->
                                            <?php } ?>
                                        </div><!-- .hmc-post-content -->
                                    </div> <!-- hmc-single-post -->
                                </div><!-- .hmc-single-post-wrap -->
                                <?php
                            }
                        }
                        ?>
                    </div><!-- .hmc-featured-posts-wrapper -->
                </div><!--- .hmc-block-wrapper -->
            </div>
            <?php
        }

    }

endif;