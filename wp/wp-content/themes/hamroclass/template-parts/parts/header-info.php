<?php
/*
 * @package themecentury
 * @subpackage hamroclass
 * @version 1.0.2
 */
$call_support = get_theme_mod( 'hamroclass_call_support', esc_html__( 'Call Support: ', 'hamroclass' ) );
$phone_number = get_theme_mod( 'hamroclass_phone_number', '00619800000000' );

$email_support = get_theme_mod( 'hamroclass_email_support', esc_html__( 'Email Support: ', 'hamroclass' ) );
$official_email = get_theme_mod( 'hamroclass_official_email', 'info@example.com' );

$location_support = get_theme_mod( 'hamroclass_location_support', esc_html__( 'Location: ', 'hamroclass' ) );
$location_text = get_theme_mod( 'hamroclass_location_text', esc_html__('Sydney New South Wales', 'hamroclass' ) );
$map_location_link = get_theme_mod( 'hamroclass_map_location_link', 'https://www.google.com/maps' );
?>
<div class="header-info-wrapper">
    <?php if($call_support || $phone_number ){ ?>
        <div class="header-info-item">
            <i class="fa fa-phone" aria-hidden="true"></i>
            <div class="info-inner-wrap">
                <span><?php echo esc_html($call_support); ?></span>
                <a href="tel:<?php echo esc_attr($phone_number); ?>"><?php echo esc_html($phone_number); ?></a>
            </div>
        </div>
    <?php } ?>
    <?php if($email_support || $official_email ){ ?>
        <div class="header-info-item">
            <i class="fa fa-envelope-o" aria-hidden="true"></i>
            <div class="info-inner-wrap">
                <span><?php echo esc_html($email_support); ?></span>
                <a href="mailto:<?php echo esc_attr($official_email);  ?>"><?php echo esc_html($official_email) ?></a>
            </div>
        </div>
    <?php } ?>
    <?php if($location_support || $map_location_link ){ ?>
        <div class="header-info-item">
            <i class="fa fa-map-marker" aria-hidden="true"></i>
            <div class="info-inner-wrap">
                <span><?php echo esc_html($location_support); ?></span>
                <a target="_blank" href="<?php echo esc_url($map_location_link); ?>"><?php echo esc_html($location_text); ?></a>
            </div>
        </div>
    <?php } ?>
</div>