<?php

defined( 'ABSPATH' ) || exit;


do_action( 'siteorigin_premium_wctb_template_before', 'archive' );

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );
?>
<header class="woocommerce-products-header">
	<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) { ?>
		<h1 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h1>
	<?php } ?>

	<?php
	do_action( 'woocommerce_archive_description' );
	?>
</header>
<?php

if ( woocommerce_product_loop() ) {
	do_action( 'woocommerce_before_shop_loop' );
	// If there's "Before Product Archive Loop data present", output it.
	$before_archive = get_option( 'so-wc-templates-before-' . (int) get_query_var( 'wctb_template_id' ), true );

	if (
		apply_filters( 'so_woocommerce_templates_display_before_archive', true ) &&
		! empty( $before_archive )
	) {
		echo '<div class="so-wc-before-archive" style="clear: both;">';
		do_action( 'so_woocommerce_before_archive_widget_start' );
		SiteOrigin_Premium_Plugin_WooCommerce_Templates::single()->before_template_render();
		echo SiteOrigin_Panels_Renderer::single()->render( uniqid( (int) get_query_var( 'wctb_template_id' ) ) . '-before', true, $before_archive );
		SiteOrigin_Premium_Plugin_WooCommerce_Templates::single()->after_template_render();
		do_action( 'so_woocommerce_before_archive_widget_end' );
		echo '</div>';
	}

	woocommerce_product_loop_start();

	if ( wc_get_loop_prop( 'total' ) ) {
		while ( have_posts() ) {
			the_post();

			if ( current_theme_supports( 'woocommerce' ) ) {
				include 'content-product.php';
			} else {
				the_content();
			}
		}
	}

	woocommerce_product_loop_end();

	// If there's "Before Product Archive Loop data present", output it.
	$after_archive = get_option( 'so-wc-templates-after-' . (int) get_query_var( 'wctb_template_id' ), true );

	do_action( 'woocommerce_after_shop_loop' );

	if (
		apply_filters( 'so_woocommerce_templates_display_after_archive', true ) &&
		! empty( $after_archive )
	) {
		echo '<div class="so-wc-after-archive" style="clear: both;">';
		do_action( 'so_woocommerce_after_archive_widget_start' );
		SiteOrigin_Premium_Plugin_WooCommerce_Templates::single()->before_template_render();
		echo SiteOrigin_Panels_Renderer::single()->render( uniqid( (int) get_query_var( 'wctb_template_id' ) ) . '-after', true, $after_archive );
		SiteOrigin_Premium_Plugin_WooCommerce_Templates::single()->after_template_render();
		do_action( 'so_woocommerce_after_archive_widget_end' );
		echo '</div>';
	}
} else {
	do_action( 'woocommerce_no_products_found' );
}

do_action( 'woocommerce_after_main_content' );
do_action( 'woocommerce_sidebar' );

get_footer( 'shop' );

do_action( 'siteorigin_premium_wctb_template_after', 'archive' );