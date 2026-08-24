<section class="qodef-enquire-menu">
	<a <?php sagen_select_class_attribute( $close_icon_classes ); ?> href="#">
		<span class="qodef-hm-lines">
			<span class="qodef-hm-line qodef-line-1"></span>
			<span class="qodef-hm-line qodef-line-2"></span>
		</span>
	</a>
	<?php if ( is_active_sidebar( 'enquirearea' ) ) {
		dynamic_sidebar( 'enquirearea' );
	} ?>
</section>