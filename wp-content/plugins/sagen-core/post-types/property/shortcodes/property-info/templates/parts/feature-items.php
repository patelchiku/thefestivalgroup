<?php
$features_array = get_post_meta(get_the_ID(), 'qodef_property_feature_repeater', true);
?>
<div class="qodef-pi-feature-items clearfix">
	<?php if ( ! empty($features_array) ) { ?>
		<?php foreach($features_array as $i) { ?>

			<div class="qodef-pi-feature-item">
				<div class="qodef-pifi-image">
					<img src="<?php echo esc_html($i['qodef_property_feature_image']); ?>" alt="<?php echo esc_html($i['qodef_property_feature_title']) ?>">
				</div>
				<div class="qodef-pifi-content">
					<h6 class="qodef-pifi-title">
						<?php echo esc_html($i['qodef_property_feature_title']) ?>
					</h6>
					<p class="qodef-pifi-excerpt">
						<?php echo esc_html($i['qodef_property_feature_description']) ?>
					</p>
				</div>
			</div>

		<?php } ?>
	<?php } ?>
</div>