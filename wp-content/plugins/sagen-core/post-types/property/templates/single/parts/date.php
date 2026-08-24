<?php if(sagen_select_options()->getOptionValue('property_single_hide_date') === 'yes') : ?>
    <div class="qodef-ps-info-item qodef-ps-date">
        <h4 class="qodef-ps-info-title"><?php esc_html_e('Date:', 'sagen-core'); ?></h4>
        <p itemprop="dateCreated" class="qodef-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(sagen_select_get_page_id()); ?>"/>
    </div>
<?php endif; ?>