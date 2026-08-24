<?php do_action('sagen_select_action_before_page_header'); ?>

<div class="qodef-vertical-menu-area-overlay"></div>
<aside class="qodef-vertical-menu-area <?php echo esc_attr($holder_class); ?>">
    <div class="qodef-vertical-menu-area-inner">
		<a href="javascript:void(0)" <?php sagen_select_class_attribute( $vertical_closed_icon_class ); ?>>
			<span class="qodef-vertical-area-close-icon">
				<?php echo sagen_select_get_icon_sources_html( 'vertical_closed', true ); ?>
			</span>
			<span class="qodef-vertical-area-opener-icon">
				<?php echo sagen_select_get_icon_sources_html( 'vertical_closed' ); ?>
			</span>
		</a>
        <?php if(!$hide_logo) {
			sagen_select_get_logo();
        } ?>

        <?php sagen_select_get_header_vertical_closed_main_menu(); ?>

	    <?php if ( sagen_select_is_header_widget_area_active( 'one' ) ) { ?>
		    <div class="qodef-vertical-area-widget-holder">
			    <?php sagen_select_get_header_widget_area_one(); ?>
		    </div>
	    <?php } ?>
    </div>
	<div class="qodef-vertical-area-bottom-logo">
		<div class="qodef-vertical-area-bottom-logo-inner">
			<?php if(!$hide_logo) {
				sagen_select_get_logo('vertical_closed');
			} ?>
		</div>
		<?php if ( sagen_select_is_header_widget_area_active( 'two' ) ) { ?>
			<div class="qodef-vertical-area-bottom-widget-holder">
				<?php sagen_select_get_header_widget_area_two(); ?>
			</div>
		<?php } ?>
	</div>
</aside>

<?php do_action('sagen_select_action_after_page_header'); ?>