<?php

if ( ! class_exists( 'Centurylib_Customizer_Repeater_Control' )):
	/**
	 * Custom Control Repeater Controls
	 * @package themecentury
	 * @subpackage Centurylib
	 * @since 1.0.0
	 *
	 */
	class Centurylib_Customizer_Repeater_Control extends WP_Customize_Control{

		/**
		 * The control type.
		 *
		 * @access public
		 * @var string
		 */
		public $type = 'repeater';

		public $wraper_item_label = '';

		public $add_row_label = '';

		/**
		 * The fields that each container row will contain.
		 *
		 * @access public
		 * @var array
		 */
		public $fields = array();

		/**
		 * Repeater drag and drop controler
		 *
		 * @since  1.0.0
		 */
		public function __construct( $manager, $id, $args = array(), $fields = array() ) {

			$this->fields                       = $fields;
			$this->wraper_item_label          = $args['wraper_item_label'];
			$this->add_row_label   = $args['add_row_label'];
			parent::__construct( $manager, $id, $args );

		}

		public function enqueue(){

			wp_enqueue_style( 'font-awesome', centurylib_directory_uri('assets/library/font-awesome/css/font-awesome.min.css'), array(), '4.7.0' );
			wp_enqueue_style( 'tcy-customizer-icons-control-css',  centurylib_directory_uri('assets/parts/controls/css/tcy-customizer-icons-control.min.css'), array(), '1.0.0' );
			wp_enqueue_script('tcy-customizer-icons-control-js', centurylib_directory_uri('assets/parts/controls/js/tcy-customizer-icons-control.min.js'), array('jquery'), '1.0.0', false );
			wp_enqueue_style( 'tcy-customizer-repeater-control-css',  centurylib_directory_uri('assets/parts/controls/css/tcy-customizer-repeater-control.min.css'), array(), '1.0.0' );
			wp_enqueue_script('tcy-customizer-repeater-control-js', centurylib_directory_uri('assets/parts/controls/js/tcy-customizer-repeater-control.min.js'), array('jquery'), '1.0.0', false);

		}

		public function render_content() {
			?>
            <span class="customize-control-title">
                <?php echo esc_html( $this->label ); ?>
            </span>
            <?php if ( $this->description ) { ?>
            	<span class="description customize-control-description">
            		<?php echo wp_kses_post( $this->description ); ?>
            	</span>
            <?php } ?>
            <ul class="centurylib-main-repeater-field-wrap-control">
				<?php $this->get_fields(); ?>
            </ul>
            <input type="hidden" <?php $this->link(); ?> class="centurylib-main-repeater-collection" value="<?php echo esc_attr( $this->value() ); ?>"/>
            <button type="button" class="button centurylib-main-repeater-add-control-field"><?php echo esc_html( $this->add_row_label ); ?></button>
			<?php
		}

		private function get_fields() {

			$repeater_fields = $this->fields;
			$repeater_values = json_decode( $this->value() );

			?>
            <script type="text/html" class="centurylib-main-repeater-field-generator">
                <li class="centurylib-main-repeater-field-control">
                    <h3 class="repeater-field-title accordion-section-title">
						<?php echo esc_html( $this->wraper_item_label ); ?>
                    </h3>
                    <div class="repeater-fields hidden">
						<?php
						foreach ( $repeater_fields as $key => $field_single ) {
							$class = isset( $field_single['class'] ) ? $field_single['class'] : '';
							?>
                            <div class="single-field type-<?php echo esc_attr( $field_single['type'] ) . ' ' . esc_attr($class); ?>">
								<?php
								$label       = isset( $field_single['label'] ) ? $field_single['label'] : '';
								$description = isset( $field_single['description'] ) ? $field_single['description'] : '';
								if ( $field_single['type'] != 'checkbox' ) { ?>
                                    <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                    <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
									<?php
								}
								$new_value = '';
								$default   = isset( $field_single['default'] ) ? $field_single['default'] : '';

								switch ( $field_single['type'] ) {
									case 'text':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
										break;

									case 'url':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="url" value="' . esc_url( $new_value ) . '"/>';
										break;

									case 'checkbox':
										echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="checkbox" value="' . esc_attr( $new_value ) . '"/>';
										?>
                                        <span class="customize-control-title checkbox"><?php echo esc_html( $label ); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
										<?php
										break;

									case 'textarea':
										echo '<textarea data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
										break;

									case 'select':
										$options = $field_single['options'];
										echo '<select  data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">';
										foreach ( $options as $option => $val ) {
											printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_attr( $val ) );
										}
										echo '</select>';
										break;

									case 'color':
										echo '<input class="tcy-color-picker" data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_url( $new_value ) . '"/>';
										break;
									case 'reaction':
										$reaction_default_val = 'like';
										?>
										<div class="tcy-imageoption-wrapper">
											<?php 
											$centurylib_reactions_icons = centurylib_reactions_icons();
											foreach($centurylib_reactions_icons as $reaction_slug => $reaction_details){ 
												$reaction_label = $reaction_details['label'];
												$reaction_url = $reaction_details['url'];
												?>
												<fieldset class="tcy-imageoption-single">
													<input 
													type="radio" 
													name="<?php echo esc_attr( $key ); ?>"
													data-name="<?php echo esc_attr( $key ); ?>"
													class="centurylib-imageoption-radio" 
													id="<?php echo esc_attr($key.'_'.$reaction_slug); ?>" 
													value="<?php echo esc_attr($reaction_slug); ?>" 
													<?php checked( $reaction_default_val, $reaction_slug); ?> 
													/> 
													<label 
													class="tcy-customizer-imageoption-label" 
													for="<?php echo esc_attr($key.'_'.$reaction_slug); ?>">
														<span class="screen-reader-text"><?php echo esc_html($reaction_label); ?></span>
														<img src="<?php echo esc_url($reaction_url); ?>" title="<?php echo esc_attr($reaction_label); ?>" alt="<?php echo esc_attr($reaction_label); ?>" />
													</label>
												</fieldset>
											<?php } ?>
										</div>
										<?php
										break;
									case 'icons':
										?>
                                        <span class="tcy-customize-icons">
                                            <span class="centurylib-icon-preview"></span>
                                            <span class="tcy-icon-toggle">
                                                <?php esc_html_e('Add Icon','hamroclass'); ?>
                                                <span class="dashicons dashicons-arrow-down"></span>
                                            </span>
                                            <span class="tcy-icons-list-wrapper hidden">
                                                <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','hamroclass'); ?>">
                                                <?php
                                                $fa_icon_list_array = centurylib_fa_iconslist();
                                                foreach ( $fa_icon_list_array as $single_icon ) {
                                                    echo '<span class="tcy-single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                                                }
                                                ?>
                                            </span>
                                            <?php
                                            echo '<input class="tcy-icon-value"  data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="hidden" value="' . esc_attr( $new_value ) . '"/>';
                                            ?>
                                        </span>
										<?php
										break;
									default:
										?>
										<h5><?php echo esc_html__('Field type ', 'hamroclass') . esc_attr( $field_single['type'] ) . esc_html__(' not found.', 'hamroclass'); ?></h5>
										<?php
										break;
								}
								?>
                            </div>
							<?php
						}
						?>
                        <div class="clearfix repeater-footer">
                            <a class="repeater-field-remove" href="#remove">
								<?php esc_html_e( 'Delete', 'hamroclass' ) ?>
                            </a>
                            <?php esc_html_e( '|', 'hamroclass' ) ?>
                            <a class="repeater-field-close" href="#close">
								<?php esc_html_e( 'Close', 'hamroclass' ) ?>
                            </a>
                        </div>
                    </div>
                </li>
            </script>

			<?php
			if ( is_array( $repeater_values ) ) {
				foreach ( $repeater_values as $field_index=>$field_value ) { ?>
                    <li class="centurylib-main-repeater-field-control">
                        <h3 class="repeater-field-title accordion-section-title">
							<?php echo esc_html( $this->wraper_item_label ); ?>
                        </h3>
                        <div class="repeater-fields hidden">
							<?php
							foreach ( $repeater_fields as $key => $field_single ) {
								$class = isset( $field_single['class'] ) ? $field_single['class'] : '';
								?>
                                <div class="single-field type-<?php echo esc_attr( $field_single['type'] ) . ' ' . esc_attr($class); ?>">
									<?php
									$label       = isset( $field_single['label'] ) ? $field_single['label'] : '';
									$description = isset( $field_single['description'] ) ? $field_single['description'] : '';
									if ( $field_single['type'] != 'checkbox' ) { ?>
                                        <span class="customize-control-title"><?php echo esc_html( $label ); ?></span>
                                        <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
										<?php
									}
									$new_value = isset( $field_value->$key ) ? $field_value->$key : '';
									$default   = isset( $field_single['default'] ) ? $field_single['default'] : '';
									switch ( $field_single['type'] ) {
										case 'text':
											echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_attr( $new_value ) . '"/>';
											break;

										case 'url':
											echo '<input data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="url" value="' . esc_url( $new_value ) . '"/>';
											break;

										case 'checkbox':
											echo '<input '.checked(true, $new_value,false).' data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="checkbox" value="' . esc_attr( $new_value ) . '"/>';
											?>
                                            <span class="customize-control-title checkbox"><?php echo esc_html( $label ); ?></span>
                                            <span class="description customize-control-description"><?php echo esc_html( $description ); ?></span>
											<?php
											break;

										case 'textarea':
											echo '<textarea data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">' . esc_textarea( $new_value ) . '</textarea>';
											break;

										case 'select':
											$options = $field_single['options'];
											echo '<select  data-default="' . esc_attr( $default ) . '"  data-name="' . esc_attr( $key ) . '">';
											foreach ( $options as $option => $val ) {
												printf( '<option value="%s" %s>%s</option>', esc_attr( $option ), selected( $new_value, $option, false ), esc_attr( $val ) );
											}
											echo '</select>';
											break;
										case 'color':
											echo '<input class="tcy-color-picker" data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="text" value="' . esc_url( $new_value ) . '"/>';
											break;
										case 'reaction':
										?>
										<div class="tcy-imageoption-wrapper">
											<?php
											$centurylib_reactions_icons = centurylib_reactions_icons();
											foreach($centurylib_reactions_icons as $reaction_slug => $reaction_details){ 
												$reaction_label = $reaction_details['label'];
												$reaction_url = $reaction_details['url'];
												?>
												<fieldset class="tcy-imageoption-single">
													<input 
													type="radio" 
													name="<?php echo esc_attr( $key.'_'.$field_index ); ?>"
													data-name="<?php echo esc_attr( $key ); ?>"
													class="centurylib-imageoption-radio" 
													id="<?php echo esc_attr($key.'_'.$reaction_slug.'_'.$field_index ); ?>" 
													data-default="<?php esc_attr( $default ); ?>"
													value="<?php echo esc_attr($reaction_slug); ?>" 
													<?php checked( $new_value, $reaction_slug); ?> 
													/> 
													<label 
													class="tcy-customizer-imageoption-label" 
													for="<?php echo esc_attr($key.'_'.$reaction_slug.'_'.$field_index ); ?>">
														<span class="screen-reader-text"><?php echo esc_html($reaction_label); ?></span>
														<img src="<?php echo esc_url($reaction_url); ?>" title="<?php echo esc_attr($reaction_label); ?>" alt="<?php echo esc_attr($reaction_label); ?>" />
													</label>
												</fieldset>
											<?php } ?>
										</div>
										<?php
										break;
										case 'icons':
											?>
                                            <span class="tcy-customize-icons">
                                                <span class="centurylib-icon-preview">
                                                    <?php if( !empty( $new_value ) ) { echo '<i class="fa '. esc_attr( $new_value ) .'"></i>'; } ?>
                                                </span>
                                                <span class="tcy-icon-toggle">
                                                    <?php echo ( empty( $new_value )? esc_html__('Add Icon','hamroclass'): esc_html__('Edit Icon','hamroclass') ); ?>
                                                    <span class="dashicons dashicons-arrow-down"></span>
                                                </span>
                                                <span class="tcy-icons-list-wrapper hidden">
                                                    <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','hamroclass')?>">
                                                    <?php
                                                    $fa_icon_list_array = centurylib_fa_iconslist();
                                                    foreach ( $fa_icon_list_array as $single_icon ) {
                                                        if( $new_value == $single_icon ) {
                                                            echo '<span class="tcy-single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                                                        } else {
                                                            echo '<span class="tcy-single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                <?php
                                                echo '<input class="tcy-icon-value"  data-default="' . esc_attr( $default ) . '" data-name="' . esc_attr( $key ) . '" type="hidden" value="' . esc_attr( $new_value ) . '"/>';
                                                ?>
                                            </span>
											<?php
											break;
										default:
											?>
											<h5><?php echo esc_html__('Field type ', 'hamroclass') . esc_attr( $field_single['type'] ) . esc_html__(' not found.', 'hamroclass'); ?></h5>
											<?php
											break;
									}
									?>
                                </div>
								<?php
							}
							?>
                            <div class="clearfix repeater-footer">
                                <a class="repeater-field-remove" href="#remove">
									<?php esc_html_e( 'Delete', 'hamroclass' ) ?>
                                </a><?php esc_html_e( '|', 'hamroclass' ) ?>
                                <a class="repeater-field-close" href="#close">
									<?php esc_html_e( 'Close', 'hamroclass' ) ?>
                                </a>
                            </div>
                        </div>
                    </li>
				<?php
				}
			}
		}
	}
endif;