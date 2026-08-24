<div class="qodef-pie-chart-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-pc-percentage" <?php echo sagen_select_get_inline_attrs($pie_chart_data); ?>>
		<span class="qodef-pc-percent" <?php echo sagen_select_get_inline_style($percent_styles); ?>><?php echo esc_html($percent); ?></span>
	</div>

	<?php if(!empty($title) || !empty($text)) { ?>
		<div class="qodef-pc-text-holder">
			<?php if(!empty($title)) { ?>
				<<?php echo sagen_select_escape_title_tag($title_tag); ?> class="qodef-pc-title" <?php echo sagen_select_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo sagen_select_escape_title_tag($title_tag); ?>>
			<?php } ?>
			<?php if(!empty($text)) { ?>
				<p class="qodef-pc-text" <?php echo sagen_select_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
			<?php } ?>
		</div>
	<?php } ?>
</div>