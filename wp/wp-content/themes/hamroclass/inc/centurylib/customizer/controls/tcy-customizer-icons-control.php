<?php
/**
 * Custom Control for Icons Controls
 * @package themecentury
 * @subpackage Centurylib
 * @since 1.0.0
 *
 */
if ( !class_exists( 'Centurylib_Customize_Icons_Control' )):

	class Centurylib_Customize_Icons_Control extends WP_Customize_Control {

		public $type = 'icons';
		
		public function enqueue(){

			wp_enqueue_style( 'font-awesome', centurylib_directory_uri('assets/library/font-awesome/css/font-awesome.min.css'), array(), '4.7.0' );
			wp_enqueue_style( 'tcy-customizer-icons-control-css',  centurylib_directory_uri('assets/parts/controls/css/tcy-customizer-icons-control.min.css'), array(), '1.0.0' );
			wp_enqueue_script('tcy-customizer-icons-control-js', centurylib_directory_uri('assets/parts/controls/js/tcy-customizer-icons-control.min.js'), array('jquery'), '1.0.0', false );

		}

		public function render_content() {
			$value = $this->value();
			?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
                <span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
                <span class="tcy-customize-icons">
                    <span class="centurylib-icon-preview">
                        <?php if( !empty( $value ) ) { echo '<i class="fa '. esc_attr( $value ) .'"></i>'; } ?>
                    </span>
                    <span class="tcy-icon-toggle">
                        <?php echo ( empty( $value ) ? esc_html__('Add Icon','hamroclass'): esc_html__('Change Icon','hamroclass') ); ?>
                        <span class="dashicons dashicons-arrow-down"></span>
                    </span>
                    <span class="tcy-icons-list-wrapper hidden">
                        <input class="icon-search" type="text" placeholder="<?php esc_attr_e('Search Icon','hamroclass'); ?>">
	                    <?php
	                    $fa_icon_list_array = centurylib_fa_iconslist();
	                    foreach ( $fa_icon_list_array as $single_icon ) {
		                    if( $value === $single_icon ) {
			                    echo '<span class="tcy-single-icon selected"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
		                    }else{
			                    echo '<span class="tcy-single-icon"><i class="fa '. esc_attr( $single_icon ) .'"></i></span>';
		                    }
	                    }
	                    ?>
                    </span>
                    <input type="hidden" class="tcy-icon-value" value="" <?php $this->link(); ?>>
                </span>
            </label>
			<?php
		}

	}

endif;