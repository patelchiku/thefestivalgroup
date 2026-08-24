<<?php echo sagen_select_escape_title_tag($title_tag ); ?> class="qodef-custom-font-holder <?php echo esc_attr( $holder_classes ); ?>" <?php sagen_select_inline_style( $holder_styles ); ?> <?php echo sagen_select_get_inline_attrs( $holder_data ); ?>>
	<?php echo wp_kses_post( $title ); ?>
</<?php echo sagen_select_escape_title_tag($title_tag ); ?>>