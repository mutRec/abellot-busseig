<?php
/**
 * Widget: Block Partner
 *
 * Widget show the block posts from selected category in different layouts.
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */
if(!class_exists( 'HamroClass_Our_Team_Widget' ) ):

	class HamroClass_Our_Team_Widget extends Centurylib_Master_Widget{

		/**
		 * Register widget with WordPress.
		 */
		public function __construct() {
			$widget_ops = array(
				'classname'   => 'hamroclass_our_team_widget hmc-full-widget',
				'description' => esc_html__( 'Displays our team from selected category in different layouts.', 'hamroclass' )
			);
			parent::__construct( 'hamroclass_our_team_widget', esc_html__( 'HC - Our Team', 'hamroclass' ), $widget_ops );
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
									'centurylib_widget_field_title'       => esc_html__( 'Section Title', 'hamroclass' ),
									'centurylib_widget_field_default'       => esc_html__( 'Our Teams', 'hamroclass' ),
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
								'our_team_list'         => array(
									'centurylib_widget_field_name'     => 'our_team_list',
									'centurylib_widget_field_title'    => esc_html__( 'Our Team List', 'hamroclass' ),
									'centurylib_widget_field_type'     => 'repeater',
									'centurylib_widget_description'    => esc_html__('To add team block click to add icon.', 'hamroclass'),
									'centurylib_widget_field_wraper'   => 'our-team-list-wrapper',
									'tcy_repeater_row_title'    => esc_html__('Team details', 'hamroclass'),
									'tcy_repeater_addnew_label' => esc_html__('Add Team Member', 'hamroclass'),
									'centurylib_widget_field_default'	=> array(
										array(
											'team_fullname' => esc_html__( 'Team One', 'hamroclass' ),
											'team_position' => esc_html__( 'Position One', 'hamroclass' ),
											'our_team_image' => get_template_directory_uri().'/assets/img/blank-image.jpg',
											'our_team_link'	=> '',
											'team_description' => esc_html__('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
										),
										array(
											'team_fullname' => esc_html__( 'Team Two', 'hamroclass' ),
											'team_position' => esc_html__( 'Position Two', 'hamroclass' ),
											'our_team_image' => get_template_directory_uri().'/assets/img/blank-image.jpg',
											'our_team_link'	=> '',
											'team_description' => esc_html__('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
										),
										array(
											'team_fullname' => esc_html__( 'Team Three', 'hamroclass' ),
											'team_position' => esc_html__( 'Position Three', 'hamroclass' ),
											'our_team_image' => get_template_directory_uri().'/assets/img/blank-image.jpg',
											'our_team_link'	=> '',
											'team_description' => esc_html__('Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.', 'hamroclass' ),
										),
									),
									'centurylib_widget_field_options'  => array(
										'team_fullname' => array(
											'centurylib_widget_field_name'     => 'team_fullname',
											'centurylib_widget_field_title'    => esc_html__( 'Full Name', 'hamroclass' ),
											'centurylib_widget_field_default'  => '#',
											'centurylib_widget_field_type'     => 'text',
										),
										'team_position' => array(
											'centurylib_widget_field_name'     => 'team_position',
											'centurylib_widget_field_title'    => esc_html__( 'Position', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'text',
										),
										'our_team_image' => array(
											'centurylib_widget_field_name'     => 'our_team_image',
											'centurylib_widget_field_title'    => esc_html__( 'Our Team Image', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'upload',
										),
										'our_team_link' => array(
											'centurylib_widget_field_name'     => 'our_team_link',
											'centurylib_widget_field_title'    => esc_html__( 'Our Team Link', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'url',
										),
										'team_description'    => array(
											'centurylib_widget_field_name'     => 'team_description',
											'centurylib_widget_field_wraper'   => 'team-description',
											'centurylib_widget_field_title'    => esc_html__( 'About team member', 'hamroclass' ),
											'centurylib_widget_field_default'  => '',
											'centurylib_widget_field_type'     => 'textarea',
											'centurylib_widgets_row' 			=> 5,
										),
									),
								),
								'our_team_target'    => array(
									'centurylib_widget_field_name'     => 'our_team_target',
									'centurylib_widget_field_wraper'   => 'our-team-target',
									'centurylib_widget_field_title'    => esc_html__( 'Team link target', 'hamroclass' ),
									'centurylib_widget_field_default'  => '',
									'centurylib_widget_field_type'     => 'select',
									'centurylib_widget_field_options'  => centurylib_link_target(),
								),
							),
						),
						'layout'=>array(
							'centurylib_widget_field_title'=>esc_html__('Column', 'hamroclass'),
							'centurylib_widget_field_options'=> array(
								'no_of_columns' => array(
									'centurylib_widget_field_name'         => 'no_of_columns',
									'centurylib_widget_field_title'        => esc_html__( 'Block Columns', 'hamroclass' ),
									'centurylib_widget_field_default'      => 'column3',
									'centurylib_widget_field_type'   => 'select',
									'centurylib_widget_field_options' => array(
										'column1' => esc_html__( 'Column 1', 'hamroclass' ),
										'column2' => esc_html__( 'Column 2', 'hamroclass' ),
										'column3' => esc_html__( 'Column 3', 'hamroclass' ),
										'column4' => esc_html__( 'Column 4', 'hamroclass' ),
									),
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

			extract( $args );
			if ( empty( $instance ) ) {
				return;
			}
			$title  = isset( $instance['title'] ) ? $instance['title'] : '';
			$title 	= apply_filters( 'widget_title', $title, $instance, $this->id_base );
			$title_target      = isset( $instance['title_target'] ) ? $instance['title_target'] : '';
			$title_link  = isset( $instance['title_link'] ) ? $instance['title_link'] : '';
			$our_team_list = isset($instance['our_team_list']) ? $instance['our_team_list'] : '';
			$our_team_target = isset($instance['our_team_target']) ? $instance['our_team_target'] : '';

	        /*
	         * Layout Tab
	         */
	        $no_of_columns   = isset( $instance['no_of_columns'] ) ? esc_attr($instance['no_of_columns']) : 'layout1';

	        centurylib_before_widget($args);
	        ?>
	        <div class="hmc-container">
	        	<?php
	        	$title_args = array(
	        		'title' => $title,
	        		'title_target'=> $title_target,
	        		'title_link' => $title_link,
	        		'before_title'=>$before_title,
	        		'after_title'=>$after_title
	        	);
	        	do_action('centurylib_widget_title', $title_args);
	        	?>
	        	<div class="hamroclass-team-blocks <?php echo esc_attr( $no_of_columns ); ?>">
	        		<?php
	        		$our_team_list = apply_filters( 'hamroclass_widget_our_team_list', $our_team_list, $instance, $args, $this );
	        		$this->team_list_template($our_team_list, $instance, $args );
	        		?>
	        	</div><!--- .hamroclass-team-blocks-->
	        </div>
	        <?php
	        centurylib_after_widget($args);
	    }


	    public function team_list_template($our_team_list, $instance, $args ){

	    	$our_team_target = isset($instance['our_team_target']) ? $instance['our_team_target'] : '';

	    	if($our_team_list){ 
	    		?>
	    		<ul class="team-block-list">
	    			<?php foreach($our_team_list as $index=>$team_details){ 
	    				$team_fullname = isset($team_details['team_fullname']) ? $team_details['team_fullname'] : '';
	    				$team_position = isset($team_details['team_position']) ? $team_details['team_position'] : '';
	    				$team_image = isset($team_details['our_team_image']) ? $team_details['our_team_image'] : '';
	    				$team_link = isset($team_details['our_team_link']) ? $team_details['our_team_link'] : '';
	    				$team_description = isset($team_details['team_description']) ? $team_details['team_description'] : '';
	    				?>
	    				<li class="team-block-item">
	    					<?php if($team_link && $our_team_target): ?>
	    						<a href="<?php echo esc_url($team_link); ?>" target="<?php echo esc_attr($our_team_target); ?>">
	    						<?php endif; ?>
	    						<div class="team-image-block">
	    							<figure class="<?php echo ($team_image) ? 'has-team-image' : 'no-team-image'; ?>">
	    								<?php if($team_image): ?>
	    									<img src="<?php echo esc_url($team_image); ?>" title="" alt=""/>
	    								<?php endif; ?>
	    							</figure>
	    							<div class="team-info-wrap">
	    								<?php if($team_fullname){ ?>
	    									<h4 class="team-name"><?php echo esc_html($team_fullname); ?></h4>
	    								<?php } ?>
	    								<?php if($team_position){ ?>
	    									<h6 class="team-position"><?php echo esc_html($team_position); ?></h6>
	    								<?php } ?>
	    							</div>
	    						</div>
	    						<?php if($team_link && $our_team_target): ?>
	    						</a>
	    					<?php endif; ?>
	    					<?php if($team_description){ ?>
	    						<div class="team-message"><?php echo esc_html($team_description); ?></div>
	    					<?php } 
	    					do_action( 'team_member_social_icons', $team_details, $instance, $args, $this );
	    					?>
	    				</li>
	    			<?php } ?>
	    		</ul>
	    		<?php 
	    	}
	    }

	}

endif;