<li class="qodef-bl-item qodef-item-space">
	<div class="qodef-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			sagen_select_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="qodef-bli-content">
            <?php if ($post_info_section == 'yes') { ?>
                <div class="qodef-bli-info">
	                <?php
		                if ( $post_info_date == 'yes' ) {
			                sagen_select_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_category == 'yes' ) {
			                sagen_select_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
		                }
		                if ( $post_info_author == 'yes' ) {
			                sagen_select_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                sagen_select_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                sagen_select_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                sagen_select_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <?php sagen_select_get_module_template_part( 'templates/parts/title', 'blog', '', $params ); ?>
	
	        <div class="qodef-bli-excerpt">
		        <?php sagen_select_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>

				<?php if ( $type == 'masonry' || $type == 'standard' ) {
					sagen_select_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params );
				} ?>
	        </div>
        </div>
	</div>
</li>