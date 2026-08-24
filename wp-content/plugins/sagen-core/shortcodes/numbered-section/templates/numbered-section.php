<div class="qodef-numbered-section-holder <?php echo esc_attr( $holder_classes ); ?>">
	<?php if ( ! empty( $back_title ) ) { ?>
		<span class="qodef-ns-back-title" <?php echo sagen_select_get_inline_style( $back_title_styles ); ?>>
				<?php
				echo wp_kses(
					$back_title,
					array(
						'br'   => true,
						'span' => array( 'class' => true ),
					)
				);
				?>
			</span>
	<?php } ?>
	<div class="qodef-ns-inner">
		<?php if ( ! empty( $title ) ) { ?>
			<<?php echo sagen_select_escape_title_tag($title_tag ); ?> class="qodef-ns-title" <?php echo sagen_select_get_inline_style( $title_styles ); ?>>
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
		if ( $enable_separator === 'yes' ) {
			$sep_params = array(
				'color'     => $params['title_color'],
				'position'  => 'left',
				'width'     => '40',
				'thickness' => '1',
			);
			$paramssep  = '';
			if ( is_array( $sep_params ) && count( $sep_params ) ) {
				foreach ( $sep_params as $key => $value ) {
					$paramssep .= " $key='$value' ";
				}
			}
			echo do_shortcode( "[qodef_separator $paramssep]" );

		}
		?>

		<?php if ( ! empty( $text ) ) { ?>
			<p class="qodef-ns-text" <?php echo sagen_select_get_inline_style( $text_styles ); ?>>
				<?php echo wp_kses( $text, array( 'br' => true ) ); ?>
			</p>
		<?php } ?>
	</div>
</div>
