<?php

if($display_title === 'yes') { ?>
    <<?php echo sagen_select_escape_title_tag($title_tag); ?> itemprop="name" class="entry-title qodef-<?php echo esc_attr($class_name); ?>-title" <?php echo sagen_select_get_inline_style($title_styles); ?>>
		<a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</<?php echo sagen_select_escape_title_tag($title_tag); ?>>
<?php } ?>