<?php
/**
 * Main class for Venmo.
 *
 * @package WooVenmoPayment
 */

namespace EchoNYC\WooVenmoPayment;

use WC_Payment_Gateway;

/**
 * Class.
 */
class Gateway extends WC_Payment_Gateway {
	/**
	 * Constructor.
	 */
	public function __construct() {
		$this->id                 = 'venmo';
		$this->method_title       = __( 'Venmo', 'wc-venmo' );
		$this->method_description = __( 'Non-functional Venmo payment method.', 'wc-venmo' );
		$this->has_fields         = false;
		$this->title              = $this->method_title;

		$this->init_form_fields();
		$this->init_settings();
	}

	/**
	 * Form field init.
	 *
	 * @return void
	 */
	public function init_form_fields() : void {
		$this->form_fields = [
			'enabled' => [
				'title'   => __( 'Enable/Disable', 'wc-venmo' ),
				'type'    => 'checkbox',
				'label'   => __( 'Enable Venmo Payment', 'wc-venmo' ),
				'default' => 'yes',
			],
		];
	}

	/**
	 * Processes a payment.
	 *
	 * @param int $order_id The order ID.
	 * @return array
	 */
	public function process_payment( $order_id ) {
		$order = wc_get_order( $order_id );
		$order->payment_complete();
		return [
			'result'   => 'success',
			'redirect' => $this->get_return_url( $order ),
		];
	}
}
