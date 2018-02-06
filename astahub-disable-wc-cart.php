<?php
/*
Plugin Name: Astahub - Disable WooCommerce Cart
Plugin URI: 
Description: Disable WooCommerce's Add to cart button, and also remove the StoreFront header cart menu.
Author: harisrozak
Author URI: 
Version: 0.1
Text Domain: astahub-disable-wc-cart
License: GPL version 2 or later - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/

// disallow all products to purchase
add_filter( 'woocommerce_is_purchasable','__return_false',10,2);

// remove add to cart button on certain pages
add_filter('woocommerce_get_price_html', 'astahub_disable_cart_on_items');
function astahub_disable_cart_on_items($price) {
	remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart' );
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
    
    return $price;
}

// remove header cart on storefront theme
add_action('after_setup_theme', 'astahub_disable_cart_on_storefront_header');
function astahub_disable_cart_on_storefront_header() {
	remove_action( 'storefront_header', 'storefront_header_cart', 60 );
}