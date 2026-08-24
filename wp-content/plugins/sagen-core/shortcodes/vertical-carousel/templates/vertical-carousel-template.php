<div class="qodef-vertical-carousel">
    <?php if(!empty($items)) { ?>
        <div class="qodef-vc-images-holder qodef-reveal-from-left" >
            <div class="qodef-vc-images-slider">
                <?php $i = 1; ?>
                <?php foreach($items as $item) : ?>
                    <?php if(isset($item['image'])) { ?>
                        <div class="qodef-vc-images-slider-item"  data-index="<?php echo esc_attr($i)?>">
                            <?php if(isset($item['touch_devices_link'])) { ?>
                                <a class="qodef-touch-link" href="<?php echo esc_url($touch_devices_link); ?>"></a>
                            <?php } ?>
                            <div class="qodef-vc-item-image" style="background-image: url('<?php echo wp_get_attachment_image_url($item['image'], 'full'); ?>')">
                            </div>
                        </div>
                    <?php } ?>
                    <?php $i++; ?>
                <?php endforeach; ?>
            </div>
        </div>
		<div class="qodef-vc-content-holder">
			<div class="qodef-vc-content">
				<div class="qodef-vc-content-tas">
					<?php if(!empty($main_title)) { ?>
						<<?php echo sagen_select_escape_title_tag($main_title_tag);?> itemprop="name" class="qodef-vc-title">
							<?php echo esc_attr($main_title); ?>
						</<?php echo sagen_select_escape_title_tag($main_title_tag);?>>
						<div class="qodef-separator-holder clearfix qodef-separator-left">
							<div class="qodef-separator"></div>
						</div>
					<?php } ?>
					<?php if(!empty($main_subtitle)) { ?>
						<p class="qodef-vc-subtitle"><?php echo esc_attr($main_subtitle); ?></p>
					<?php } ?>
				</div>
		        <div class="qodef-vc-content-holder-inner">
					<?php if(!empty($bottom_title)) { ?>
						<h6 class="qodef-vc-bottom-title"><?php echo esc_attr($bottom_title); ?></h6>
					<?php } ?>
			        <?php $j = 1; ?>
		            <?php foreach($items as $item) : ?>
		                <div class="qodef-vc-item-content" data-index="<?php echo esc_attr($j)?>">
							<?php if(isset($item['title'])) { ?>
								<span aria-hidden="true" class="qodef-icon-font-elegant icon_stop"></span>
			                    <p class="qodef-vc-item-title"><?php echo esc_attr($item['title']); ?></p>
		                    <?php } ?>
		                </div>
			            <?php $j++; ?>
		            <?php endforeach; ?>
		        </div>
			</div>
		</div>
    <?php } ?>
</div>