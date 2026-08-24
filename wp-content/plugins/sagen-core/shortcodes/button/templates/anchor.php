<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php sagen_select_inline_style($button_styles); ?> <?php sagen_select_class_attribute($button_classes); ?> <?php echo sagen_select_get_inline_attrs($button_data); ?> <?php echo sagen_select_get_inline_attrs($button_custom_attrs); ?>>
	<?php echo sagen_select_icon_collections()->renderIcon($icon, $icon_pack); ?>
	<span class="qodef-btn-svg">
		<svg x="0px" y="0px" viewBox="0 0 5.5 10.1" enable-background="new 0 0 5.5 10.1" >
				<path fill="#BBBBBB" d="M1.3,5.5L1.2,5.2C2.1,4.5,2.7,4.1,3,3.9c0.3-0.2,0.6-0.2,0.7-0.2c0.1,0,0.2,0,0.3,0.1S4.1,4,4.1,4.2
					c0,0.3-0.1,0.8-0.4,1.7L3.5,6.5c-0.3,1-0.4,1.6-0.4,1.9c0,0.1,0.1,0.2,0.2,0.2c0.1,0,0.4-0.2,1-0.6l0.2,0.3L3.2,9.1
					C2.8,9.3,2.6,9.4,2.4,9.5c-0.1,0-0.2,0.1-0.3,0.1c-0.1,0-0.3,0-0.3-0.1C1.7,9.3,1.7,9.2,1.7,8.9c0-0.3,0.1-0.7,0.2-1.1l0.4-1.4
					C2.4,5.7,2.5,5.3,2.5,5c0-0.1,0-0.2-0.1-0.2c-0.1,0-0.2,0-0.3,0.1C1.8,5.1,1.5,5.3,1.3,5.5z M3.2,2c0-0.3,0.1-0.5,0.2-0.7
					S3.8,1,4,1c0.2,0,0.3,0.1,0.5,0.2s0.2,0.3,0.2,0.5c0,0.3-0.1,0.5-0.2,0.7C4.3,2.5,4.1,2.6,3.8,2.6c-0.2,0-0.4-0.1-0.5-0.2
					C3.2,2.3,3.2,2.1,3.2,2z"/>
		</svg>
	</span>
	<span class="qodef-btn-text"><?php echo esc_html($text); ?></span>
</a>