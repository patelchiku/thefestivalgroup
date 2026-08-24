<?php if ($enable_title === 'yes') {
	$title_tag = !empty($title_tag) ? $title_tag : 'h4';
	$title_styles = $this_object->getTitleStyles($params);
	?>
	<<?php echo sagen_select_escape_title_tag($title_tag); ?> itemprop="name" class="qodef-pli-title entry-title" <?php sagen_select_inline_style($title_styles); ?>>
		<?php echo esc_attr(get_the_title()); ?>
	</<?php echo sagen_select_escape_title_tag($title_tag); ?>>
<?php } ?>