<div class="qodef-team-holder <?php echo esc_attr($holder_classes); ?>">
	<div class="qodef-team-inner">
		<?php if ($team_image !== '') { ?>
			<div class="qodef-team-image">
                <?php echo wp_get_attachment_image($team_image, 'full'); ?>
				<?php if ($team_link !== '') { ?>
					<a class="qodef-team-link" href="<?php echo esc_url($team_link) ?>" target="<?php echo esc_attr($team_target) ?>" ></a>
                <?php } ?>
				<div class="qodef-team-social-holder">
					<?php
					foreach( $team_social_text as $use_this ) { ?>
						<a href="<?php echo esc_html($use_this['link']); ?>" target="<?php echo esc_html($use_this['target']); ?>" class="qodef-team-social-text"><span><?php echo esc_html($use_this['name']); ?></span></a>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		<div class="qodef-team-info">
			<?php if ($team_name !== '') { ?>
				<<?php echo sagen_select_escape_title_tag($team_name_tag); ?> class="qodef-team-name" <?php echo sagen_select_get_inline_style($team_name_styles); ?>><?php echo esc_html($team_name); ?></<?php echo sagen_select_escape_title_tag($team_name_tag); ?>>
			<?php } ?>
			<?php if ($team_position !== "") { ?>
				<p class="qodef-team-position" <?php echo sagen_select_get_inline_style($team_position_styles); ?>><?php echo esc_html($team_position); ?></p>
			<?php } ?>
			<?php if ($team_text !== "") { ?>
				<p class="qodef-team-text" <?php echo sagen_select_get_inline_style($team_text_styles); ?>><?php echo esc_html($team_text); ?></p>
			<?php } ?>
		</div>
	</div>
</div>