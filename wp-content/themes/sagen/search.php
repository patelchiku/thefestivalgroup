<?php
$qodef_search_holder_params = sagen_select_get_holder_params_search();
?>
<?php get_header(); ?>
<?php sagen_select_get_title(); ?>
<?php do_action('sagen_select_action_before_main_content'); ?>
	<div class="<?php echo esc_attr( $qodef_search_holder_params['holder'] ); ?>">
		<?php do_action( 'sagen_select_action_after_container_open' ); ?>
		<div class="<?php echo esc_attr( $qodef_search_holder_params['inner'] ); ?>">
			<?php sagen_select_get_search_page(); ?>
		</div>
		<?php do_action( 'sagen_select_action_before_container_close' ); ?>
	</div>
<?php get_footer(); ?>