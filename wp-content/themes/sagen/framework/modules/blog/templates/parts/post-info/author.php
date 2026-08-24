<div class="qodef-post-info-author">
	<?php echo get_avatar( get_the_author_meta( 'ID' ), 32 ); ?>
	<a itemprop="author" class="qodef-post-info-author-link" href="<?php echo esc_url(get_author_posts_url( get_the_author_meta( 'ID' ) )); ?>">


        <?php
        if  ( get_the_author_meta('first_name') && get_the_author_meta('last_name' ) ) {
            the_author_meta('first_name');
            echo ' ';
            the_author_meta('last_name');
        } else {
            the_author_meta('nickname');
        }
        ?>
	</a>
</div>