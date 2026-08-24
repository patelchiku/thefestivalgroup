<?php

//if accessed directly exit
if(!defined('ABSPATH')) exit;

class SelectSkin extends SagenSelectClassSkinAbstract {
	
	/**
	 * Skin constructor. Hooks to sagen_select_admin_scripts_init and sagen_select_enqueue_admin_styles
	 */
	public function __construct() {
		$this->skinName = 'select';
		
		// Admin register scripts and styles
		add_action( 'sagen_select_action_admin_scripts_init', array( $this, 'registerStyles' ) );
		add_action( 'sagen_select_action_admin_scripts_init', array( $this, 'registerScripts' ) );
		
		// Admin enqueue scripts and styles
		add_action( 'sagen_select_action_enqueue_admin_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'sagen_select_action_enqueue_admin_scripts', array( $this, 'enqueueScripts' ) );
		
		// Admin enqueue meta box scripts and styles
		add_action( 'sagen_select_action_enqueue_meta_box_styles', array( $this, 'enqueueStyles' ) );
		add_action( 'sagen_select_action_enqueue_meta_box_scripts', array( $this, 'enqueueScripts' ) );
		
		// Change options map order for this skin
		add_filter( 'sagen_select_filter_options_map_position', array( $this, 'setOptionsMapPosition' ), 10, 2 );
		
		add_action( 'admin_enqueue_scripts', array( $this, 'setShortcodeJSParams' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

    /**
     * Method that registers skin scripts
     */
	public function registerScripts() {
		
		$this->scripts['qodef-ui-admin-skin'] = array(
			'path'       => 'assets/js/qodef-ui.js',
			'dependency' => array()
		);
		
		foreach ( $this->scripts as $scriptHandle => $script ) {
			sagen_select_register_skin_script( $scriptHandle, $script['path'], $script['dependency'] );
		}
	}

    /**
     * Method that registers skin styles
     */
    public function registerStyles() {
        $this->styles['qodef-bootstrap'] = 'assets/css/qodef-bootstrap.css';
        $this->styles['qodef-page-admin'] = 'assets/css/qodef-page.css';
        $this->styles['qodef-options-admin'] = 'assets/css/qodef-options.css';
        $this->styles['qodef-meta-boxes-admin'] = 'assets/css/qodef-meta-boxes.css';
        $this->styles['qodef-ui-admin'] = 'assets/css/qodef-ui/qodef-ui.css';
        $this->styles['qodef-forms-admin'] = 'assets/css/qodef-forms.css';
        $this->styles['qodef-import'] = 'assets/css/qodef-import.css';

        foreach ($this->styles as $styleHandle => $stylePath) {
            sagen_select_register_skin_style($styleHandle, $stylePath);
        }
    }
    /**
     * Method that renders options page
     *
     * @see SelectSkin::getHeader()
     * @see SelectSkin::getPageNav()
     * @see SelectSkin::getPageContent()
     */
	public function renderOptions() {
        global $sagen_select_global_Framework;
        $tab    = sagen_select_get_admin_tab();
        $active_page = $sagen_select_global_Framework->qodeOptions->getAdminPageFromSlug($tab);
        if ($active_page == null) return;
    ?>
        <div class="qodef-options-page qodef-page">
            <?php $this->getHeader(); ?>
            <div class="qodef-page-content-wrapper">
                <div class="qodef-page-content">
                    <div class="qodef-page-navigation qodef-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav($tab); ?>
                        <?php $this->getPageContent($active_page); ?>
                    </div>
                </div>
            </div>
        </div>
	<?php }

    /**
     * Method that renders header of options page.
     * @param bool $show_save_btn whether to show save button. Should be hidden on import page
     *
     * @see SagenSelectClassSkinAbstract::loadTemplatePart()
     */
    public function getHeader($show_save_btn = true) {
        $this->loadTemplatePart('header', array('show_save_btn' => $show_save_btn));
    }

    /**
     * Method that loads page navigation
     * @param string $tab current tab
     * @param bool $is_import_page if is import page highlighted that tab
     *
     * @see SagenSelectClassSkinAbstract::loadTemplatePart()
     */
	public function getPageNav($tab, $is_import_page = false, $is_backup_options_page = false) {
		$this->loadTemplatePart('navigation', array(
			'tab' => $tab,
			'is_import_page' => $is_import_page,
			'is_backup_options_page' => $is_backup_options_page
		));
	}

    /**
     * Method that loads current page content
     *
	 * @param SagenSelectClassAdminPage $page current page to load
     *
     * @see SagenSelectClassSkinAbstract::loadTemplatePart()
     */
    public function getPageContent($page) {
        $this->loadTemplatePart('content', array('page' => $page));
    }

    /**
     * Method that loads content for import page
     */
    public function getImportContent() {
        $this->loadTemplatePart('content-import');
    }

    /**
     * Method that loads content for backup page
     */
    public function getBackupOptionsContent() {
        $this->loadTemplatePart('backup-options');
    }

    /**
     * Method that loads anchors and save button template part
     *
	 * @param SagenSelectClassAdminPage $page current page to load
     *
     * @see SagenSelectClassSkinAbstract::loadTemplatePart()
     */
    public function getAchorsAndSave($page) {
        $this->loadTemplatePart('anchors-save', array('page' => $page));
    }

    /**
     * Method that renders import page
     *
     * @see SelectSkin::getHeader()
     * * @see SelectSkin::getPageNav()
     * * @see SelectSkin::getImportContent()
     */
    public function renderImport() { ?>
        <div class="qodef-options-page qodef-page">
            <?php $this->getHeader(false); ?>
            <div class="qodef-page-content-wrapper">
                <div class="qodef-page-content">
                    <div class="qodef-page-navigation qodef-tabs-wrapper vertical left clearfix">
                        <?php $this->getPageNav('tabimport', true); ?>
                        <?php $this->getImportContent(); ?>
                    </div>
                </div>
            </div>
        </div>
    <?php }

	/**
	 * Method that renders backup options page
	 *
	 * @see SelectSkin::getHeader()
	 * * @see SelectSkin::getPageNav()
	 * * @see SelectSkin::getImportContent()
	 */
	public function renderBackupOptions() { ?>
		<div class="qodef-options-page qodef-page">
			<?php $this->getHeader('',false); ?>
			<div class="qodef-page-content-wrapper">
				<div class="qodef-page-content">
					<div class="qodef-page-navigation qodef-tabs-wrapper vertical left clearfix">
						<?php $this->getPageNav('backup_options', false, true); ?>
						<?php $this->getBackupOptionsContent(); ?>
					</div>
				</div>
			</div>
		</div>
	<?php }
	
	function setOptionsMapPosition( $position, $map ) {
		
		switch ( $map ) {
			case 'header':
				$position = 3;
				break;
			case 'mobile-header':
				$position = 4;
				break;
			case 'footer':
				$position = 5;
				break;
			case 'fonts':
				$position = 7;
				break;
			case 'page':
				$position = 8;
				break;
			case 'sidebar':
				$position = 9;
				break;
			case 'search':
				$position = 12;
				break;
			case 'sidearea':
				$position = 13;
				break;
		}
		
		return $position;
	}
}
?>