<?php
/**
 * HamroClass Admin Class.
 *
 * @author  ThemeCentury
 * @package HamroClass
 * @since   1.0.0
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Hamroclass_Admin_Page')) :

    /**
     * Hamroclass_Admin_Page Class.
     */
    class Hamroclass_Admin_Page{

        /**
         * Constructor.
         */
        public function __construct()
        {
            add_action('admin_menu', array($this, 'admin_menu'));
            add_action('wp_loaded', array(__CLASS__, 'hide_notices'));
            add_action('load-themes.php', array($this, 'admin_notice'));
        }

        /**
         * Add admin menu.
         */
        public function admin_menu()
        {
            $theme = wp_get_theme(get_template());

            $page = add_theme_page(esc_html__('About', 'hamroclass') . ' ' . $theme->display('Name'), esc_html__('About', 'hamroclass') . ' ' . $theme->display('Name'), 'activate_plugins', 'hamroclass-welcome', array(
                $this,
                'welcome_screen'
            ));
            add_action('admin_print_styles-' . $page, array($this, 'enqueue_styles'));
        }

        /**
         * Enqueue styles.
         */
        public function enqueue_styles()
        {
            global $hamroclass_version;

            //wp_enqueue_style('hamroclass-welcome-admin', get_template_directory_uri() . '/core/admin/css/welcome-admin.css', array(), $hamroclass_version);
        }

        /**
         * Add admin notice.
         */
        public function admin_notice()
        {
            global $hamroclass_version, $pagenow;
            //wp_enqueue_style('hamroclass-message', get_template_directory_uri() . '/core/admin/css/admin-notices.css', array(), $hamroclass_version);

            // Let's bail on theme activation.
            if ('themes.php' == $pagenow && isset($_GET['activated'])) {
                add_action('admin_notices', array($this, 'welcome_notice'));
                update_option('hamroclass_admin_notice_welcome', 1);

                // No option? Let run the notice wizard again..
            } elseif (!get_option('hamroclass_admin_notice_welcome')) {
                add_action('admin_notices', array($this, 'welcome_notice'));
            }
        }

        /**
         * Hide a notice if the GET variable is set.
         */
        public static function hide_notices()
        {
            if (isset($_GET['hamroclass-hide-notice']) && isset($_GET['_hamroclass_notice_nonce'])) {
                if (!wp_verify_nonce(wp_unslash($_GET['_hamroclass_notice_nonce']), 'hamroclass_hide_notices_nonce')) {
                    wp_die(esc_html__('Action failed. Please refresh the page and retry.', 'hamroclass'));
                }

                if (!current_user_can('manage_options')) {
                    wp_die(esc_html__('Cheatin&#8217; huh?', 'hamroclass'));
                }

                $hide_notice = sanitize_text_field(wp_unslash($_GET['hamroclass-hide-notice']));
                update_option('hamroclass_admin_notice_' . $hide_notice, 1);
            }
        }

        /**
         * Show welcome notice.
         */
        public function welcome_notice()
        {
            ?>
            <div id="message" class="updated hamroclass-message">
                <a class="hamroclass-message-close notice-dismiss"
                   href="<?php echo esc_url(wp_nonce_url(remove_query_arg(array('activated'), add_query_arg('hamroclass-hide-notice', 'welcome')), 'hamroclass_hide_notices_nonce', '_hamroclass_notice_nonce')); ?>"><?php esc_html_e('Dismiss', 'hamroclass'); ?></a>
                <p><?php
                    /* translators: 1: anchor tag start, 2: anchor tag end*/
                    printf(esc_html__('Welcome! Thank you for choosing HamroClass! To fully take advantage of the best our theme can offer please make sure you visit our %1$swelcome page%1$s.', 'hamroclass'), '<a href="' . esc_url(admin_url('themes.php?page=hamroclass-welcome')) . '">', '</a>');
                    ?></p>
                <p class="submit">
                    <a class="button-secondary"
                       href="<?php echo esc_url(admin_url('themes.php?page=hamroclass-welcome')); ?>"><?php esc_html_e('Get started with HamroClass', 'hamroclass'); ?></a>
                </p>
            </div>
            <?php
        }

        /**
         * Intro text/links shown to all about pages.
         *
         * @access private
         */
        private function intro()
        {
            global $hamroclass_version;
            $theme = wp_get_theme(get_template());
            // Drop minor version if 0
            ?>
            <div class="hamroclass-theme-info">
                <h1>
                    <?php esc_html_e('About', 'hamroclass'); ?>
                    <?php echo esc_html( $theme->display('Name') ); ?>
                    <?php echo esc_html($hamroclass_version); ?>
                </h1>
                <div class="welcome-description-wrap">
                    <div class="about-text"><?php echo esc_html($theme->display('Description')); ?></div>
                    <div class="hamroclass-screenshot">
                        <img src="<?php echo esc_url(get_template_directory_uri()) . '/screenshot.png'; ?>"/>
                    </div>
                </div>
            </div>

            <p class="hamroclass-actions">
                <a href="<?php echo esc_url('https://themecentury.com/downloads/hamroclass-free-wordpress-theme/?ref=hamroclass-about-us'); ?>"
                   class="button button-secondary"
                   target="_blank"><?php esc_html_e('Theme Info', 'hamroclass'); ?></a>

                <a href="<?php echo esc_url(apply_filters('hamroclass_theme_url', 'https://demo.themecentury.com/wpthemes/hamroclass/')); ?>"
                   class="button button-secondary docs"
                   target="_blank"><?php esc_html_e('View Demo', 'hamroclass'); ?></a>

                <a href="<?php echo esc_url(apply_filters('hamroclass_rate_url', 'https://wordpress.org/support/view/theme-reviews/hamroclass?filter=5#postform')); ?>"
                   class="button button-secondary docs"
                   target="_blank"><?php esc_html_e('Rate this theme', 'hamroclass'); ?></a>
                <a href="<?php echo esc_url(apply_filters('hamroclass_pro_plugin_url', 'https://themecentury.com/downloads/hamroclass-pro-premium-wordpress-plugin/?ref=hamroclass-about-us')); ?>"
                   class="button button-primary docs"
                   target="_blank"><?php esc_html_e('View Pro Version', 'hamroclass'); ?></a>
            </p>

            <h2 class="nav-tab-wrapper">
                <a class="nav-tab <?php if (empty($_GET['tab']) && $_GET['page'] == 'hamroclass-welcome') {
                    echo 'nav-tab-active';
                } ?>"
                   href="<?php echo esc_url(admin_url(add_query_arg(array('page' => 'hamroclass-welcome'), 'themes.php'))); ?>">
                    <?php echo esc_html($theme->display('Name')); ?>
                </a>
                <a class="nav-tab <?php if (isset($_GET['tab']) && $_GET['tab'] == 'changelog') {
                    echo 'nav-tab-active';
                } ?>" href="<?php echo esc_url(admin_url(add_query_arg(array(
                    'page' => 'hamroclass-welcome',
                    'tab' => 'changelog'
                ), 'themes.php'))); ?>">
                    <?php esc_html_e('Changelog', 'hamroclass'); ?>
                </a>

            </h2>
            <?php
        }

        /**
         * Welcome screen page.
         */
        public function welcome_screen()
        {
            $current_tab = empty($_GET['tab']) ? 'about' : sanitize_title(wp_unslash($_GET['tab']));

            // Look for a {$current_tab}_screen method.
            if (is_callable(array($this, $current_tab . '_screen'))) {
                return $this->{$current_tab . '_screen'}();
            }

            // Fallback to about screen.
            return $this->about_screen();
        }

        /**
         * Output the about screen.
         */
        public function about_screen()
        {
            $theme = wp_get_theme(get_template());
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <div class="changelog point-releases">
                    <div class="under-the-hood two-col">

                        <div class="col">
                            <h3><?php esc_html_e('Theme Customizer', 'hamroclass'); ?></h3>
                            <p><?php esc_html_e('All Theme Options are available via Customize screen.', 'hamroclass') ?></p>
                            <p><a href="<?php echo esc_url( admin_url('customize.php') ); ?>"
                                  class="button button-secondary"><?php esc_html_e('Customize', 'hamroclass'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Documentation', 'hamroclass'); ?></h3>
                            <p><?php esc_html_e('Please view our documentation page to setup the theme.', 'hamroclass') ?></p>
                            <p><a href="<?php echo esc_url('https://docs.themecentury.com/products/hamroclass/'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Documentation', 'hamroclass'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Got theme support question?', 'hamroclass'); ?></h3>
                            <p><?php esc_html_e('Please put it in our dedicated support forum.', 'hamroclass') ?></p>
                            <p><a href="<?php echo esc_url('https://themecentury.com/forums/forum/hamroclass-free-wordpress-theme/'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Support', 'hamroclass'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3><?php esc_html_e('Any question about this theme or us?', 'hamroclass'); ?></h3>
                            <p><?php esc_html_e('Please send it via our sales contact page.', 'hamroclass') ?></p>
                            <p><a href="<?php echo esc_url('https://themecentury.com/contact/'); ?>"
                                  class="button button-secondary"><?php esc_html_e('Contact Page', 'hamroclass'); ?></a>
                            </p>
                        </div>

                        <div class="col">
                            <h3>
                                <?php
                                esc_html_e('Translate', 'hamroclass');
                                echo ' ' . esc_html($theme->display('Name'));
                                ?>
                            </h3>
                            <p><?php esc_html_e('Click below to translate this theme into your own language.', 'hamroclass') ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://translate.wordpress.org/projects/wp-themes/hamroclass'); ?>"
                                   class="button button-secondary">
                                    <?php
                                    esc_html_e('Translate', 'hamroclass');
                                    echo ' ' . esc_html($theme->display('Name'));
                                    ?>
                                </a>
                            </p>
                        </div>
                    </div>
                </div>

                <div class="return-to-dashboard hamroclass">
                    <?php if (current_user_can('update_core') && isset($_GET['updated'])) : ?>
                        <a href="<?php echo esc_url(self_admin_url('update-core.php')); ?>">
                            <?php is_multisite() ? esc_html_e('Return to Updates', 'hamroclass') : esc_html_e('Return to Dashboard &rarr; Updates', 'hamroclass'); ?>
                        </a> |
                    <?php endif; ?>
                    <a href="<?php echo esc_url(self_admin_url()); ?>"><?php is_blog_admin() ? esc_html_e('Go to Dashboard &rarr; Home', 'hamroclass') : esc_html_e('Go to Dashboard', 'hamroclass'); ?></a>
                </div>
            </div>
            <?php
        }

        /**
         * Output the changelog screen.
         */
        public function changelog_screen()
        {
            global $wp_filesystem;

            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <p class="about-description"><?php esc_html_e('View changelog below:', 'hamroclass'); ?></p>

                <?php
                $changelog_file = apply_filters('hamroclass_changelog_file', get_template_directory() . '/readme.txt');

                // Check if the changelog file exists and is readable.
                if ($changelog_file && is_readable($changelog_file)) {
                    WP_Filesystem();
                    $changelog = $wp_filesystem->get_contents($changelog_file);
                    $changelog_list = $this->parse_changelog($changelog);

                    echo wp_kses_post($changelog_list);
                }
                ?>
            </div>
            <?php
        }

        /**
         * Output the changelog screen.
         */
        public function freevspro_screen()
        {
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <p class="about-description"><?php esc_html_e('Upgrade to PRO version for more awesome features.', 'hamroclass'); ?></p>

                <table>
                    <thead>
                    <tr>
                        <th class="table-feature-title"><h3><?php esc_html_e('Features', 'hamroclass'); ?></h3>
                        </th>
                        <th><h3><?php esc_html_e('HamroClass', 'hamroclass'); ?></h3></th>
                        <th><h3><?php esc_html_e('HamroClass Pro', 'hamroclass'); ?></h3></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><h3><?php esc_html_e('Support', 'hamroclass'); ?></h3></td>
                        <td><?php esc_html_e('Forum', 'hamroclass'); ?></td>
                        <td><?php esc_html_e('Forum + Emails/Support Ticket', 'hamroclass'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Category color options', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Additional color options', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('15', 'hamroclass'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Primary color option', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Font size options', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Google fonts options', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><?php esc_html_e('500+', 'hamroclass'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Custom widgets', 'hamroclass'); ?></h3></td>
                        <td><?php esc_html_e('7', 'hamroclass'); ?></td>
                        <td><?php esc_html_e('16', 'hamroclass'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social icons', 'hamroclass'); ?></h3></td>
                        <td><?php esc_html_e('6', 'hamroclass'); ?></td>
                        <td><?php esc_html_e('6', 'hamroclass'); ?></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Social sharing', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Site layout option', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Options in breaking news', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Change read more text', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Related posts', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Author biography', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Footer copyright editor', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('728x90 Advertisement', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Featured category slider', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Random posts widget', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Tabbed widget', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Videos', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>

                    <tr>
                        <td><h3><?php esc_html_e('WooCommerce compatible', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Multiple header options', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Readmore flying card', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Weather widget', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Currency converter widget', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Category enable/disable option', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Reading indicator option', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Lightbox support', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Call to action widget', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td><h3><?php esc_html_e('Contact us template', 'hamroclass'); ?></h3></td>
                        <td><span class="dashicons dashicons-no"></span></td>
                        <td><span class="dashicons dashicons-yes"></span></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="btn-wrapper">
                            <a href="<?php echo esc_url( apply_filters('hamroclass_pro_plugin_url', 'https://themecentury.com/downloads/hamroclass-premium-wordpress-plugin/') ); ?>"
                               class="button button-secondary docs"
                               target="_blank"><?php esc_html_e('View Pro', 'hamroclass'); ?></a>
                        </td>
                    </tr>
                    </tbody>
                </table>

            </div>
            <?php
        }

        /**
         * Parse changelog from readme file.
         *
         * @param  string $content
         *
         * @return string
         */
        private function parse_changelog($content)
        {
            $matches = null;
            $regexp = '~==\s*Changelog\s*==(.*)($)~Uis';
            $changelog = '';

            if (preg_match($regexp, $content, $matches)) {
                $changes = explode('\r\n', trim($matches[1]));

                $changelog .= '<pre class="changelog">';

                foreach ($changes as $index => $line) {
                    $changelog .= wp_kses_post(preg_replace('~(=\s*Version\s*(\d+(?:\.\d+)+)\s*=|$)~Uis', '<span class="title">${1}</span>', $line));
                }

                $changelog .= '</pre>';
            }

            return wp_kses_post($changelog);
        }


        /**
         * Output the supported plugins screen.
         */
        public function supported_plugins_screen()
        {
            ?>
            <div class="wrap about-wrap">

                <?php $this->intro(); ?>

                <p class="about-description"><?php esc_html_e('This theme recommends following plugins:', 'hamroclass'); ?></p>
                <ol>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/social-icons/'); ?>"
                           target="_blank"><?php esc_html_e('Social Icons', 'hamroclass'); ?></a>
                        <?php esc_html_e(' by ThemeCentury', 'hamroclass'); ?>
                    </li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/easy-social-sharing/'); ?>"
                           target="_blank"><?php esc_html_e('Easy Social Sharing', 'hamroclass'); ?></a>
                        <?php esc_html_e(' by ThemeCentury', 'hamroclass'); ?>
                    </li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/contact-form-7/'); ?>"
                           target="_blank"><?php esc_html_e('Contact Form 7', 'hamroclass'); ?></a></li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/wp-pagenavi/'); ?>"
                           target="_blank"><?php esc_html_e('WP-PageNavi', 'hamroclass'); ?></a></li>
                    <li><a href="<?php echo esc_url('https://wordpress.org/plugins/woocommerce/'); ?>"
                           target="_blank"><?php esc_html_e('WooCommerce', 'hamroclass'); ?></a></li>
                    <li>
                        <a href="<?php echo esc_url('https://wordpress.org/plugins/polylang/'); ?>"
                           target="_blank"><?php esc_html_e('Polylang', 'hamroclass'); ?></a>
                        <?php esc_html_e('Fully Compatible in Pro Version', 'hamroclass'); ?>
                    </li>
                    <li>
                        <a href="<?php echo esc_url('https://wpml.org/'); ?>"
                           target="_blank"><?php esc_html_e('WPML', 'hamroclass'); ?></a>
                        <?php esc_html_e('Fully Compatible in Pro Version', 'hamroclass'); ?>
                    </li>
                </ol>

            </div>
            <?php
        }

    }

endif;

return new Hamroclass_Admin_Page();
