<div class="qodef-process-item <?php echo esc_attr( $holder_classes ); ?>">
	<div class="qodef-pi-content">
		<?php if(!empty($title)) { ?>
			<<?php echo sagen_select_escape_title_tag($title_tag); ?> class="qodef-pi-title" <?php echo sagen_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo sagen_select_escape_title_tag($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="qodef-pi-text" <?php echo sagen_select_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>