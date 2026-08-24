<?php
$show_related = sagen_select_options()->getOptionValue('blog_single_related_posts') == 'yes';
$related_post_number = sagen_select_sidebar_layout() === 'no-sidebar' ? 4 : 3;

$related_posts_options = array(
    'posts_per_page' => $related_post_number
);
$related_posts = sagen_select_get_blog_related_post_type(get_the_ID(), $related_posts_options);
$related_posts_image_size = isset($related_posts_image_size) ? $related_posts_image_size : 'full';
$sep_params = array(

	'position' => 'left',
	'width' => '40',
	'thickness' => '1',
);

$paramssep = '';

if ( is_array( $sep_params ) && count( $sep_params ) ) {
	foreach ( $sep_params as $key => $value ) {
		$paramssep .= " $key='$value' ";
	}
}
?>

<?php if($show_related) { ?>
    <div class="qodef-related-posts-holder clearfix">
        <?php if ( $related_posts && $related_posts->have_posts() ) : ?>
            <h4 class="qodef-related-posts-title"><?php esc_html_e('Related Posts', 'sagen' ); ?></h4>
            <div class="qodef-related-posts-inner clearfix">
                <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                <?php
                    $image_meta          = get_post_meta( get_the_ID(), 'qodef_blog_list_featured_image_meta', true );
                    $blog_list_image_id  = ! empty( $image_meta ) && sagen_select_blog_item_has_link() ? sagen_select_get_attachment_id_from_url( $image_meta ) : '';
                ?>
                    <div class="qodef-related-post">
                        <div class="qodef-related-post-inner">
		                    <?php if (has_post_thumbnail()) { ?>
                            <div class="qodef-related-post-image">
                                <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                    <?php //the_post_thumbnail($related_posts_image_size); ?>

                                    <?php if ( ! empty( $blog_list_image_id ) ) {
                                    echo wp_get_attachment_image( $blog_list_image_id, 'full' );
                                    } else {
                                    the_post_thumbnail( 'full' );
                                    }?>
                                </a>
                            </div>
		                    <?php }	?>
							<div class="qodef-post-info">
								<?php sagen_select_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
								<?php sagen_select_get_module_template_part('templates/parts/post-info/category', 'blog', '', $params); ?>
							</div>
                            <h4 itemprop="name" class="entry-title qodef-post-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                            <?php if (sagen_select_is_plugin_installed('core')) {
                                echo do_shortcode("[qodef_separator $paramssep]");
                            } ?>
							<?php sagen_select_get_module_template_part('templates/parts/excerpt', 'blog', '', $params); ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif;
        wp_reset_postdata();
        ?>
    </div>
<?php } ?>