<?php
namespace SagenSelectNamespace\Modules\Header\Types;

use SagenSelectNamespace\Modules\Header\Lib\HeaderType;

/**
 * Class that represents Header Divided layout and option
 *
 * Class HeaderDivided
 */
class HeaderDivided extends HeaderType {
	protected $heightOfTransparency;
	protected $heightOfCompleteTransparency;
	protected $headerHeight;
	protected $menuAreaHeight;
	protected $mobileHeaderHeight;

	/**
	 * Sets slug property which is the same as value of option in DB
	 */
	public function __construct() {
		$this->slug = 'header-divided';

		if ( ! is_admin() ) {
			$this->menuAreaHeight     = sagen_select_set_default_menu_height_for_header_types();
			$this->mobileHeaderHeight = sagen_select_set_default_mobile_menu_height_for_header_types();

			add_action( 'wp', array( $this, 'setHeaderHeightProps' ) );

			add_filter( 'sagen_select_filter_js_global_variables', array( $this, 'getGlobalJSVariables' ) );
			add_filter( 'sagen_select_filter_per_page_js_vars', array( $this, 'getPerPageJSVariables' ) );
		}
	}

	/**
	 * Loads template file for this header type
	 *
	 * @param array $parameters associative array of variables that needs to passed to template
	 */
	public function loadTemplate( $parameters = array() ) {
		$id = sagen_select_get_page_id();

		$parameters['menu_area_in_grid'] = sagen_select_get_meta_field_intersect( 'menu_area_in_grid', $id ) == 'yes';

		$parameters = apply_filters( 'sagen_select_filter_header_divided_parameters', $parameters );

		sagen_select_get_module_template_part( 'templates/' . $this->slug, $this->moduleName . '/types/' . $this->slug, '', $parameters );
	}

	/**
	 * Sets header height properties after WP object is set up
	 */
	public function setHeaderHeightProps() {
		$this->heightOfTransparency         = $this->calculateHeightOfTransparency();
		$this->heightOfCompleteTransparency = $this->calculateHeightOfCompleteTransparency();
		$this->headerHeight                 = $this->calculateHeaderHeight();
		$this->mobileHeaderHeight           = $this->calculateMobileHeaderHeight();
	}

	/**
	 * Returns total height of transparent parts of header
	 *
	 * @return int
	 */
	public function calculateHeightOfTransparency() {
		$id                 = sagen_select_get_page_id();
		$transparencyHeight = 0;

		$menu_background_color             = sagen_select_get_meta_field_intersect( 'menu_area_background_color', $id );
		$menu_background_transparency      = sagen_select_get_meta_field_intersect( 'menu_area_background_transparency', $id );
		$menu_grid_background_color        = sagen_select_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = sagen_select_options()->getOptionValue( 'menu_area_grid_background_transparency' );

		if ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency !== '1' && $menu_grid_background_transparency !== '';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency !== '1' && $menu_background_transparency !== '';
		}

		$sliderExists        = get_post_meta( $id, 'qodef_page_slider_meta', true ) !== '';
		$contentBehindHeader = get_post_meta( $id, 'qodef_page_content_behind_header_meta', true ) === 'yes';

		if ( $sliderExists || $contentBehindHeader || is_404() ) {
			$menuAreaTransparent = true;
		}

		if ( $menuAreaTransparent ) {
			$transparencyHeight = $this->menuAreaHeight;

			if ( ( $sliderExists && sagen_select_is_top_bar_enabled() )
				 || sagen_select_is_top_bar_enabled() && sagen_select_is_top_bar_transparent()
			) {
				$transparencyHeight += sagen_select_get_top_bar_height();
			}
		}

		return $transparencyHeight;
	}

	/**
	 * Returns height of completely transparent header parts
	 *
	 * @return int
	 */
	public function calculateHeightOfCompleteTransparency() {
		$id                 = sagen_select_get_page_id();
		$transparencyHeight = 0;

		$menu_background_color_meta        = get_post_meta( $id, 'qodef_menu_area_background_color_meta', true );
		$menu_background_transparency_meta = get_post_meta( $id, 'qodef_menu_area_background_transparency_meta', true );
		$menu_background_color             = sagen_select_options()->getOptionValue( 'menu_area_background_color' );
		$menu_background_transparency      = sagen_select_options()->getOptionValue( 'menu_area_background_transparency' );
		$menu_grid_background_color        = sagen_select_options()->getOptionValue( 'menu_area_grid_background_color' );
		$menu_grid_background_transparency = sagen_select_options()->getOptionValue( 'menu_area_grid_background_transparency' );

		if ( ! empty( $menu_background_color_meta ) ) {
			$menuAreaTransparent = ! empty( $menu_background_color_meta ) && $menu_background_transparency_meta === '0';
		} elseif ( empty( $menu_background_color ) ) {
			$menuAreaTransparent = ! empty( $menu_grid_background_color ) && $menu_grid_background_transparency === '0';
		} else {
			$menuAreaTransparent = ! empty( $menu_background_color ) && $menu_background_transparency === '0';
		}

		if ( $menuAreaTransparent ) {
			$transparencyHeight = $this->menuAreaHeight;
		}

		return $transparencyHeight;
	}


	/**
	 * Returns total height of header
	 *
	 * @return int|string
	 */
	public function calculateHeaderHeight() {
		$headerHeight = $this->menuAreaHeight;
		if ( sagen_select_is_top_bar_enabled() ) {
			$headerHeight += sagen_select_get_top_bar_height();
		}

		return $headerHeight;
	}

	/**
	 * Returns total height of mobile header
	 *
	 * @return int|string
	 */
	public function calculateMobileHeaderHeight() {
		$mobileHeaderHeight = $this->mobileHeaderHeight;

		return $mobileHeaderHeight;
	}

	/**
	 * Returns global js variables of header
	 *
	 * @param $globalVariables
	 *
	 * @return int|string
	 */
	public function getGlobalJSVariables( $globalVariables ) {
		$globalVariables['qodefLogoAreaHeight']     = 0;
		$globalVariables['qodefMenuAreaHeight']     = $this->headerHeight;
		$globalVariables['qodefMobileHeaderHeight'] = $this->mobileHeaderHeight;

		return $globalVariables;
	}

	/**
	 * Returns per page js variables of header
	 *
	 * @param $perPageVars
	 *
	 * @return int|string
	 */
	public function getPerPageJSVariables( $perPageVars ) {
		//calculate transparency height only if header has no sticky behaviour
		$header_behavior = sagen_select_get_meta_field_intersect( 'header_behaviour' );
		if ( ! in_array( $header_behavior, array( 'sticky-header-on-scroll-up', 'sticky-header-on-scroll-down-up' ) ) ) {
			$perPageVars['qodefHeaderTransparencyHeight'] = $this->headerHeight - ( sagen_select_get_top_bar_height() + $this->heightOfCompleteTransparency );
		} else {
			$perPageVars['qodefHeaderTransparencyHeight'] = 0;
		}
		$perPageVars['qodefHeaderVerticalWidth'] = 0;

		return $perPageVars;
	}
}
