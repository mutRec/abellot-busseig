<?php
/**
 * Create a metabox to added some custom filed in posts.
 *
 * @package Theme Century
 * @subpackage centurylib
 * @since 1.0.0
 */
if(!class_exists('Centurylib_Theme_Settings_Metabox')):

    class Centurylib_Theme_Settings_Metabox{

        public function __construct(){
            add_action( 'add_meta_boxes', array($this, 'add_meta_boxes' ) );
            add_action( 'save_post', array($this, 'save_post') );
        }

        public function save_post($post_id){
            
            global $post;

            $_all_post_vals = wp_unslash( $_POST );

            // Verify the nonce before proceeding.
            $centurylib_post_nonce   = isset( $_all_post_vals['centurylib_post_meta_nonce'] ) ? esc_html($_all_post_vals['centurylib_post_meta_nonce']) : '';
            $centurylib_post_nonce_action = basename( __FILE__ );

            //* Check if nonce is set...
            if ( ! isset( $centurylib_post_nonce ) ) {
                return;
            }

            //* Check if nonce is valid...
            if ( ! wp_verify_nonce( $centurylib_post_nonce, $centurylib_post_nonce_action ) ) {
                return;
            }

            //* Check if user has permissions to save data...
            if ( ! current_user_can( 'edit_page', $post_id ) ) {
                return;
            }

            //* Check if not an autosave...
            if ( wp_is_post_autosave( $post_id ) ) {
                return;
            }

            //* Check if not a revision...
            if ( wp_is_post_revision( $post_id ) ) {
                return;
            }

            /**
             * Post sidebar
             */
            
            $centurylib_single_sidebar_details = isset( $_all_post_vals['centurylib_single_post_sidebar'] ) ? $_all_post_vals['centurylib_single_post_sidebar'] : array();
            $centurylib_single_post_sidebar = array_map( 'esc_attr', $centurylib_single_sidebar_details );
            update_post_meta ( $post_id, 'centurylib_single_post_sidebar', $centurylib_single_post_sidebar );

            /**
             * post meta identity
             */
            $centurylib_post_meta_identity = get_post_meta( $post_id, 'centurylib_theme_settings_metabox_tab', true );
            $sanitize_post_identity = sanitize_text_field( $_all_post_vals[ 'centurylib_theme_settings_metabox_tab' ] );

            if ( $sanitize_post_identity && '' == $sanitize_post_identity ){
                add_post_meta( $post_id, 'centurylib_theme_settings_metabox_tab', $sanitize_post_identity );
            }elseif ( $sanitize_post_identity && $sanitize_post_identity != $centurylib_post_meta_identity ) {
                update_post_meta($post_id, 'centurylib_theme_settings_metabox_tab', $sanitize_post_identity );
            } elseif( '' == $sanitize_post_identity && $centurylib_post_meta_identity ) {
                delete_post_meta( $post_id, 'centurylib_theme_settings_metabox_tab', $centurylib_post_meta_identity );
            }
            
        }

        public function sidebar_layouts(){

            $sidebar_layouts = array(
                'default-sidebar' => array(
                    'id'        => 'post-default-sidebar',
                    'value'     => 'default_sidebar',
                    'label'     => esc_html__( 'Default Sidebar', 'hamroclass' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/centurylib/assets/img/sidebars/default-sidebar.png'
                ),
                'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left_sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'hamroclass' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/centurylib/assets/img/sidebars/left-sidebar.png'
                ),
                'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value'     => 'right_sidebar',
                    'label'     => esc_html__( 'Right sidebar', 'hamroclass' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/centurylib/assets/img/sidebars/right-sidebar.png'
                ),
                'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no_sidebar',
                    'label'     => esc_html__( 'No sidebar Full width', 'hamroclass' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/centurylib/assets/img/sidebars/no-sidebar.png'
                ),
                'no-sidebar-center' => array(
                    'id'        => 'post-no-sidebar-center',
                    'value'     => 'no_sidebar_center',
                    'label'     => esc_html__( 'No sidebar Content Centered', 'hamroclass' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/centurylib/assets/img/sidebars/no-sidebar-center.png'
                ),
                'both-sidebar' => array(
                    'id'        => 'post-both-sidebar',
                    'value'     => 'both_sidebar',
                    'label'     => esc_html__( 'Both Sidebar', 'hamroclass' ),
                    'thumbnail' => get_template_directory_uri() . '/inc/centurylib/assets/img/sidebars/both-sidebar.png'
                ),
            );

            return $sidebar_layouts;

        }

        public function add_meta_boxes(){

            add_meta_box(
                'centurylib_sidebar_layout_meta',
                esc_html__( 'Theme Options', 'hamroclass' ),
                array($this, 'metabox_callback'),
                array('post', 'page'),
                'normal',
                'high'
            );

        }

        public function metabox_fields(){

            $metabox_fields = array(
                'centurylib_single_post_sidebar'       => array(
                    'sidebar_layout' => array(
                        'tcy_metabox_field_name'     => 'sidebar_layout',
                        'tcy_metabox_field_title'    => esc_html__( 'Sidebar Layout', 'hamroclass' ),
                        'tcy_metabox_field_default'  => 'general',
                        'tcy_metabox_field_type'     => 'imageoptions',
                        'tcy_metabox_field_options'  => array(
                            'default_sidebar' => array(
                                'label' => esc_html__( 'Default Sidebar', 'hamroclass' ),
                                'url'   => '%s/inc/centurylib/assets/img/sidebars/default-sidebar.png'
                            ),
                            'left_sidebar' => array(
                                'label' => esc_html__( 'Left Sidebar', 'hamroclass' ),
                                'url'   => '%s/inc/centurylib/assets/img/sidebars/left-sidebar.png'
                            ),
                            'right_sidebar' => array(
                                'label' => esc_html__( 'Right Sidebar', 'hamroclass' ),
                                'url'   => '%s/inc/centurylib/assets/img/sidebars/right-sidebar.png'
                            ),
                            'no_sidebar' => array(
                                'label' => esc_html__( 'No Sidebar', 'hamroclass' ),
                                'url'   => '%s/inc/centurylib/assets/img/sidebars/no-sidebar.png'
                            ),
                            'no_sidebar_center' => array(
                                'label' => esc_html__( 'No Sidebar Center', 'hamroclass' ),
                                'url'   => '%s/inc/centurylib/assets/img/sidebars/no-sidebar-center.png'
                            ),
                            'both_sidebar' => array(
                                'label' => esc_html__( 'Both Sidebar', 'hamroclass' ),
                                'url'   => '%s/inc/centurylib/assets/img/sidebars/both-sidebar.png'
                            )
                        )
                    )
                )
            );

            return $metabox_fields;

        }

        public function metabox_tabs(){

            $metabox_tabs = array(
                'centurylib_single_post_sidebar'       => array(
                    'tcy_metabox_field_title'    => esc_html__( 'Sidebars', 'hamroclass' ),
                    'tcy_metabox_field_dashicons'=>  'dashicons-exerpt-view',
                    'tcy_metabox_field_heading'=>  esc_html__( 'Sidebar Settings', 'hamroclass' ),
                    'tcy_metabox_field_description'    =>  esc_html__( 'If you want to override customizer settings please choose sidebar otherwise leave it default sidebar.', 'hamroclass' ),
                ),
            );
            return $metabox_tabs;
            
        }

        public function metabox_callback(){

            global $post;
            $sidebar_layouts = $this->sidebar_layouts();

            $centurylib_theme_settings_metabox_tab = get_post_meta( $post->ID, 'centurylib_theme_settings_metabox_tab', true );
            $centurylib_theme_settings_metabox_tab = isset( $centurylib_theme_settings_metabox_tab ) ? $centurylib_theme_settings_metabox_tab : 'sidebars';
            wp_nonce_field( basename( __FILE__ ), 'centurylib_post_meta_nonce' );

            $centurylib_metabox_tabs = $this->metabox_tabs();
            $centurylib_metabox_fields = $this->metabox_fields();

            ?> 
            <style type = "text/css">

            .centurylib-metabox-theme-settings{
                border:none;
                padding-bottom: 40px;
            }
            .centurylib-metabox-theme-settings:after{
                content:"";
                clear:both;
                display:block;
            }
            .tcy-widget-tab-list{
                width: 25%;
                float: left;
                padding-top: 0px;
                box-sizing: border-box;
            }
            .tcy-widget-tab-list .nav-tab{
                float: none;
                display: block;
            }
            .nav-tab:focus, .nav-tab:hover, .nav-tab-active{
                color: #fff;
                border-color: #0085ba;
                background-color: #0085ba;
            }
            .tcy-tab-content-wraper{
                width: 75%;
                float: right;
                box-sizing: border-box;
            }
            .centurylib-imageoption{
                display:none;
            }
            .centurylib-fieldset-imageoption{
                margin:0 5px 5px 0;
                display: inline-block;
            }
            .centurylib-fieldset-imageoption  .centurylib-imageoption{
                display: none;
            }
            .centurylib-imageoption~label{
                display:block;
                line-height: 1em;
                border:2px solid #dedede;
            }
            .centurylib-imageoption:checked~label{
                border-color:#0085ba;
            }
            </style> 
            <div class="centurylib-metabox-theme-settings tcy-widget-field-tab-wraper">
                <div class="nav-tab-wrapper tcy-widget-tab-list">
                    <?php 
                    $centurylib_theme_settings_metabox_tab = ($centurylib_theme_settings_metabox_tab) ? $centurylib_theme_settings_metabox_tab : 'centurylib_single_post_sidebar';
                    foreach($centurylib_metabox_tabs as $centurylib_tab_slug => $tabs_details){ 
                        $tcy_metabox_field_title = (isset($tabs_details['tcy_metabox_field_title'])) ? esc_html($tabs_details['tcy_metabox_field_title']) : '';
                        $tcy_metabox_field_dashicons = (isset($tabs_details['tcy_metabox_field_dashicons'])) ? esc_html($tabs_details['tcy_metabox_field_dashicons']) : '';
                        ?>
                        <label class="centurylib-meta-tab nav-tab <?php echo ( $centurylib_theme_settings_metabox_tab==$centurylib_tab_slug ) ? 'nav-tab-active' : ''; ?>" for="centurylib_theme_settings_metabox_tab_<?php echo esc_attr($centurylib_tab_slug); ?>" data-id="#centurylib_theme_option_content_<?php echo esc_attr($centurylib_tab_slug); ?>"> <span class="dashicons <?php echo esc_attr($tcy_metabox_field_dashicons); ?>"></span><?php echo esc_html($tcy_metabox_field_title); ?><input id="centurylib_theme_settings_metabox_tab_<?php echo esc_attr($centurylib_tab_slug); ?>" type="radio" name="centurylib_theme_settings_metabox_tab" value="<?php echo esc_attr($centurylib_tab_slug); ?>" <?php checked( $centurylib_theme_settings_metabox_tab, $centurylib_tab_slug ); ?> class="tcy-hidden"></label>
                    <?php } ?>
                </div><!-- .tcy-widget-tab-list -->
                <div class="tcy-tab-content-wraper">
                    <!-- Info tab content -->
                    <?php foreach($centurylib_metabox_tabs as $centurylib_tab_slug => $tabs_details){ 
                        $tcy_metabox_field_heading = (isset($tabs_details['tcy_metabox_field_heading'])) ? esc_html($tabs_details['tcy_metabox_field_heading']) : '';
                        $tcy_metabox_field_description = (isset($tabs_details['tcy_metabox_field_description'])) ? esc_html($tabs_details['tcy_metabox_field_description']) : '';
                        $centurylib_tab_fields = (isset($centurylib_metabox_fields[$centurylib_tab_slug] ) ) ? $centurylib_metabox_fields[$centurylib_tab_slug] : array();
                        ?>
                        <div data-value="<?php echo esc_attr($centurylib_theme_settings_metabox_tab.':'.$centurylib_tab_slug); ?>" class="centurylib-tab-contents <?php echo ( $centurylib_theme_settings_metabox_tab==$centurylib_tab_slug ) ? 'centurylib-tab-active' : ''; ?>" id="centurylib_theme_option_content_<?php echo esc_attr($centurylib_tab_slug); ?>">
                            <div class="centurylib-tab-content-header">
                                <h3><?php echo esc_html($tcy_metabox_field_heading); ?></h3> 
                                <p><?php echo esc_html($tcy_metabox_field_description); ?></p>
                            </div><!-- .content-header --> 
                            <div class="centurylib-tab-content-fields">
                                <?php if($centurylib_tab_fields){
                                    foreach($centurylib_tab_fields as $centurylib_field_slug=>$centurylib_field_details){
                                        $tcy_metabox_field_name = (isset($centurylib_field_details['tcy_metabox_field_name'])) ? esc_attr($centurylib_field_details['tcy_metabox_field_name']) : '';
                                        $tcy_metabox_field_title = (isset($centurylib_field_details['tcy_metabox_field_title'])) ? esc_attr($centurylib_field_details['tcy_metabox_field_title']) : '';
                                        $tcy_metabox_field_default = (isset($centurylib_field_details['tcy_metabox_field_default'])) ? esc_attr($centurylib_field_details['tcy_metabox_field_default']) : '';
                                        $tcy_metabox_field_type = (isset($centurylib_field_details['tcy_metabox_field_type'])) ? esc_attr($centurylib_field_details['tcy_metabox_field_type']) : '';
                                        $tcy_metabox_field_options = (isset($centurylib_field_details['tcy_metabox_field_options'])) ? $centurylib_field_details['tcy_metabox_field_options'] : array();
                                        $centurylib_metabox_field_name = $centurylib_tab_slug.'['.$centurylib_field_slug.']';
                                        $centurylib_metabox_field_id = 'id_'.$centurylib_tab_slug.'_'.$centurylib_field_slug;
                                        ?><div class="centurylib-metabox-field-single"><?php
                                        switch ($tcy_metabox_field_type){
                                            case 'imageoptions':
                                                ?>
                                                <div class="centurylib-imageoption-field-wrapper">
                                                    <?php
                                                    foreach($tcy_metabox_field_options as $imageoption_key => $imageoption_details){ 
                                                        $centurylib_image_option_url = (isset($imageoption_details['url'])) ? $imageoption_details['url'] : '%s';
                                                        $centurylib_image_option_label = (isset($imageoption_details['label'])) ? esc_html($imageoption_details['label']) : '';
                                                        $centurylib_imageoption_id = $centurylib_metabox_field_id.'_'.$imageoption_key;
                                                        $centurylib_post_sidebar = 'default_sidebar';
                                                        ?>
                                                        <div class="centurylib-fieldset-imageoption">
                                                            <input class="centurylib-imageoption" type="radio" id="<?php echo esc_attr( $centurylib_imageoption_id ); ?>" value="<?php echo esc_attr( $imageoption_key ); ?>" name="<?php echo esc_attr($centurylib_metabox_field_name); ?>" <?php checked( $imageoption_key, $centurylib_post_sidebar ); ?> />
                                                            <label for="<?php echo esc_attr( $centurylib_imageoption_id ); ?>">
                                                                <span class="screen-reader-text"><?php echo esc_html( $centurylib_image_option_label ); ?> </span>
                                                                <img src="<?php echo esc_url(sprintf( $centurylib_image_option_url, get_template_directory_uri() ) ); ?>" title="<?php echo esc_attr( $centurylib_image_option_label ); ?>" alt="<?php echo esc_attr( $centurylib_image_option_label ); ?>" />
                                                            </label>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                                <?php
                                                break;
                                            default:
                                                ?><p><?php esc_html_e('Sorry metabox field not found.', 'hamroclass'); ?></p><?php
                                                break;
                                        }
                                        ?></div><?php
                                    }
                                }else{
                                    ?><p><?php esc_html_e('Please put some fields to show on metabox', 'hamroclass'); ?></p><?php
                                }
                                ?>
                            </div><!-- .meta-options-wrap  --> 
                        </div><!-- #centurylib-metabox-info -->
                    <?php } ?>
                </div><!-- .tcy-tab-content-wraper -->
            </div><!-- .centurylib-meta-container --> 
            <?php
        }
    }
endif;
new Centurylib_Theme_Settings_Metabox();