<?php
$rand = rand(0, 1000);
$link_class = !empty($play_button_hover_image) ? 'qodef-vb-has-hover-image' : '';
?>
<div class="qodef-video-button-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-video-button-image">
		<?php echo wp_get_attachment_image($video_image, 'full'); ?>
	</div>
	<?php if(!empty($play_button_image)) { ?>
		<a class="qodef-video-button-play-image <?php echo esc_attr($link_class); ?>" href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="qodef-video-button-play-inner">
				<?php echo wp_get_attachment_image($play_button_image, 'full'); ?>
				<?php if(!empty($play_button_hover_image)) { ?>
					<?php echo wp_get_attachment_image($play_button_hover_image, 'full'); ?>
				<?php } ?>
			</span>
		</a>
	<?php } else { ?>
		<a class="qodef-video-button-play" <?php echo sagen_select_get_inline_style($play_button_styles); ?> href="<?php echo esc_url($video_link); ?>" data-rel="prettyPhoto[video_button_pretty_photo_<?php echo esc_attr($rand); ?>]">
			<span class="qodef-video-button-play-inner">
				<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="197px" height="197px"
					 viewBox="0 0 197 197" enable-background="new 0 0 197 197" xml:space="preserve">
					<circle class="video-button-stroke" stroke-linecap="round" cx="98.5" cy="98.6" r="80"></circle>
					<circle class="video-button-circle" stroke-linecap="round" cx="98.5" cy="98.6" r="80"></circle>
					<g><path fill="#FFFFFF" d="M88.5,78.6l20,20l-20,20V78.6z"></path></g>
				</svg>
			</span>
		</a>
	<?php } ?>
</div>