<?php get_header(); ?>
				<div class="qodef-page-not-found">
					<?php
					$qodef_title_image_404 = sagen_select_options()->getOptionValue( '404_page_title_image' );
					$qodef_title_404       = sagen_select_options()->getOptionValue( '404_title' );
					$qodef_text_404        = sagen_select_options()->getOptionValue( '404_text' );
					$qodef_button_label    = sagen_select_options()->getOptionValue( '404_back_to_home' );
					$qodef_button_style    = sagen_select_options()->getOptionValue( '404_button_style' );
					
					if ( ! empty( $qodef_title_image_404 ) ) { ?>
						<div class="qodef-404-title-image">
							<img src="<?php echo esc_url( $qodef_title_image_404 ); ?>" alt="<?php esc_attr_e( '404 Title Image', 'sagen' ); ?>" />
						</div>
					<?php } ?>
					
					<h1 class="qodef-404-title">
						<?php if ( ! empty( $qodef_title_404 ) ) {
							echo esc_html( $qodef_title_404 );
						} else {
							esc_html_e( 'Error Page', 'sagen' );
						} ?>
					</h1>
					
					<p class="qodef-404-text">
						<?php if ( ! empty( $qodef_text_404 ) ) {
							echo esc_html( $qodef_text_404 );
						} else {
							esc_html_e( 'Looks like something went completly wrong! Don’t worry, it can happen to the best of us.', 'sagen' );
						} ?>
					</p>

					<?php
						if ( sagen_select_is_plugin_installed('core')) {

							echo sagen_select_execute_shortcode('qodef_button', array(
								'type' => 'outline',
								'link' => esc_url(home_url('/')),
								'text' => !empty($qodef_button_label) ? $qodef_button_label : esc_html__('Back to Home', 'sagen'),
								'icon_pack' => 'font_elegant',
								'fe_icon' => 'arrow_left'
							));

						} else {

							$button_params = array(
								'type' => 'outline',
								'link' => esc_url(home_url('/')),
								'text' => !empty($qodef_button_label) ? $qodef_button_label : esc_html__('Back to Home', 'sagen'),
							);

							if ($qodef_button_style == 'light-style') {
								$button_params['custom_class'] = 'qodef-btn-light-style';
							}

							echo sagen_select_return_button_html($button_params);

						}
					?>
					<div class="qodef-row-background-custom-holder"><div class="qodef-row-background-text-wrapper qodef-row-background-text-align-right">
							<div class="qodef-row-background-text-wrapper-inner" style="text-align:center;vertical-align:bottom;">
								<div class="qodef-row-background-text-1">404</div>
							</div>
						</div>
					</div>
					<div class="qodef-row-background-corner-holder bottom-right" style="height: 80%;"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php

do_action( 'sagen_select_action_before_closing_body_tag' );
wp_footer();

?>
</body>
</html>