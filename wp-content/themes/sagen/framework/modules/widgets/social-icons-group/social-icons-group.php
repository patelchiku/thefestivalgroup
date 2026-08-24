<?php

if ( class_exists( 'SagenCoreClassWidget' ) ) {
	class SagenSelectClassClassIconsGroupWidget extends SagenCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_social_icons_group_widget',
				esc_html__( 'Sagen Social Icons Group Widget', 'sagen' ),
				array( 'description' => esc_html__( 'Use this widget to add a group of up to 6 social icons to a widget area.', 'sagen' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array_merge(
				array(
					array(
						'type'  => 'textfield',
						'name'  => 'widget_title',
						'title' => esc_html__( 'Widget Title', 'sagen' )
					)
				),
				sagen_select_icon_collections()->getSocialIconWidgetMultipleParamsArray( 6 ),
				array(
					array(
						'type'    => 'dropdown',
						'name'    => 'layout',
						'title'   => esc_html__( 'Icons Layout', 'sagen' ),
						'options' => array(
							''             => esc_html__( 'Default', 'sagen' ),
							'square-icons' => esc_html__( 'Square', 'sagen' ),
						)
					),
					array(
						'type'        => 'dropdown',
						'name'        => 'skin',
						'title'       => esc_html__( 'Square Icons Skin', 'sagen' ),
						'description' => esc_html__( 'This applies to the square layout', 'sagen' ),
						'options'     => array(
							''           => esc_html__( 'Dark Skin', 'sagen' ),
							'light-skin' => esc_html__( 'Light Skin', 'sagen' ),
						)
					),
					array(
						'type'    => 'dropdown',
						'name'    => 'alignment',
						'title'   => esc_html__( 'Text Alignment', 'sagen' ),
						'options' => array(
							'left'   => esc_html__( 'Left', 'sagen' ),
							'center' => esc_html__( 'Center', 'sagen' ),
							'right'  => esc_html__( 'Right', 'sagen' )
						)
					),
					array(
						'type'    => 'dropdown',
						'name'    => 'icon_name_show',
						'title'   => esc_html__( 'Show Icon Names', 'sagen' ),
						'description' => esc_html__( 'This only works for Font Awsome Icons', 'sagen' ),
						'options' => array(
							''             => esc_html__( 'No', 'sagen' ),
							'yes' => esc_html__( 'Yes', 'sagen' ),
						)
					),
					array(
						'type'  => 'textfield',
						'name'  => 'icon_size',
						'title' => esc_html__( 'Icons Size (px)', 'sagen' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'color',
						'title' => esc_html__( 'Color', 'sagen' )
					),
					array(
						'type'  => 'colorpicker',
						'name'  => 'hover_color',
						'title' => esc_html__( 'Hover Color', 'sagen' )
					),
					array(
						'type'        => 'textfield',
						'name'        => 'margin',
						'title'       => esc_html__( 'Margin', 'sagen' ),
						'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'sagen' )
					)
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$icon_styles = array();
			$class       = array();
			
			if ( ! empty( $instance['skin'] ) ) {
				$class[] = 'qodef-' . $instance['skin'];
			}
			
			if ( ! empty( $instance['layout'] ) ) {
				$class[] = 'qodef-' . $instance['layout'];
			}
			
			if ( ! empty( $instance['alignment'] ) ) {
				$class[] = 'text-align-' . $instance['alignment'];
			}
			
			if ( ! empty( $instance['color'] ) ) {
				$icon_styles[] = 'color: ' . $instance['color'] . ';';
			}
			
			if ( ! empty( $instance['icon_size'] ) ) {
				$icon_styles[] = 'font-size: ' . sagen_select_filter_px( $instance['icon_size'] ) . 'px';
			}
			
			if ( ! empty( $instance['margin'] ) ) {
				$icon_styles[] = 'margin: ' . $instance['margin'] . ';';
			}
			
			$hover_color = ! empty( $instance['hover_color'] ) ? $instance['hover_color'] : '';
			$class       = implode( ' ', $class );
			
			echo '<div class="widget qodef-social-icons-group-widget ' . esc_attr( $class ) . '">';
			
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			for ( $n = 1; $n <= 6; $n ++ ) {
				$link   = ! empty( $instance[ 'link_' . $n ] ) ? $instance[ 'link_' . $n ] : '#';
				$target = ! empty( $instance[ 'target_' . $n ] ) ? $instance[ 'target_' . $n ] : '_self';
				
				$icon_holder_html = '';
				if ( ! empty( $instance['icon_pack'] ) ) {
					$icon_class = array( 'qodef-social-icon-widget' );
					if ( ! empty( $instance[ 'fa_icon_' . $n ] ) && $instance['icon_pack'] === 'font_awesome' ) {
						$icon_class[] = $instance[ 'fa_icon_' . $n ];
					}
					
					if ( ! empty( $instance[ 'fe_icon_' . $n ] ) && $instance['icon_pack'] === 'font_elegant' ) {
						$icon_class[] = $instance[ 'fe_icon_' . $n ];
					}
					
					if ( ! empty( $instance[ 'ion_icon_' . $n ] ) && $instance['icon_pack'] === 'ion_icons' ) {
						$icon_class[] = $instance[ 'ion_icon_' . $n ];
					}
					
					if ( ! empty( $instance[ 'simple_line_icon_' . $n ] ) && $instance['icon_pack'] === 'simple_line_icons' ) {
						$icon_class[] = $instance[ 'simple_line_icon_' . $n ];
					}
					
					if ( ! empty( $icon_class ) && isset( $icon_class[1] ) && ! empty( $icon_class[1] ) ) {
						$icon_class       = implode( ' ', $icon_class );
						$icon_holder_html = '<span class="' . $icon_class . '"></span>';

						if ( ! empty( $instance[ 'fa_icon_' . $n ] ) && $instance['icon_pack'] === 'font_awesome' && ! empty( $instance[ 'icon_name_show'] )  ) {
							$icon_text_output = $instance[ 'fa_icon_' . $n ];

							// removes the fab and everything before the dash '-'
							$icon_text_output = substr($icon_text_output, strpos($icon_text_output, '-') + strlen('-'));

							//break the string up around the '-'
							$icon_text_output = explode('-', $icon_text_output);

							$icon_holder_html .= '<span class="qodef-social-icon-widget-name-holder">' . $icon_text_output[0] .  '</span>';
						}

					} else {
						$icon_holder_html = '';
					}
				}
				?>
				<?php if ( ! empty( $icon_holder_html ) ) { ?>
					<a class="qodef-social-icon-widget-holder qodef-icon-has-hover" <?php echo sagen_select_get_inline_attr( $hover_color, 'data-hover-color' ); ?> <?php sagen_select_inline_style( $icon_styles ) ?> href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
						<svg class="qodef-icon-svg-circle" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="197px" height="197px" viewBox="0 0 197 197" enable-background="new 0 0 197 197" xml:space="preserve">
							<circle class="qodef-icon-stroke " stroke-linecap="round" cx="98.5" cy="98.6" r="97.5"></circle>
						</svg>
					<?php echo wp_kses_post( $icon_holder_html ); ?>
					</a>
				<?php }
			}
			echo '</div>';
		}
	}
}