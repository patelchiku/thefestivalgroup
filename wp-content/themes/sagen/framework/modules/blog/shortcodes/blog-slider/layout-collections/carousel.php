<li class="qodef-blog-slider-item">
	<div class="qodef-blog-slider-item-inner">
		<div class="qodef-item-image">
			<a itemprop="url" href="<?php echo get_permalink(); ?>">
				<?php echo get_the_post_thumbnail(get_the_ID(), $image_size); ?>
			</a>
		</div>
		<div class="qodef-bli-content">
			<?php sagen_select_get_module_template_part('templates/parts/title', 'blog', '', $params); ?>
			
			<div class="qodef-bli-excerpt">
				<?php sagen_select_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
				<?php sagen_select_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
			</div>
		</div>
	</div>
</li>