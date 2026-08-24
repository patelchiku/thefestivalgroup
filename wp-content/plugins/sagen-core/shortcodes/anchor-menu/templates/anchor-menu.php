<div class="qodef-anchor-menu">
	<div class="qodef-anchor-menu-items">
		<?php foreach ( $menu_items as $menu_item ){
			$styles = array();
			if ( isset( $menu_item['label_color'] ) && ! empty( $menu_item['label_color'] ) ) {
				$styles[] = 'color: ' . $menu_item['label_color'];
			}
			?>
			<a class="qodef-anchor" href="<?php echo esc_attr( $menu_item['anchor'] ); ?>" <?php sagen_select_inline_style( $styles ); ?>>
				<span class="qodef-anchor-label"><?php echo esc_attr( $menu_item['label'] ); ?></span>
			</a>
		<?php } ?>
	</div>
</div>