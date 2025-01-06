<?php
if ( !class_exists( 'Centurylib_Customize_Message_Control' ) ):
    /**
     * Custom Control for html display
     * @package themecentury
     * @subpackage Centurylib
     * @since 1.0.0
     *
     */
    class Centurylib_Customize_Message_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         * @access public
         * @var string
         */
        public $type = 'message';

        /**
         * Function to  render the content on the theme customizer page
         *
         * @access public
         * @since 1.0.0
         *
         * @param null
         * @return void
         *
         */
	    public function render_content() {
	    	
	    	if ( empty( $this->description ) && empty($this->label) ) {
	    		return;
	    	}
	    	$allowed_html = array(
	    		'a' => array(
	    			'href' => array(),
	    			'title' => array(),
	    			'data-panel' => array(),
	    			'data-section' => array(),
	    			'class' => array(),
	    			'target' => array(),
	    		),
	    		'hr' => array(),
	    		'br' => array(),
	    		'em' => array(),
	    		'strong' => array()
	    	);
	    	?>
	    	<div class="centurylib-customize-customize-message">
	    		<?php if(!empty($this->label)): ?>
	    			<h2 class="centurylib-customize-message-title"><?php echo esc_html($this->label); ?></h2>
	    		<?php endif; ?>
	    		<?php if(!empty($this->description)): ?>
	    			<p><?php echo wp_kses( $this->description , $allowed_html ); ?></p>
	    		<?php endif; ?>
	    	</div> <!-- .centurylib-customize-customize-message -->
	    	<?php
	    }
    }
    
endif;