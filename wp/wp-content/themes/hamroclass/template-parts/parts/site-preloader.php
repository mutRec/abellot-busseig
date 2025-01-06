<?php
/**
 * The template for Site Preloader
 *
 * @package themecentury
 * @subpackage hamroclass
 * @since 1.0.0
 */

$preloader = get_theme_mod('hamroclass_preloader_image');
if($preloader){
	?>
	<div id="hamroclass_preloader_wrapper" class="hmc-preloader-wrapper">
		<div class="hmc-preloader-table">
			<div class="hmc-table-cell">
				<span class="spinner">
					<img class="img-responsive" src="<?php echo esc_url($preloader); ?>" alt="<?php esc_attr_e('HamroClass Preloader', 'hamroclass'); ?>">
				</span>
			</div>
		</div>
	</div>
	<?php
}