<?php
/**
 * EDM: Default Tabbed
 *
 * Widget to display latest posts and comment in tabbed layout.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

if(!class_exists( 'HamroClass_Default_Tabbed_Widget' ) ):

    class HamroClass_Default_Tabbed_Widget extends Centurylib_Master_Widget{

	   /**
         * Register widget with WordPress.
         */
       public function __construct() {

            $widget_ops = array(
                'classname' => 'hamroclass_default_tabbed_widget',
                'description' => esc_html__( 'A widget shows recent posts and comment in tabbed layout.', 'hamroclass' )
            );
            parent::__construct( 'hamroclass_default_tabbed_widget', esc_html__( 'HC - Default Tabbed', 'hamroclass' ), $widget_ops );

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
                                'post_accordion' => array(
                                    'centurylib_widget_field_name'         => 'post_accordion',
                                    'centurylib_widget_field_title'        => esc_html__( 'Latest Post Accordion', 'hamroclass' ),
                                    'centurylib_widget_field_type'   => 'accordion',
                                    'centurylib_widget_field_options'=> array(
                                        array(
                                            'centurylib_widget_field_name'         => 'latest_tab_title',
                                            'centurylib_widget_field_title'        => esc_html__( 'Latest Posts Tab', 'hamroclass' ),
                                            'centurylib_widget_field_options'=> array(
                                                'latest_tab_title' => array(
                                                    'centurylib_widget_field_name'         => 'latest_tab_title', 'centurylib_widget_field_title'        => esc_html__( 'Latest Tab title', 'hamroclass' ), 'centurylib_widget_field_default'      => esc_html__( 'Latest', 'hamroclass' ), 'centurylib_widget_field_type'   => 'text', 
                                                ),
                                                'no_of_posts' => array(
                                                    'centurylib_widget_field_name'         => 'no_of_posts', 'centurylib_widget_field_title'        => esc_html__( 'No of latest post.', 'hamroclass' ), 'centurylib_widget_field_default'      => 5, 'centurylib_widget_field_type'   => 'number', 
                                                ),
                                                'excerpt_length' => array(
                                                    'centurylib_widget_field_name'         => 'excerpt_length', 
                                                    'centurylib_widget_field_title'        => esc_html__( 'Excerpt Length', 'hamroclass' ), 
                                                    'centurylib_widget_field_default'      => 150, 
                                                    'centurylib_widget_field_type'   => 'number', 
                                                ),
                                                'image_thumbnail' => array(
                                                    'centurylib_widget_field_name'         => 'image_thumbnail', 
                                                    'centurylib_widget_field_title'        => esc_html__( 'Thumbnail Size', 'hamroclass' ),
                                                    'centurylib_widget_field_default' => 'centurylib-thumb-400x300',
                                                    'centurylib_widget_field_options' => centurylib_get_image_sizes(), 
                                                    'centurylib_widget_field_type'   => 'select', 
                                                ),
                                            )
                                        ),
                                    ),
                                ),
                                'comments_accordion' => array(
                                    'centurylib_widget_field_name'         => 'comments_accordion',
                                    'centurylib_widget_field_title'        => esc_html__( 'Comments Accordion', 'hamroclass' ),
                                    'centurylib_widget_field_type'   => 'accordion',
                                    'centurylib_widget_field_options'=> array(
                                        array(
                                            'centurylib_widget_field_name'         => 'latest_tab_title',
                                            'centurylib_widget_field_title'        => esc_html__( 'Comments Tab', 'hamroclass' ),
                                            'centurylib_widget_field_options'=> array(
                                                'comments_tab_title' => array(
                                                    'centurylib_widget_field_name'         => 'comments_tab_title',
                                                    'centurylib_widget_field_title'        => esc_html__( 'Comments Tab title', 'hamroclass' ),
                                                    'centurylib_widget_field_default'      => esc_html__( 'Comments', 'hamroclass' ),
                                                    'centurylib_widget_field_type'   => 'text'
                                                ),
                                                'no_of_comments' => array(
                                                    'centurylib_widget_field_name'         => 'no_of_comments', 'centurylib_widget_field_title'        => esc_html__( 'No of comments.', 'hamroclass' ), 'centurylib_widget_field_default'      => 5, 'centurylib_widget_field_type'   => 'number', 
                                                ),
                                                'comment_length' => array(
                                                    'centurylib_widget_field_name'         => 'comment_length', 'centurylib_widget_field_title'        => esc_html__( 'Comment Length', 'hamroclass' ), 'centurylib_widget_field_default'      => 150, 'centurylib_widget_field_type'   => 'number', 
                                                ),
                                                'comment_thumbnail' => array(
                                                    'centurylib_widget_field_name'         => 'comment_thumbnail', 'centurylib_widget_field_title'        => esc_html__( 'Comment Image Size(in px).', 'hamroclass' ), 'centurylib_widget_field_default'      => 150, 'centurylib_widget_field_type'   => 'number', 
                                                ),
                                            )
                                        ),
                                    ),
                                ),
                            )
                        )
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
            extract( $args );
            if( empty( $instance ) ) {
                return ;
            }

            //Post Accordion
            $latest_tab_title   = isset( $instance['latest_tab_title'] ) ? $instance['latest_tab_title'] :  esc_html__( 'Latest', 'hamroclass' );
            $no_of_posts   = isset( $instance['no_of_posts'] ) ? $instance['no_of_posts'] :  5;
            $excerpt_length   = isset( $instance['excerpt_length'] ) ? $instance['excerpt_length'] :  150;
            $image_thumbnail   = isset( $instance['image_thumbnail'] ) ? $instance['image_thumbnail'] : 'centurylib-thumb-400x300';

            //Comments Accordion
            $comments_tab_title   = isset( $instance['comments_tab_title'] ) ? $instance['comments_tab_title'] :  esc_html__( 'Comments', 'hamroclass' );
            $no_of_comments   = isset( $instance['no_of_comments'] ) ? $instance['no_of_comments'] :  5;
            $comment_thumbnail   = isset( $instance['comment_thumbnail'] ) ? $instance['comment_thumbnail'] :  150;
            $comment_length   = isset( $instance['comment_length'] ) ? $instance['comment_length'] :  150;

            centurylib_before_widget($args);
            ?>
            <div class="hmc-default-tabbed-wrapper hmc-clearfix" id="hmc-tabbed-widget<?php echo esc_attr($this->number); ?>">

                <ul class="widget-tabs hmc-clearfix hmc-widget-tab" id="hmc-widget-tab<?php echo esc_attr($this->number); ?>">
                    <li class="active-item"><a href="#latest<?php echo esc_attr($this->number); ?>"><?php echo esc_html( $latest_tab_title ); ?></a></li>
                    <li><a href="#comments<?php echo esc_attr($this->number); ?>"><?php echo esc_html( $comments_tab_title ); ?></a></li>
                </ul><!-- .widget-tabs -->

                <div id="latest<?php echo esc_attr($this->number); ?>" class="hmc-tabbed-section active-content hmc-clearfix">
                    <?php
                    $latest_args = array(
                        'post_type' => 'post',
                        'post_status' => 'publish',
                        'posts_per_page' => absint($no_of_posts),
                    );
                    $latest_query = new WP_Query( $latest_args );
                    if( $latest_query->have_posts() ) {
                        while( $latest_query->have_posts() ) {
                            $latest_query->the_post();
                            $thumbanil_class = (has_post_thumbnail( get_the_ID() ) ) ? 'has-thumbnail' : 'no-thumbnail';
                            ?>
                            <div class="hmc-single-post hmc-clearfix">
                                <div class="hmc-post-thumb <?php echo esc_attr($thumbanil_class); ?>">
                                    <a href="<?php the_permalink(); ?>"> <?php the_post_thumbnail( 'hamroclass-block-thumb' ); ?> </a>
                                </div><!-- .hmc-post-thumb -->
                                <div class="hmc-post-content">
                                    <h3 class="hmc-post-title small-size"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                    <?php centurylib_the_excerpt($excerpt_length, false); ?>
                                    <div class="hmc-post-meta"><?php hamroclass_posted_on(); ?></div>
                                </div><!-- .hmc-post-content -->
                            </div><!-- .hmc-single-post -->
                            <?php
                        }
                    }
                    wp_reset_postdata();
                    ?>
                </div><!-- #latest -->

                <div id="comments<?php echo esc_attr($this->number); ?>" class="hmc-tabbed-section hmc-comments-content hmc-clearfix">
                    <ul>
                        <?php
                        $hamroclass_comments = get_comments( 
                            array( 
                                'number' => $no_of_comments 
                            )
                        );
                        foreach( $hamroclass_comments as $comment  ) {
                            ?>
                            <li class="hmc-single-comment hmc-clearfix">
                                <?php
                                $title = get_the_title( $comment->comment_post_ID );
                                echo '<div class="hmc-comment-avatar">'. get_avatar( $comment, $comment_thumbnail ) .'</div>';
                                ?>
                                <div class="hmc-comment-desc-wrap">
                                    <strong><?php echo esc_html(strip_tags( $comment->comment_author )); ?></strong>
                                    <?php esc_html_e( '&nbsp;commented on', 'hamroclass' ); ?>
                                    <a href="<?php echo esc_url( get_permalink( $comment->comment_post_ID ) ); ?>" rel="external nofollow" title="<?php echo esc_attr( $title ); ?>"> <?php echo esc_html( $title ); ?></a>: <?php echo esc_html(wp_html_excerpt( $comment->comment_content, $comment_length ) ); ?>
                                </div><!-- .hmc-comment-desc-wrap -->
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </div><!-- #comments -->

            </div><!-- .hmc-default-tabbed-wrapper -->
            <?php
            centurylib_after_widget($args);
        }

    }

endif;