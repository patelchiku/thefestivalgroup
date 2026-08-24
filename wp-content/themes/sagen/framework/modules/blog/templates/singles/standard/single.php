<?php

sagen_select_get_single_post_format_html( $blog_single_type );

do_action( 'sagen_select_action_after_article_content' );

sagen_select_get_module_template_part( 'templates/parts/single/author-info', 'blog' );

sagen_select_get_module_template_part( 'templates/parts/single/single-navigation', 'blog' );

sagen_select_get_module_template_part( 'templates/parts/single/related-posts', 'blog', '', $single_info_params );

sagen_select_get_module_template_part( 'templates/parts/single/comments', 'blog' );