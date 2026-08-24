<?php
$title_tag    = isset( $title_tag ) ? $title_tag : 'h2';
$title_styles = isset( $this_object ) && isset( $params ) ? $this_object->getTitleStyles( $params ) : array();

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

<<?php echo sagen_select_escape_title_tag($title_tag);?> itemprop="name" class="entry-title qodef-post-title" <?php sagen_select_inline_style($title_styles); ?>>
    <?php if(sagen_select_blog_item_has_link()) { ?>
        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
    <?php } ?>
        <?php the_title(); ?>
    <?php if(sagen_select_blog_item_has_link()) { ?>
        </a>
    <?php } ?>
</<?php echo sagen_select_escape_title_tag($title_tag);?>>
<?php if (sagen_select_is_plugin_installed('core')) {
    echo do_shortcode("[qodef_separator $paramssep]");
} ?>