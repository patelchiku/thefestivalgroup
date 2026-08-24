<?php if($max_num_pages > 1) { ?>
	<div class="qodef-blog-pag-load-more">
		<?php
			$button_params = array(
				'type' => 'outline',
				'link' => 'javascript: void(0)',
				'text' => esc_html__( 'Load More', 'sagen' ),
				'custom_class' => 'qodef-blog-pag-loading'
			);
			
			echo sagen_select_return_button_html( $button_params );
		?>
	</div>
<?php
	$unique_id = rand( 1000, 9999 );
	wp_nonce_field( 'qodef_blog_load_more_nonce_' . $unique_id, 'qodef_blog_load_more_nonce_' . $unique_id );
}