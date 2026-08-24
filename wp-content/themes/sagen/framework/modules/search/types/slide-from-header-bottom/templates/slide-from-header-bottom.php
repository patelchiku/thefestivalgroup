<div class="qodef-slide-from-header-bottom-holder">
	<div class="qodef-form-holder">
		<form action="<?php echo esc_url(home_url('/')); ?>" method="get">

			<button type="submit" <?php sagen_select_class_attribute($search_submit_icon_class); ?>>
				<?php echo sagen_select_get_icon_sources_html('search', false, array('search' => 'yes')); ?>
			</button>
			<input type="text" placeholder="<?php esc_attr_e('Search', 'sagen'); ?>" name="s" class="qodef-search-field"
				   autocomplete="off" required/>

		</form>

		<a <?php sagen_select_class_attribute($search_close_icon_class); ?> href="javascript:void(0)">
			<?php echo sagen_select_get_icon_sources_html('search', true, array('search' => 'yes')); ?>
		</a>
	</div>
</div>