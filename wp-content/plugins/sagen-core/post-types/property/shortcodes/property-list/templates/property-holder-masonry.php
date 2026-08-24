<div class="qodef-property-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/filter', '', $params); ?>
	<div class="qodef-pl-inner qodef-outer-space clearfix">
		<div class="qodef-pl-grid-sizer"></div>
		<div class="qodef-pl-grid-gutter"></div>
		<?php 
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'property-item', $item_style, $params);
				endwhile;
			else:
				echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	
	<?php echo sagen_core_get_cpt_shortcode_module_template_part('property', 'property-list', 'pagination/'.$pagination_type, '', $params, $additional_params); ?>
</div>