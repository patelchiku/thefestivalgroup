<?php if(comments_open()) { ?>
	<div class="qodef-post-info-comments-holder">
		<a itemprop="url" class="qodef-post-info-comments" href="<?php comments_link(); ?>">
			<?php comments_number('0 ' . esc_html__('Comments','sagen'), '1 '.esc_html__('Comment','sagen'), '% '.esc_html__('Comments','sagen') ); ?>
		</a>
	</div>
<?php } ?>