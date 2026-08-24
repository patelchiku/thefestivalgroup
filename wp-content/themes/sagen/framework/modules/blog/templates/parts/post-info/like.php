<?php if( sagen_select_is_plugin_installed( 'core' ) ) { ?>
    <div class="qodef-blog-like">
        <?php if( function_exists('sagen_select_get_like') ) sagen_select_get_like(); ?>
    </div>
<?php } ?>