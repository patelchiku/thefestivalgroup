<?php
/**
 * Product quantity inputs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/global/quantity-input.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * @var bool   $readonly If the input should be set to readonly mode.
 * @var string $type     The input type attribute.
 */

defined( 'ABSPATH' ) || exit;

if ( ! isset( $input_id ) ) {
	$input_id = 'qodef-quantity-id-' . wp_unique_id();
}

/* translators: %s: Quantity. */
$label = ! empty( $args['product_name'] ) ? sprintf( esc_html__( '%s quantity', 'sagen' ), wp_strip_all_tags( $args['product_name'] ) ) : esc_html__( 'Quantity', 'sagen' );

?>
	<div class="qodef-quantity-buttons quantity">
		<?php
		/**
		 * Hook to output something before the quantity input field.
		 *
		 * @since 7.2.0
		 */
		do_action( 'woocommerce_before_quantity_input_field' );
		?>
		<label class="screen-reader-text" for="<?php echo esc_attr( $input_id ); ?>"><?php echo esc_attr( $label ); ?></label>
		<span class="qodef-quantity-minus arrow_carrot-left"></span>
		<input
				type="<?php echo esc_attr( apply_filters( 'sagen_select_filter_woo_quantity_input_type', 'text' ) ); ?>"
				<?php echo esc_attr( $readonly ) ? 'readonly="readonly"' : ''; ?>
				id="<?php echo esc_attr( $input_id ); ?>"
				class="<?php echo esc_attr( join( ' ', (array) $classes ) ); ?> qodef-quantity-input"
				name="<?php echo esc_attr( $input_name ); ?>"
				value="<?php echo esc_attr( $input_value ); ?>"
				aria-label="<?php esc_attr_e( 'Product quantity', 'sagen' ); ?>"
				<?php if ( in_array( $type, array( 'text', 'search', 'tel', 'url', 'email', 'password' ), true ) ) : ?>
					size="4"
				<?php endif; ?>
				data-min="<?php echo esc_attr( $min_value ); ?>"
				data-max="<?php echo esc_attr( 0 < $max_value ? $max_value : '' ); ?>"
				data-step="<?php echo esc_attr( $step ); ?>"
				<?php if ( ! $readonly ) : ?>
					placeholder="<?php echo esc_attr( $placeholder ); ?>"
					inputmode="<?php echo esc_attr( $inputmode ); ?>"
					autocomplete="<?php echo esc_attr( isset( $autocomplete ) ? $autocomplete : 'on' ); ?>"
				<?php endif; ?>
		/>
		<span class="qodef-quantity-plus arrow_carrot-right"></span>
		<?php
		/**
		 * Hook to output something after quantity input field
		 *
		 * @since 3.6.0
		 */
		do_action( 'woocommerce_after_quantity_input_field' );
		?>
	</div>
<?php