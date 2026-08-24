<?php if(sagen_select_options()->getOptionValue('enable_social_share') == 'yes' && sagen_select_options()->getOptionValue('enable_social_share_on_property-item') == 'yes') : ?>
    <div class="qodef-ps-info-item qodef-ps-social-share">
        <?php echo sagen_select_get_social_share_html() ?>
    </div>
<?php endif; ?>