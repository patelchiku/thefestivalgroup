<?php
get_header();
sagen_select_get_title();
do_action('sagen_select_before_main_content'); ?>
<div class="qodef-container qodef-default-page-template">
	<?php do_action('sagen_select_after_container_open'); ?>
	<div class="qodef-container-inner clearfix">
		<?php
			$qodef_taxonomy_id = get_queried_object_id();
			$qodef_taxonomy_type	= is_tax( 'property-tag' ) ? 'property-tag' : 'property-category';
			$qodef_taxonomy	= ! empty( $qodef_taxonomy_id ) ? get_term_by( 'id', $qodef_taxonomy_id, $qodef_taxonomy_type) : '';
			$qodef_taxonomy_slug = !empty($qodef_taxonomy) ? $qodef_taxonomy->slug : '';
			$qodef_taxonomy_name = !empty($qodef_taxonomy) ? $qodef_taxonomy->taxonomy : '';
		
			sagen_core_get_archive_property_list($qodef_taxonomy_slug, $qodef_taxonomy_name);
		?>
	</div>
	<?php do_action('sagen_select_before_container_close'); ?>
</div>
<?php get_footer(); ?>
