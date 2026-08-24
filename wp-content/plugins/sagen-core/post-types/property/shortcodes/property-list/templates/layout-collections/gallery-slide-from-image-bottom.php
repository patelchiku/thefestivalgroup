<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/image', $item_style, $params); ?>

<div class="qodef-pli-text-holder">
	<div class="qodef-pli-text-wrapper">
		<div class="qodef-pli-text">

			<div class="qodef-pli-text-left">
				<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/category', $item_style, $params); ?>

				<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/title', $item_style, $params); ?>
			</div>

			<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/excerpt', $item_style, $params); ?>

		</div>
	</div>
</div>