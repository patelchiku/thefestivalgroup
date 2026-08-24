<?php
$share_type = isset( $share_type ) ? $share_type : 'text';
?>
<?php if ( sagen_select_is_plugin_installed( 'core' ) && sagen_select_options()->getOptionValue( 'enable_social_share' ) === 'yes' && sagen_select_options()->getOptionValue( 'enable_social_share_on_post' ) === 'yes' ) { ?>
	<div class="qodef-blog-share">
		<?php echo sagen_select_get_social_share_html( array( 'type' => $share_type ) ); ?>
	</div>
<?php } ?>