<?php do_action('sagen_select_action_before_page_header'); ?>

<aside class="qodef-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
    <div class="qodef-vertical-area-background"></div>
	<div class="qodef-vertical-menu-area-inner">
		<?php if(!$hide_logo) {
			sagen_select_get_logo();
		} ?>
		<?php sagen_select_get_header_vertical_main_menu(); ?>
		<?php if ( sagen_select_is_header_widget_area_active( 'one' ) ) { ?>
			<div class="qodef-vertical-area-widget-holder">
				<?php sagen_select_get_header_widget_area_one(); ?>
			</div>
		<?php } ?>
	</div>
</aside>

<?php do_action('sagen_select_action_after_page_header'); ?>