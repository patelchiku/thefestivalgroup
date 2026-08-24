<div class="qodef-counter-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="qodef-counter-inner">
		<?php if ( ! empty( $digit ) ) { ?>
			<span class="qodef-counter <?php echo esc_attr( $type ); ?>" <?php echo sagen_select_get_inline_style( $counter_styles ); ?>><?php echo esc_html( $digit ); ?></span>
		<?php } ?>

		<?php
		$sep_params = array(
			'color'     => $params['title_color'],
			'width'     => '40',
			'thickness' => '1',
		);

		$paramssep = '';

		if ( is_array( $sep_params ) && count( $sep_params ) ) {
			foreach ( $sep_params as $key => $value ) {
				$paramssep .= " $key='$value' ";
			}
		}
		?>

		<?php echo do_shortcode( "[qodef_separator $paramssep]" ); ?>

		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo sagen_select_escape_title_tag($title_tag ); ?> class="qodef-counter-title" <?php echo sagen_select_get_inline_style( $counter_title_styles ); ?>>
				<?php echo esc_html( $title ); ?>
			</<?php echo sagen_select_escape_title_tag($title_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $text ) ) { ?>
			<p class="qodef-counter-text" <?php echo sagen_select_get_inline_style( $counter_text_styles ); ?>><?php echo esc_html( $text ); ?></p>
		<?php } ?>
	</div>
</div>
