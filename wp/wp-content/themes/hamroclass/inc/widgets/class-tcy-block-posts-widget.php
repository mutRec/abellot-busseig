<?php
/**
 * Widget: Block Posts
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
if(!class_exists( 'HamroClass_Block_Posts_Widget' ) ):

	class HamroClass_Block_Posts_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_block_posts_widget hmc-full-widget',
				'description' => esc_html__( 'Displays block posts from selected category in different layouts.', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_block_posts_widget', esc_html__( 'HC - Block Posts', 'hamroclass' ), $widget_ops );
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
									'centurylib_widget_field_name'        => 'title',
									'centurylib_widget_field_default'  => esc_html__( 'Block Posts', 'hamroclass' ),
									'centurylib_widget_field_title'       => esc_html__( 'Block title', 'hamroclass' ),
									'centurylib_widget_field_description' => esc_html__( 'Enter your block title. (Optional - Leave blank to hide title.)', 'hamroclass' ),
									'centurylib_widget_field_type'  => 'text'
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
									'centurylib_widget_field_name'          => 'block_term_ids',
									'centurylib_widget_field_title'         => esc_html__( 'Block Category', 'hamroclass' ),
									'centurylib_widget_field_default'       => 0,
									'centurylib_widget_field_type'   => 'multitermlist',
									'centurylib_widget_taxonomy_type' => 'category',
								),
								'tab_term_list' => array(
									'centurylib_widget_field_name'         => 'tab_term_list',
									'centurylib_widget_field_title'        => esc_html__( 'Tab Category List', 'hamroclass' ),
									'centurylib_widget_field_default'      => 'none',
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_options' => array(
										'none' => esc_html__( 'None', 'hamroclass' ),
										'selected' => esc_html__( 'Block Category List', 'hamroclass' ),
										'otherterm' => esc_html__( 'Others Category List', 'hamroclass' ),
									),
									'centurylib_widget_field_relation' => array(
										'values' => array(
											'otherterm' => array(
												'show_fields'   => array(
													'tabs-terms', 
													'default-tablabel',
												),
											),
											'none' => array(
												'hide_fields'   => array(
													'tabs-terms', 
													'default-tablabel',
												),
											),
											'selected' => array(
												'hide_fields'   => array(
													'tabs-terms', 
												),
												'show_fields'   => array(
													'default-tablabel',
												),
											),
										),
									),
								),
								'tabs_terms' => array(
									'centurylib_widget_field_name'         => 'tabs_terms',
									'centurylib_widget_field_wraper'       => 'tabs-terms',
									'centurylib_widget_field_title'        => esc_html__( 'Tab Categories', 'hamroclass' ),
									'centurylib_widget_field_default'      => 0,
									'centurylib_widget_field_type'   => 'multitermlist',
									'centurylib_widget_taxonomy_type' => 'category',
								),
								'default_tablabel' => array(
									'centurylib_widget_field_name'         => 'default_tablabel',
									'centurylib_widget_field_wraper'       => 'default-tablabel',
									'centurylib_widget_field_title'        => esc_html__( 'All Tab Label', 'hamroclass' ),
									'centurylib_widget_field_default'      => esc_html__('All', 'hamroclass'),
									'centurylib_widget_field_type'         => 'text',
								),
								
							),
						),
						'layout'=>array(
							'centurylib_widget_field_title'=>esc_html__('Layout', 'hamroclass'),
							'centurylib_widget_field_options'=> array(
								'block_layout' => array(
									'centurylib_widget_field_name'         => 'block_layout',
									'centurylib_widget_field_title'        => esc_html__( 'Block Layouts', 'hamroclass' ),
									'centurylib_widget_field_default'      => 'layout5',
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_options' => array(
										'layout1' => esc_html__( 'Layout 1 - (LeftBig - Right list)', 'hamroclass' ),
										'layout2' => esc_html__( 'Layout 2 - (TwoBit - List bottom)', 'hamroclass' ),
										'layout3' => esc_html__( 'Layout 3 - (BigTop - three small)', 'hamroclass' ),
										'layout4' => esc_html__( 'Layout 4 - (Alternate Grid)', 'hamroclass' ),
										'layout5' => esc_html__( 'Layout 5 - (Blog Style)', 'hamroclass' ),
									),
								),
								'largeimg_size' => array(
									'centurylib_widget_field_name'         => 'largeimg_size',
									'centurylib_widget_field_title'        => esc_html__( 
										'Large Image Size', 'hamroclass' ),
									'centurylib_widget_field_default'=> 'hamroclass-thumb-622x420',
									'centurylib_widget_field_type' => 'select',
									'centurylib_widget_field_options'   => centurylib_get_image_sizes(),
								),
								'large_excerpt_length' => array(
									'centurylib_widget_field_name'         => 'large_excerpt_length',
									'centurylib_widget_field_title'        => esc_html__( 'Large Description Length', 'hamroclass' ),
									'centurylib_widget_field_default'      => '200',
									'centurylib_widget_field_type'   => 'number',
									'centurylib_widget_field_description'  => esc_html__( 'Enter the large description length in character.', 'hamroclass'),
								),
								'thumbnail_size' => array(
									'centurylib_widget_field_name'         => 'thumbnail_size',
									'centurylib_widget_field_title'        => esc_html__( 
										'Thumbnail Image Size', 'hamroclass' ),
									'centurylib_widget_field_default'=> 'hamroclass-thumb-136x102',
									'centurylib_widget_field_type' => 'select',
									'centurylib_widget_field_options'   => centurylib_get_image_sizes(),
								),
								'small_excerpt_length' => array(
									'centurylib_widget_field_name'         => 'small_excerpt_length',
									'centurylib_widget_field_title'        => esc_html__( 'Small Description Length', 'hamroclass' ),
									'centurylib_widget_field_default'      => '100',
									'centurylib_widget_field_type'   => 'number',
									'centurylib_widget_field_description'  => esc_html__( 'Enter the short description length in character.', 'hamroclass'),
								),
							),
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
		 * @param array $args Widget arguments.
		 * @param array $instance Saved values from database.
		 */
		public function widget( $args, $instance ) {

			/*
			 * Title Section
			 */			
			$before_title = (isset($args['before_title'])) ? $args['before_title'] : '';
			$after_title = (isset($args['after_title'])) ? $args['after_title'] : '';

			/*
			 * General Tab
			 */			
			$title  = isset( $instance['title'] ) ? $instance['title'] : '';
			$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$title_target      = isset( $instance['title_target'] ) ? $instance['title_target'] : '';
			$title_link  = isset( $instance['title_link'] ) ? $instance['title_link'] : '';
			$block_term_ids = isset( $instance['block_term_ids'] ) ? $instance['block_term_ids'] : '';
			$default_tablabel   = isset( $instance['default_tablabel'] ) ? $instance['default_tablabel'] : '';
			$tab_term_list   = isset( $instance['tab_term_list'] ) ? $instance['tab_term_list'] : 'none';
			$tabs_terms   = isset( $instance['tabs_terms'] ) ? $instance['tabs_terms'] : '';

	        /*
	         * Layout Tab
	         */
	        $block_layout   = isset( $instance['block_layout'] ) ? $instance['block_layout'] : 'layout1';
	        $thumbnail_size = isset( $instance['thumbnail_size'] ) ? $instance['thumbnail_size'] : 'thumbnail';
	        $small_excerpt_length   = isset( $instance['small_excerpt_length'] ) ? $instance['small_excerpt_length'] : 100;
	        $largeimg_size = isset( $instance['largeimg_size'] ) ? $instance['largeimg_size'] : 'full';
	        $large_excerpt_length   = isset( $instance['large_excerpt_length'] ) ? $instance['large_excerpt_length'] : 200;

	        centurylib_before_widget($args);

	        $title_args = array(
	        	'title' => $title,
	        	'title_target'=> $title_target,
	        	'title_link' => $title_link,
	        	'before_title'=>$before_title,
	        	'after_title'=>$after_title
	        );
	        if($tab_term_list!='none'){
	        	$title_args['title_terms'] = ($tab_term_list=='otherterm') ? $tabs_terms : $block_term_ids;
	        	$title_args['default_tablabel'] = isset( $instance['default_tablabel'] ) ? esc_attr($instance['default_tablabel']) : '';
	        	$title_args['tab_ajax_data'] = array(
	        		'type'      => 'POST',
	        		'dataType'  => 'json',
	        		'url'       => admin_url( 'admin-ajax.php' ),
	        		'data'      => array(
	        			'action'                => 'hamroclass_block_posts_tabs',
	        			'block_layout'          => $block_layout,
	        			'thumbnail_size'        => $thumbnail_size,
	        			'largeimg_size'         => $largeimg_size,
	        			'small_excerpt_length'  => $small_excerpt_length,
	        			'large_excerpt_length'  => $large_excerpt_length,
	        			'posts_per_page'        => 6,
	        			'block_posts_nonce'    => wp_create_nonce( 'hamroclass_block_post_tabs_nonce' )
	        		),
	        	);
	        }
	        ?>
	        <div class="hmc-container">
	        	<?php
	        	do_action('centurylib_widget_title', $title_args);
	        	?>
	        	<div class="hmc-block-wrapper block-posts hmc-clearfix <?php echo esc_attr( $block_layout ); ?>">
	        		<div class="hmc-block-posts-wrapper centurylib-tab-alldata tab-active">
	        			<?php
	        			$hamroclass_args = array(
	        				'terms_ids' => $block_term_ids,
	        				'thumbnail_size' => $thumbnail_size,
	        				'largeimg_size' => $largeimg_size,
	        				'small_excerpt_length'  => $small_excerpt_length,
	        				'large_excerpt_length' => $large_excerpt_length,
	        			);
	        			switch ( $block_layout ) {
	        				case 'layout2':
	        				hamroclass_block_second_layout_section( $hamroclass_args );
	        				break;
	        				case 'layout3':
	        				hamroclass_block_box_layout_section( $hamroclass_args );
	        				break;
	        				case 'layout4':
	        				hamroclass_block_alternate_grid_section( $hamroclass_args );
	        				break;
	        				case 'layout5':
	        				hamroclass_block_blog_style_section( $hamroclass_args );
	        				break;
	        				default:
	        				hamroclass_block_one_layout_section( $hamroclass_args );
	        				break;
	        			}
	        			?>
	        			<?php do_action( 'hamroclass_widget_blockposts_pagination', $hamroclass_args ); ?>
	        		</div><!-- .hmc-block-posts-wrapper -->
	        		<figure class="hmrcls-wdgt-preloader hidden">
	        			<span class="helper"></span>
	        			<img src="<?php echo esc_url( centurylib_directory_uri('assets/img/preloader/loader3.gif') ); ?>" height="100" width="100" alt="Preloader" title="Preloader" />
	        		</figure>
	        	</div><!--- .hmc-block-wrapper -->
	        </div>
	        <?php
	        centurylib_after_widget($args);

	    }

	}

endif;