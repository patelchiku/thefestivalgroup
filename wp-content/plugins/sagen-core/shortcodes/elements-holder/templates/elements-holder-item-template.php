<div class="qodef-eh-item <?php echo esc_attr($holder_classes); ?>" <?php echo sagen_select_get_inline_style($holder_styles); ?> <?php echo sagen_select_get_inline_attrs($holder_data); ?>>
	<div class="qodef-eh-item-inner">
		<div class="qodef-eh-item-content <?php echo esc_attr($holder_rand_class); ?>" <?php echo sagen_select_get_inline_style($content_styles); ?>>
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>