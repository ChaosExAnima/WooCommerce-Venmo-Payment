<?php
/**
 * Plugin Name: WooCommerce Venmo Payment
 * Plugin URI: https://woocommerce.com/
 * Description: A plugin to add a Venmo payment gateway.
 * Version: 1.0.0
 * Author: Echo
 * Author URI: https://echonyc.name
 * Text Domain: wc-venmo
 *
 * @package WooVenmoPayment
 */

namespace EchoNYC\WooVenmoPayment;

defined( 'ABSPATH' ) || exit;

/**
 * Adds the gateway.
 *
 * @param array $methods The payment gateway methods.
 * @return array
 */
function add_gateway( array $methods ) : array {
	require_once __DIR__ . '/class-gateway.php';
	$methods[] = __NAMESPACE__ . '\\Gateway';
	return $methods;
}
add_filter( 'woocommerce_payment_gateways', __NAMESPACE__ . '\\add_gateway' );

/**
 * Hides cash on demand payments from front end.
 *
 * @param array $gateways Array of payment gateways, keyed by slug.
 * @return array
 */
function filter_payment_gateways( array $gateways ) : array {
	if ( ! is_admin() && isset( $gateways['venmo'] ) ) {
		unset( $gateways['venmo'] );
	}
	return $gateways;
}
add_filter( 'woocommerce_available_payment_gateways', __NAMESPACE__ . '\\filter_payment_gateways' );
