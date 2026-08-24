<?php
$tags      = wp_get_post_terms( get_the_ID(), 'property-tag' );
$tag_names = array();

if ( is_array( $tags ) && count( $tags ) ) : ?>
	<div class="qodef-ps-info-item qodef-ps-tags">
		<h4 class="qodef-ps-info-title"><?php esc_html_e( 'Tags:', 'sagen-core' ); ?></h4>
		<?php foreach ( $tags as $tag ) { ?>
			<a itemprop="url" class="qodef-ps-info-tag" href="<?php echo esc_url( get_term_link( $tag->term_id ) ); ?>"><?php echo esc_html( $tag->name ); ?></a>
		<?php } ?>
	</div>
<?php endif; ?>
