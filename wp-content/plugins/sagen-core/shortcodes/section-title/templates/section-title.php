<div class="qodef-section-title-holder <?php echo esc_attr( $holder_classes ); ?>" <?php echo sagen_select_get_inline_style( $holder_styles ); ?>>
	<div class="qodef-st-inner">
		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo sagen_select_escape_title_tag($title_tag ); ?> class="qodef-st-title" <?php echo sagen_select_get_inline_style( $title_styles ); ?>>
				<?php
				echo wp_kses(
					$title,
					array(
						'br'   => true,
						'span' => array( 'class' => true ),
					)
				);
				?>
			</<?php echo sagen_select_escape_title_tag($title_tag ); ?>>
		<?php } ?>

		<?php
		$sep_params = array(
			'color'     => $params['title_color'],
			'position'  => $params['position'],
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

		<?php if ( ! empty( $text ) ) { ?>
			<<?php echo sagen_select_escape_title_tag($text_tag ); ?> class="qodef-st-text" <?php echo sagen_select_get_inline_style( $text_styles ); ?>>
				<?php echo wp_kses( $text, array( 'br' => true ) ); ?>
			</<?php echo sagen_select_escape_title_tag($text_tag ); ?>>
		<?php } ?>
		<?php if ( ! empty( $button_parameters ) ) { ?>
			<div class="qodef-st-button"><?php echo sagen_select_get_button_html( $button_parameters ); ?></div>
		<?php } ?>
	</div>
</div>
