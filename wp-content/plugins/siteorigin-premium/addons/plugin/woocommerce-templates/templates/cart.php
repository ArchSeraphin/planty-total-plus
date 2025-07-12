<?php

defined( 'ABSPATH' ) || exit;

do_action( 'siteorigin_premium_wctb_template_before', 'cart' );
do_action( 'woocommerce_before_cart' );

// If this template has loaded, and the cart is empty, we display the default WC
// cart empty message. This template is only loaded if the user doesn't have
// a custom empty cart template.
if ( WC()->cart->is_empty() ) {
	?>
	<div class="wc-empty-cart-message">
		<?php do_action( 'woocommerce_cart_is_empty' ); ?>
	</div>
	<?php
	return;
}

// If the user has created and enabled a Cart Page Builder layout we load and render it here.
$so_wc_templates = get_option( 'so-wc-templates' );
$template_data = $so_wc_templates[ 'cart' ];

if ( ! empty( $template_data['post_id'] ) ) {
	// Don't call `woocommerce_output_all_notices` here, as they should already be hooked into the above
	// `woocommerce_before_cart` action.
	?>
	<div class="woocommerce-cart-form__contents woocommerce">
		<?php
		SiteOrigin_Premium_Plugin_WooCommerce_Templates::single()->before_template_render();
		echo SiteOrigin_Panels_Renderer::single()->render( $template_data['post_id'] );
		SiteOrigin_Premium_Plugin_WooCommerce_Templates::single()->after_template_render();
		?>
	</div>
	<?php
}

do_action( 'woocommerce_after_cart' );
do_action( 'siteorigin_premium_wctb_template_after', 'cart' );