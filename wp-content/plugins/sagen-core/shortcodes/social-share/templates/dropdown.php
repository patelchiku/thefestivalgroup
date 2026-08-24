<div class="qodef-social-share-holder qodef-dropdown <?php echo esc_attr( $dropdown_class ); ?>">
	<a class="qodef-social-share-dropdown-opener" href="javascript:void(0)">
		<span class="qodef-social-share-title"><?php echo ! empty( $title ) ? esc_html( $title ) : esc_html__( 'Share', 'sagen-core' ); ?></span>
		<i class="social_share"></i>
	</a>
	<div class="qodef-social-share-dropdown">
		<ul>
			<?php foreach ( $networks as $net ) {
				echo wp_kses( $net, array(
					'li'   => array(
						'class' => true
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true
					),
					'span' => array(
						'class' => true
					)
				) );
			} ?>
		</ul>
	</div>
</div>