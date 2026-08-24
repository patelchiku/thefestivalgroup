<?php

//define constants
define( 'SAGEN_SELECT_ROOT', get_template_directory_uri() );
define( 'SAGEN_SELECT_ROOT_DIR', get_template_directory() );
define( 'SAGEN_SELECT_ASSETS_ROOT', SAGEN_SELECT_ROOT . '/assets' );
define( 'SAGEN_SELECT_ASSETS_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/assets' );
define( 'SAGEN_SELECT_FRAMEWORK_ROOT', SAGEN_SELECT_ROOT . '/framework' );
define( 'SAGEN_SELECT_FRAMEWORK_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/framework' );
define( 'SAGEN_SELECT_FRAMEWORK_ADMIN_ASSETS_ROOT', SAGEN_SELECT_ROOT . '/framework/admin/assets' );
define( 'SAGEN_SELECT_FRAMEWORK_ICONS_ROOT', SAGEN_SELECT_ROOT . '/framework/lib/icons-pack' );
define( 'SAGEN_SELECT_FRAMEWORK_ICONS_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/framework/lib/icons-pack' );
define( 'SAGEN_SELECT_FRAMEWORK_MODULES_ROOT', SAGEN_SELECT_ROOT . '/framework/modules' );
define( 'SAGEN_SELECT_FRAMEWORK_MODULES_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/framework/modules' );
define( 'SAGEN_SELECT_FRAMEWORK_HEADER_ROOT', SAGEN_SELECT_ROOT . '/framework/modules/header' );
define( 'SAGEN_SELECT_FRAMEWORK_HEADER_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/framework/modules/header' );
define( 'SAGEN_SELECT_FRAMEWORK_HEADER_TYPES_ROOT', SAGEN_SELECT_ROOT . '/framework/modules/header/types' );
define( 'SAGEN_SELECT_FRAMEWORK_HEADER_TYPES_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/framework/modules/header/types' );
define( 'SAGEN_SELECT_FRAMEWORK_SEARCH_ROOT', SAGEN_SELECT_ROOT . '/framework/modules/search' );
define( 'SAGEN_SELECT_FRAMEWORK_SEARCH_ROOT_DIR', SAGEN_SELECT_ROOT_DIR . '/framework/modules/search' );
define( 'SAGEN_SELECT_THEME_ENV', 'false' );
define( 'SAGEN_SELECT_PROFILE_SLUG', 'select' );
define( 'SAGEN_SELECT_OPTIONS_SLUG', 'sagen_select_theme_menu');

//include necessary files
include_once SAGEN_SELECT_ROOT_DIR . '/framework/qodef-framework.php';
include_once SAGEN_SELECT_ROOT_DIR . '/includes/nav-menu/qodef-menu.php';
require_once SAGEN_SELECT_ROOT_DIR . '/includes/plugins/class-tgm-plugin-activation.php';
include_once SAGEN_SELECT_ROOT_DIR . '/includes/plugins/plugins-activation.php';
include_once SAGEN_SELECT_ROOT_DIR . '/assets/custom-styles/general-custom-styles.php';
include_once SAGEN_SELECT_ROOT_DIR . '/assets/custom-styles/general-custom-styles-responsive.php';

if ( file_exists( SAGEN_SELECT_ROOT_DIR . '/export' ) ) {
	include_once SAGEN_SELECT_ROOT_DIR . '/export/export.php';
}

if ( ! is_admin() ) {
	include_once SAGEN_SELECT_ROOT_DIR . '/includes/qodef-body-class-functions.php';
	include_once SAGEN_SELECT_ROOT_DIR . '/includes/qodef-loading-spinners.php';
}