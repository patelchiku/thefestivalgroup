<?php
namespace SagenCore\CPT\Shortcodes\SocialShare;

use SagenCore\Lib;

class SocialShare implements Lib\ShortcodeInterface {
	private $base;
	private $socialNetworks;

	function __construct() {
		$this->base           = 'qodef_social_share';
		$this->socialNetworks = array(
			'facebook',
			'twitter',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk',
		);
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}

	public function getBase() {
		return $this->base;
	}

	public function getSocialNetworks() {
		return $this->socialNetworks;
	}

	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Social Share', 'sagen-core' ),
					'base'                      => $this->getBase(),
					'icon'                      => 'icon-wpb-social-share extended-custom-icon',
					'category'                  => esc_html__( 'by SAGEN', 'sagen-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'       => 'dropdown',
							'param_name' => 'type',
							'heading'    => esc_html__( 'Type', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'List', 'sagen-core' )     => 'list',
								esc_html__( 'Dropdown', 'sagen-core' ) => 'dropdown',
								esc_html__( 'Text', 'sagen-core' )     => 'text',
							),
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'dropdown_behavior',
							'heading'    => esc_html__( 'DropDown Hover Behavior', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'On Bottom Animation', 'sagen-core' ) => 'bottom',
								esc_html__( 'On Right Animation', 'sagen-core' )  => 'right',
								esc_html__( 'On Left Animation', 'sagen-core' )   => 'left',
							),
							'dependency' => array(
								'element' => 'type',
								'value'   => array( 'dropdown' ),
							),
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'icon_type',
							'heading'    => esc_html__( 'Icons Type', 'sagen-core' ),
							'value'      => array(
								esc_html__( 'Font Awesome', 'sagen-core' ) => 'font-awesome',
								esc_html__( 'Font Elegant', 'sagen-core' ) => 'font-elegant',
							),
							'dependency' => array(
								'element' => 'type',
								'value'   => array( 'list', 'dropdown' ),
							),
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Social Share Title', 'sagen-core' ),
						),
					),
				)
			);
		}
	}

	public function render( $atts, $content = null ) {
		$args   = array(
			'type'              => 'list',
			'dropdown_behavior' => 'bottom',
			'icon_type'         => 'font-elegant',
			'title'             => '',
		);
		$params = shortcode_atts( $args, $atts );

		//Is social share enabled
		$params['enable_social_share'] = sagen_select_options()->getOptionValue( 'enable_social_share' ) === 'yes';

		//Is social share enabled for post type
		$post_type         = str_replace( '-', '_', get_post_type() );
		$params['enabled'] = sagen_select_options()->getOptionValue( 'enable_social_share_on_' . $post_type ) === 'yes';

		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams( $params );

		$params['dropdown_class'] = ! empty( $params['dropdown_behavior'] ) ? 'qodef-' . $params['dropdown_behavior'] : 'qodef-' . $args['dropdown_behavior'];

		$html = '';

		if ( $params['enable_social_share'] && $params['enabled'] ) {
			$html = sagen_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'social-share', '', $params );
		}

		return $html;
	}

	/**
	 * Get Social Networks data to display
	 * @return array
	 */
	private function getSocialNetworksParams( $params ) {
		$networks   = array();
		$icons_type = $params['icon_type'];
		$type       = $params['type'];

		foreach ( $this->socialNetworks as $net ) {
			$html = '';

			if ( sagen_select_options()->getOptionValue( 'enable_' . $net . '_share' ) == 'yes' ) {
				$image  = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$params = array(
					'name' => $net,
					'type' => $type,
				);

				$params['link'] = $this->getSocialNetworkShareLink( $net, $image );

				if ( $type == 'text' ) {
					$params['text'] = $this->getSocialNetworkText( $net );
				} else {
					$params['icon'] = $this->getSocialNetworkIcon( $net, $icons_type );
				}

				$params['custom_icon'] = ( sagen_select_options()->getOptionValue( $net . '_icon' ) ) ? sagen_select_options()->getOptionValue( $net . '_icon' ) : '';

				$html = sagen_core_get_shortcode_module_template_part( 'templates/parts/network', 'social-share', '', $params );
			}

			$networks[ $net ] = $html;
		}

		return $networks;
	}

	/**
	 * Get share link for networks
	 *
	 * @param $net
	 * @param $image
	 * @return string
	 */
	private function getSocialNetworkShareLink( $net, $image ) {
		$image = ! empty( $image ) && isset( $image[0] ) ? $image : array( '' );

		switch ( $net ) {
			case 'facebook':
				if ( wp_is_mobile() ) {
					$link = 'window.open(\'https://m.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\');';
				} else {
					$link = 'window.open(\'https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '\', \'sharer\', \'toolbar=0,status=0,width=620,height=280\');';
				}
				break;
			case 'twitter':
				$count_char             = is_ssl() ? 23 : 22;
				$twitter_via_option_val = sagen_select_options()->getOptionValue( 'twitter_via' );
				$twitter_via            = '' !== $twitter_via_option_val ? esc_attr__( ' via ', 'sagen-core' ) . esc_attr( $twitter_via_option_val ) : '';
				$link                   = 'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( sagen_select_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
				break;
			case 'linkedin':
				$link = 'popUp=window.open(\'https://www.linkedin.com/sharing/share-offsite?url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'tumblr':
				$link = 'popUp=window.open(\'https://www.tumblr.com/share/link?url=' . urlencode( get_permalink() ) . '&amp;name=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'pinterest':
				$media = ( $image ) ? '&amp;media=' . urlencode( $image[0] ) : '';
				$link  = 'popUp=window.open(\'https://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . urlencode( get_the_title() ) . $media . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			case 'vk':
				$media = ( $image ) ? '&amp;image=' . urlencode( $image[0] ) : '';
				$link  = 'popUp=window.open(\'https://vkontakte.ru/share.php?url=' . urlencode( get_permalink() ) . '&amp;title=' . urlencode( get_the_title() ) . '&amp;description=' . urlencode( get_the_excerpt() ) . $media . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
				break;
			default:
				$link = '';
		}

		return apply_filters( 'sagen_select_filter_social_network_share_link', $link, $net, $image );
		}

	private function getSocialNetworkIcon( $net, $type ) {
		switch ( $net ) {
			case 'facebook':
				$icon = ( $type == 'font-elegant' ) ? 'social_facebook' : 'fab fa-facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'font-elegant' ) ? 'social_twitter' : 'fab fa-twitter';
				break;
			case 'linkedin':
				$icon = ( $type == 'font-elegant' ) ? 'social_linkedin' : 'fab fa-linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'font-elegant' ) ? 'social_tumblr' : 'fab fa-tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'font-elegant' ) ? 'social_pinterest' : 'fab fa-pinterest';
				break;
			case 'vk':
				$icon = 'fab fa-vk';
				break;
			default:
				$icon = '';
		}

		return $icon;
	}

	private function getSocialNetworkText( $net ) {
		switch ( $net ) {
			case 'facebook':
				$text = esc_html__( 'fb', 'sagen-core' );
				break;
			case 'twitter':
				$text = esc_html__( 'tw', 'sagen-core' );
				break;
			case 'linkedin':
				$text = esc_html__( 'in', 'sagen-core' );
				break;
			case 'tumblr':
				$text = esc_html__( 'tmb', 'sagen-core' );
				break;
			case 'pinterest':
				$text = esc_html__( 'pin', 'sagen-core' );
				break;
			case 'vk':
				$text = esc_html__( 'vk', 'sagen-core' );
				break;
			default:
				$text = '';
		}

		return $text;
	}
}
