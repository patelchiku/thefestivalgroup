<?php

namespace SagenCore\CPT\Property;

use SagenCore\Lib\PostTypeInterface;

/**
 * Class PropertyRegister
 * @package SagenCore\CPT\Property
 */
class PropertyRegister implements PostTypeInterface {
	private $base;
	private $taxBase;

	public function __construct() {
		$this->base    = 'property-item';
		$this->taxBase = 'property-category';

		add_filter( 'archive_template', array( $this, 'registerArchiveTemplate' ) );
		add_filter( 'single_template', array( $this, 'registerSingleTemplate' ) );
	}

	/**
	 * @return string
	 */
	public function getBase() {
		return $this->base;
	}

	/**
	 * Registers custom post type with WordPress
	 */
	public function register() {
		$this->registerPostType();
		$this->registerTax();
		$this->registerTagTax();
	}

	/**
	 * Registers property archive template if one does'nt exists in theme.
	 * Hooked to archive_template filter
	 *
	 * @param $archive string current template
	 *
	 * @return string string changed template
	 */
	public function registerArchiveTemplate( $archive ) {
		global $post;

		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/archive-' . $this->base . '.php' ) ) {
				return SAGEN_CORE_CPT_PATH . '/property/templates/archive-' . $this->base . '.php';
			}
		}

		return $archive;
	}

	/**
	 * Registers property single template if one does'nt exists in theme.
	 * Hooked to single_template filter
	 *
	 * @param $single string current template
	 *
	 * @return string string changed template
	 */
	public function registerSingleTemplate( $single ) {
		global $post;

		if ( ! empty( $post ) && $post->post_type == $this->base ) {
			if ( ! file_exists( get_template_directory() . '/single-property-item.php' ) ) {
				return SAGEN_CORE_CPT_PATH . '/property/templates/single-' . $this->base . '.php';
			}
		}

		return $single;
	}

	/**
	 * Registers custom post type with WordPress
	 */
	private function registerPostType() {
		$menuPosition = 5;
		$menuIcon     = 'dashicons-screenoptions';
		$slug         = $this->base;

		if ( sagen_core_theme_installed() ) {
			if ( sagen_select_options()->getOptionValue( 'property_single_slug' ) ) {
				$slug = sagen_select_options()->getOptionValue( 'property_single_slug' );
			}
		}

		register_post_type(
			$this->base,
			array(
				'labels'        => array(
					'name'          => esc_html__( 'Sagen Property', 'sagen-core' ),
					'singular_name' => esc_html__( 'Sagen Property Item', 'sagen-core' ),
					'add_item'      => esc_html__( 'New Property Item', 'sagen-core' ),
					'add_new_item'  => esc_html__( 'Add New Property Item', 'sagen-core' ),
					'edit_item'     => esc_html__( 'Edit Property Item', 'sagen-core' ),
				),
				'public'        => true,
				'has_archive'   => true,
				'rewrite'       => array( 'slug' => $slug ),
				'menu_position' => $menuPosition,
				'show_ui'       => true,
				'supports'      => array(
					'author',
					'title',
					'editor',
					'thumbnail',
					'excerpt',
					'page-attributes',
					'comments',
				),
				'menu_icon'     => $menuIcon,
			)
		);
	}

	/**
	 * Registers custom taxonomy with WordPress
	 */
	private function registerTax() {
		$labels = array(
			'name'              => esc_html__( 'Property Categories', 'sagen-core' ),
			'singular_name'     => esc_html__( 'Property Category', 'sagen-core' ),
			'search_items'      => esc_html__( 'Search Property Categories', 'sagen-core' ),
			'all_items'         => esc_html__( 'All Property Categories', 'sagen-core' ),
			'parent_item'       => esc_html__( 'Parent Property Category', 'sagen-core' ),
			'parent_item_colon' => esc_html__( 'Parent Property Category:', 'sagen-core' ),
			'edit_item'         => esc_html__( 'Edit Property Category', 'sagen-core' ),
			'update_item'       => esc_html__( 'Update Property Category', 'sagen-core' ),
			'add_new_item'      => esc_html__( 'Add New Property Category', 'sagen-core' ),
			'new_item_name'     => esc_html__( 'New Property Category Name', 'sagen-core' ),
			'menu_name'         => esc_html__( 'Property Categories', 'sagen-core' ),
		);

		register_taxonomy(
			$this->taxBase,
			array( $this->base ),
			array(
				'hierarchical'      => true,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => true,
				'show_admin_column' => true,
				'rewrite'           => array( 'slug' => 'property-category' ),
			)
		);
	}

	/**
	 * Registers custom tag taxonomy with WordPress
	 */
	private function registerTagTax() {
		$labels = array(
			'name'              => esc_html__( 'Property Tags', 'sagen-core' ),
			'singular_name'     => esc_html__( 'Property Tag', 'sagen-core' ),
			'search_items'      => esc_html__( 'Search Property Tags', 'sagen-core' ),
			'all_items'         => esc_html__( 'All Property Tags', 'sagen-core' ),
			'parent_item'       => esc_html__( 'Parent Property Tag', 'sagen-core' ),
			'parent_item_colon' => esc_html__( 'Parent Property Tags:', 'sagen-core' ),
			'edit_item'         => esc_html__( 'Edit Property Tag', 'sagen-core' ),
			'update_item'       => esc_html__( 'Update Property Tag', 'sagen-core' ),
			'add_new_item'      => esc_html__( 'Add New Property Tag', 'sagen-core' ),
			'new_item_name'     => esc_html__( 'New Property Tag Name', 'sagen-core' ),
			'menu_name'         => esc_html__( 'Property Tags', 'sagen-core' ),
		);

		register_taxonomy(
			'property-tag',
			array( $this->base ),
			array(
				'hierarchical'      => false,
				'labels'            => $labels,
				'show_ui'           => true,
				'query_var'         => true,
				'show_admin_column' => true,
				'rewrite'           => array( 'slug' => 'property-tag' ),
			)
		);
	}
}
