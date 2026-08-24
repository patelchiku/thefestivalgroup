<div <?php sagen_select_class_attribute($table_classes); ?>>
	<div class="qodef-ct-table-holder-inner">
		<div class="qodef-ct-table-head-holder">
			<div class="qodef-ct-table-head-holder-inner">
				<?php if ($title !== '') : ?>
					<h6 class="qodef-ct-table-title"><?php echo esc_html($title); ?></h6>
				<?php endif; ?>
			</div>
		</div>

		<div class="qodef-ct-table-content">
			<?php echo do_shortcode(preg_replace('#^<\/p>|<p>$#', '', $content)); ?>
		</div>
	</div>
</div>