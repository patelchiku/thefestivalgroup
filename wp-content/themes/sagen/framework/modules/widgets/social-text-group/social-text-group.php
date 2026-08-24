<?php

if ( class_exists( 'SagenCoreClassWidget' ) ) {
	class SagenSelectClassClassTextGroupWidget extends SagenCoreClassWidget {
		public function __construct() {
			parent::__construct(
				'qodef_social_text_group_widget',
				esc_html__( 'Sagen Social Text Group Widget', 'sagen' ),
				array( 'description' => esc_html__( 'Use this widget to add a group of up to 6 Social Text to a widget area.', 'sagen' ) )
			);
			
			$this->setParams();
		}


		
		protected function setParams() {
			$widget_text_social_array = array();

			for ( $x = 1; $x <= 6; $x ++ ) {

				$widget_text_social_array[] = array(
					'type'       => 'textfield',
					'title'    => esc_html__( 'Social Text ', 'sagen' ) . $x,
					'name' => 'text_' . $x,
					'save_always' => true
				);


				$widget_text_social_array[] = array(
					'type'       => 'textfield',
					'title'    => esc_html__( 'Social Text ', 'sagen' ) . $x . esc_html__( ' Link', 'sagen' ),
					'name' => 'link_' . $x,
					'save_always' => true
				);

				$widget_text_social_array[] = array(
					'type'       => 'dropdown',
					'title'    => esc_html__( 'Social Text ', 'sagen' ) . $x . esc_html__( ' Target', 'sagen' ),
					'name' => 'target_' . $x,
					'options'      => array(
						'_self' => esc_html__( 'Same Window', 'sagen' ),
						'_blank' => esc_html__( 'New Window', 'sagen' )
					),
					'save_always' => true
				);
			}

			$this->params = array_merge(
				array(
					array(
						'type'  => 'textfield',
						'name'  => 'widget_title',
						'title' => esc_html__( 'Widget Title', 'sagen' )
					)
				),
				$widget_text_social_array
			);
		}
		
		public function widget( $args, $instance ) {
			$class       = array();

			$class       = implode( ' ', $class );
			
			echo '<div class="widget qodef-social-texts-group-widget ' . esc_attr( $class ) . '">';
			
			if ( ! empty( $instance['widget_title'] ) ) {
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			
			for ( $n = 1; $n <= 6; $n ++ ) {
				$link   = ! empty( $instance[ 'link_' . $n ] ) ? $instance[ 'link_' . $n ] : '#';
				$target = ! empty( $instance[ 'target_' . $n ] ) ? $instance[ 'target_' . $n ] : '_self';
				$text   = ! empty( $instance[ 'text_' . $n ] ) ? $instance[ 'text_' . $n ] : '';

				if ( ! empty( $text ) ) { ?>
					<a class="qodef-social-text-widget-holder" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
						<?php echo esc_attr ( $text ); ?>
					</a>
				<?php }
			}
			echo '</div>';
		}
	}
}