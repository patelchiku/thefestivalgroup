<div class="qodef-image-map-gallery qodef-grid-row<?php echo esc_attr( $holder_classes ); ?> " data-image-map-name='<?php echo esc_attr( $image_map_name ); ?>'>
	<div class="qodef-map-holder qodef-grid-col-6">
		<?php if ( ! empty( $video_link ) || ! empty( $video_link_360 ) ) { ?>
			<ul class="qodef-map-navigation">
				<li class="qodef-map-nav-item qodef-active-map active">
					<span class="qodef-map-nav-item-icon dripicons-photo"></span>
					<span class="qodef-map-nav-item-text"><?php echo esc_html__( 'Photos', 'sagen-core' ); ?></span>
				</li>
				<?php if ( ! empty( $video_link ) ) { ?>
					<li class="qodef-map-nav-item qodef-inactive-map">
						<span class="qodef-map-nav-item-icon dripicons-camcorder"></span>
						<span class="qodef-map-nav-item-text"><?php echo esc_html__( 'Video', 'sagen-core' ); ?></span>
					</li>
				<?php } ?>
				<?php if ( ! empty( $video_link_360 ) ) { ?>
					<li class="qodef-map-nav-item qodef-inactive-map">
						<span class="qodef-map-nav-item-icon dripicons-clockwise"></span>
						<span class="qodef-map-nav-item-text"><?php echo esc_html__( '360 Video', 'sagen-core' ); ?></span>
					</li>
				<?php } ?>
			</ul>
		<?php } ?>
		<div class="qodef-image-map-holder">
			<?php echo do_shortcode( $image_map_shortcode ); ?>
			<div class="qodef-image-map-holder-overlay"></div>
		</div>
	</div>
	<div class="qodef-img-holder qodef-grid-col-6">
		<div class="qodef-img-section qodef-img-holder-inner active">
			<div class="qodef-img-slider" <?php echo sagen_select_get_inline_attrs( $slider_data ); ?>>
				<?php foreach ( $images as $image ) { ?>
					<div class="qodef-ig-image" data-imp-shape="<?php echo esc_attr( $image['image_shape'] ); ?>">
						<?php
						if ( is_array( $image_size ) && count( $image_size ) ) :
							echo sagen_select_generate_thumbnail( $image['image_id'], null, $image_size[0], $image_size[1] );
						else :
							echo wp_get_attachment_image( $image['image_id'], $image_size );
						endif;
						?>
					</div>
				<?php } ?>
			</div>
			<ul id="qodef-imp-pagination" class="qodef-pagination-slider clearfix">
				<?php foreach ( $images as $image ) { ?>
					<li class="qodef-impp-item"><?php echo wp_get_attachment_image( $image['image_id'], 'full' ); ?></li>
				<?php } ?>
			</ul>
		</div>
		<?php if ( ! empty( $video_link ) ) { ?>
			<div class="qodef-img-section qodef-img-video-inner">
				<?php
				echo sagen_select_execute_shortcode(
					'qodef_video_button',
					array(
						'video_link'  => $video_link,
						'video_image' => $video_image,
					)
				)
				?>
			</div>
		<?php } ?>
		<?php if ( ! empty( $video_link_360 ) ) { ?>
			<div class="qodef-img-section qodef-img-360-video-inner">
				<?php
				echo sagen_select_execute_shortcode(
					'qodef_video_button',
					array(
						'video_link'  => $video_link_360,
						'video_image' => $video_image_360,
					)
				)
				?>
			</div>
		<?php } ?>
	</div>
</div>
