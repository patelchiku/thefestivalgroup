<?php

include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/search/functions.php';

//load global search options
include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/search/admin/options-map/search-map.php';

//load global search custom styles
include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/search/admin/custom-styles/search-custom-styles.php';

//load widgets
foreach ( glob( SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/search/widgets/*/load.php' ) as $widget_load ) {
    include_once $widget_load;
}