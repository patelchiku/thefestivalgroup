<?php
$post_classes[] = 'qodef-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="qodef-post-content">
        <div class="qodef-post-text">
            <div class="qodef-post-text-inner">

                <div class="qodef-post-text-main">
                    <?php sagen_select_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>

				<div class="qodef-post-mark">
					<span class="qodef-quote-mark">“</span>
				</div>
            </div>
        </div>
    </div>
</article>