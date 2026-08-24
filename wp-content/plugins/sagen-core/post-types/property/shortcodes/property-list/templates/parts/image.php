<?php
$thumb_size = $this_object->getImageSize($params);
?>
<div class="qodef-pli-image">
	<?php if ( has_post_thumbnail() ) {
		$image_src = get_the_post_thumbnail_url( get_the_ID() );
		
		if ( strpos( $image_src, '.gif' ) !== false ) {
			echo get_the_post_thumbnail( get_the_ID(), 'full' );
		} else {
			echo get_the_post_thumbnail( get_the_ID(), $thumb_size );
		}
	} else { ?>
		<img itemprop="image" class="qodef-pl-original-image" width="800" height="600" src="<?php echo SAGEN_CORE_CPT_URL_PATH.'/property/assets/img/property_featured_image.jpg'; ?>" alt="<?php esc_attr_e('Property Featured Image', 'sagen-core'); ?>" />
	<?php } ?>
</div>