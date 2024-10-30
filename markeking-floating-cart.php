<?php
/*
Plugin Name: MarkeKing Floating Cart
Plugin URI: http://markeking.es 
Version: 0.1
Author: MarkeKing.es 
Description: Display a cart summary floating on the bottom. You can be sure that customers always find the shopping cart.
*/



//MOSTRAMOS EL CARRO DE COMPRA ABAJO EN POSICION FIJA

add_action( 'wp_footer', 'markeking_floating_cart' );

function markeking_floating_cart(){
	
	if ( ! class_exists( 'WooCommerce' ) )
	return;
	
	global $woocommerce;
	
	//no muestro el carro en paginas de checkout ni carro, porque en responsive entorpece mucho y ademas puede crear confusion
	if(isset($woocommerce->cart) && $woocommerce->cart->cart_contents_count > 0 && !is_cart() && !is_checkout()){
		
		wp_enqueue_style( 'markeking-floating-cart', plugins_url( 'markeking-floating-cart.css', __FILE__ ) );
		
		?>

		<div class="markeking-floating-cart">
			<div class="markeking-floating-cart_1a_fila">
				<img src="<?php echo plugins_url( 'cesta.png', __FILE__ ); ?>">
				<div class="markeking-floating-cart_num_prod"><?php echo $woocommerce->cart->cart_contents_count; ?> <?php _e( 'Product', 'woocommerce' ); ?>/s</div>
				<div class="markeking-floating-cart_total"><?php echo $woocommerce->cart->get_cart_total(); ?></div>
			</div>
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">>><?php _e( 'View Cart', 'woocommerce' ); ?><<</a>
		<a href="<?php echo $woocommerce->cart->get_cart_url(); ?>">>><?php _e( 'Buy Now', 'woocommerce' ); ?><<</a>
		</div>
		
		<?php
	}
	
}


?>