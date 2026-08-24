<?php

if ( class_exists( 'SagenCoreClassWidget' ) ) {
	class SagenSelectClassSideAreaOpener extends SagenCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_side_area_opener',
				esc_html__( 'Sagen Side Area Opener', 'sagen' ),
				array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'sagen' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(
				array(
					'type'        => 'colorpicker',
					'name'        => 'icon_color',
					'title'       => esc_html__( 'Side Area Opener Color', 'sagen' ),
					'description' => esc_html__( 'Define color for side area opener', 'sagen' )
				),
				array(
					'type'        => 'colorpicker',
					'name'        => 'icon_hover_color',
					'title'       => esc_html__( 'Side Area Opener Hover Color', 'sagen' ),
					'description' => esc_html__( 'Define hover color for side area opener', 'sagen' )
				),
				array(
					'type'        => 'textfield',
					'name'        => 'widget_margin',
					'title'       => esc_html__( 'Side Area Opener Margin', 'sagen' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'sagen' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'widget_title',
					'title' => esc_html__( 'Side Area Opener Title', 'sagen' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$classes = array(
				'qodef-side-menu-button-opener',
				'qodef-icon-has-hover'
			);
			
			$classes[] = sagen_select_get_icon_sources_class( 'side_area', 'qodef-side-menu-button-opener' );
			
			$styles = array();
			if ( ! empty( $instance['icon_color'] ) ) {
				$styles[] = 'color: ' . $instance['icon_color'] . ';';
			}
			if ( ! empty( $instance['widget_margin'] ) ) {
				$styles[] = 'margin: ' . $instance['widget_margin'];
			}
			?>
			<a <?php sagen_select_class_attribute( $classes ); ?> <?php echo sagen_select_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ); ?> href="javascript:void(0)" <?php sagen_select_inline_style( $styles ); ?>>
				<?php if ( ! empty( $instance['widget_title'] ) ) { ?>
					<h5 class="qodef-side-menu-title"><?php echo esc_html( $instance['widget_title'] ); ?></h5>
				<?php } ?>
				<span class="qodef-side-menu-icon">
					<?php echo sagen_select_get_icon_sources_html( 'side_area' ); ?>
	            </span>
			</a>
		<?php }
	}
}