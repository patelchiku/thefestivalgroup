<?php

if ( class_exists( 'SagenCoreClassWidget' ) ) {
	class SagenSelectClassEnquireAreaOpener extends SagenCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_enquire_area_opener',
				esc_html__( 'Sagen Enquire Area Opener', 'sagen' ),
				array( 'description' => esc_html__( 'Display a button that opens the enquire area', 'sagen' ) )
			);
			
			$this->setParams();
		}
		
		protected function setParams() {
			$this->params = array(

				array(
					'type'        => 'textfield',
					'name'        => 'widget_margin',
					'title'       => esc_html__( 'Enquire Area Opener Margin', 'sagen' ),
					'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'sagen' )
				),
				array(
					'type'  => 'textfield',
					'name'  => 'widget_title',
					'title' => esc_html__( 'Enquire Area Opener Title', 'sagen' )
				)
			);
		}
		
		public function widget( $args, $instance ) {
			$classes = array(
				'qodef-enquire-menu-button-opener',
				'qodef-icon-has-hover'
			);
			
			$classes[] = sagen_select_get_icon_sources_class( 'enquire_area', 'qodef-enquire-menu-button-opener' );
			
			$styles = array();
			if ( ! empty( $instance['widget_margin'] ) ) {
				$styles[] = 'margin: ' . $instance['widget_margin'];
			}
			?>
			<a <?php sagen_select_class_attribute( $classes ); ?> href="javascript:void(0)" <?php sagen_select_inline_style( $styles ); ?>>
				<?php if ( ! empty( $instance['widget_title'] ) ) { ?>
					<h5 class="qodef-enquire-menu-title"><?php echo esc_html( $instance['widget_title'] ); ?></h5>
				<?php } ?>
				<span class="qodef-enquire-menu-text">
					<?php esc_html_e( 'MAKE AN ENQUIRY', 'sagen' ); ?>
	            </span>
			</a>
		<?php }
	}
}