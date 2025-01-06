<?php
/**
 * Class to display theme information.
 *
 * @package themecentury
 * @subpackage centurylib
 */
if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Class Centurylib_Themeinfo_Control
 */
class Centurylib_Themeinfo_Control extends WP_Customize_Control {

	/**
	 * The type of customize section being rendered.
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $type = 'info';

	/**
	 * Control label
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $label = '';

	/**
	 * Control info
	 *
	 * @since  1.0.0
	 * @access public
	 * @var    string
	 */
	public $theme_info = array();

	public function __construct($manager, $id, $args = array() ){

		$this->theme_info = $args['theme_info'];
		parent::__construct( $manager, $id, $args );

	}

	/**
	 * The render function for the controler
	 */
	public function render_content() {

		$theme_info_links = $this->theme_info;
		?>

		<div class="centurylib-theme-info">
			<?php
			foreach ( $theme_info_links as $item ) {  ?>
				<a href="<?php echo esc_url( $item['link'] ); ?>" target="_blank"><?php echo esc_html( $item['name'] ); ?></a>
				<hr/>
				<?php
			} ?>
		</div>

		<?php

	}

}