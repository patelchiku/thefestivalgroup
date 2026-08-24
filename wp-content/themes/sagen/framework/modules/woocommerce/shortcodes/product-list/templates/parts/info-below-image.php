<?php
$product = sagen_select_return_woocommerce_global_variable();

if ( $product->is_on_sale() ) {
	$on_sale = 'sale';
}

if ( ! $product->is_in_stock() ) {
	$out_of_stock = 'outofstock';
}

$item_classes           = $this_object->getItemClasses( $params );
$shader_styles          = $this_object->getShaderStyles( $params );
$text_wrapper_styles    = $this_object->getTextWrapperStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="qodef-pli qodef-item-space <?php echo esc_attr( $item_classes ); if (isset($on_sale)){ echo esc_attr( $on_sale ); } if (isset($out_of_stock)){ echo esc_attr( $out_of_stock ); } ?>">
	<div class="qodef-pli-inner">
		<div class="qodef-pli-image">
			<?php sagen_select_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
		</div>
		<div class="qodef-pli-text" <?php echo sagen_select_get_inline_style( $shader_styles ); ?>>
			<div class="qodef-pli-text-outer">
				<div class="qodef-pli-text-inner">
					<?php sagen_select_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
				</div>
			</div>
		</div>
	</div>
	<div class="qodef-pli-text-wrapper" <?php echo sagen_select_get_inline_style( $text_wrapper_styles ); ?>>

		<div class="qodef-title-price-wrapper clearfix">
		<?php sagen_select_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>
		<?php sagen_select_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
		</div>
		
		<?php sagen_select_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>

	</div>
	<a class="qodef-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>

</div>