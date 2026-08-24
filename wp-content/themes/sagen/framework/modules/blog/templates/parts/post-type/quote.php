<?php
$title_tag = isset($quote_tag) ? $quote_tag : 'h5';
$quote_text_meta = get_post_meta(get_the_ID(), "qodef_post_quote_text_meta", true );

$post_title = !empty($quote_text_meta) ? $quote_text_meta : get_the_title();

$post_author = get_post_meta(get_the_ID(), "qodef_post_quote_author_meta", true );
$post_author_position = get_post_meta(get_the_ID(), "qodef_post_quote_author_position__meta", true );
?>

<div class="qodef-post-quote-holder">
    <div class="qodef-post-quote-holder-inner">
        <<?php echo sagen_select_escape_title_tag($title_tag);?> itemprop="name" class="qodef-quote-title qodef-post-title">
        <?php if(sagen_select_blog_item_has_link()) { ?>
            <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php } ?>
            <?php echo esc_html($post_title); ?>
        <?php if(sagen_select_blog_item_has_link()) { ?>
            </a>
        <?php } ?>
        </<?php echo sagen_select_escape_title_tag($title_tag);?>>
        <?php if($post_author != '') { ?>
            <span class="qodef-quote-author">
                <?php echo esc_html($post_author); ?>
            </span>
        <?php } ?>
	<?php if($post_author_position != '') { ?>
		<span class="qodef-quote-author-position">
                <?php echo esc_html($post_author_position); ?>
            </span>
	<?php } ?>
    </div>
</div>