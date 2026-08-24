<div class="qodef-process-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="qodef-mark-horizontal-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="qodef-process-mark">
				<div class="qodef-process-line"></div>
				<div class="qodef-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="qodef-mark-vertical-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="qodef-process-mark">
				<div class="qodef-process-line"></div>
				<div class="qodef-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="qodef-process-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>