<?php

include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/enquirearea/functions.php';

//load global enquire area options
include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/enquirearea/admin/options-map/enquirearea-map.php';

//load global enquire area custom styles
include_once SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/enquirearea/admin/custom-styles/enquirearea-custom-styles.php';

//load widgets
foreach ( glob( SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR . '/enquirearea/widgets/*/load.php' ) as $widget_load ) {
    include_once $widget_load;
}