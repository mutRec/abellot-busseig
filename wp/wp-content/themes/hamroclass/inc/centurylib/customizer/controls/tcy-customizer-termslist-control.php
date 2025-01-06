<?php
/*
 * Category Control
 */

if(!class_exists('Centurylib_Term_List_Control') ){

	/**
     * Custom Control for category dropdown
     * @package themecentury
     * @subpackage Centurylib
     * @since 1.0.0
     *
     */
    class Centurylib_Term_List_Control extends WP_Customize_Control {

        /**
         * Declare the control type.
         *
         * @access public
         * @var string
         */
        public $type = 'termlist';

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

            $categories = get_categories();
            ?>
            <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
            <select <?php $this->link(); ?>>
                <option value="0"><?php esc_html_e( 'All', 'hamroclass' );?></option>
                <?php
                foreach ( $categories as $cat ) {
                    if ( $cat->count > 0 ) {
                        echo '<option value="' . esc_attr( $cat->term_id ) . '" ' . selected( $this->value(), $cat->term_id ) . '>' . esc_attr( $cat->cat_name ) . '</option>';
                    }
                }
                ?>
            </select>
            <?php
        }
    }

}