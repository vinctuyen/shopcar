<?php
/**
 * Display Header.
 * @package Watch Store
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}?>
	<header role="banner">
		<a class="screen-reader-text skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'watch-store' ); ?></a>
		<div class="header-box">
			<?php  get_template_part( 'template-parts/header/top', 'bar' ); ?>
			<div class="mid-header py-md-0 py-3">
				<div class="container">
				  	<div class="row">
					  	<div class="col-lg-3 col-md-4 align-self-center">
					  		<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
					  	</div>
					  	<div class="offset-lg-1 col-lg-4 col-md-4 align-self-center">
					  		<div class="product-search py-md-2 py-3">
					  			<?php if(class_exists( 'WooCommerce' )){?> 
					  				<?php get_product_search_form(); ?>
					  			<?php }?>
					  		</div>
					  	</div>
					  	<div class="col-lg-2 col-md-2 col-6 align-self-center text-end">
					  		<?php if(class_exists('woocommerce')){ ?>
					  			<div class="sign-link">
				                    <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>"><?php esc_html_e('SIGN IN','watch-store'); ?><i class="far fa-user ms-2"></i><span class="screen-reader-text"><?php esc_html_e( 'Login','watch-store' );?></span></a>
					  			</div>
		                  	<?php }?>
					  	</div>
					  	<div class="col-lg-2 col-md-2 col-6 align-self-center text-md-end text-start ps-md-0">
					  		<?php if(class_exists('woocommerce')){ ?>
			                    <span class="cart_no">              
			                      	<a href="<?php if(function_exists('wc_get_cart_url')){ echo esc_url(wc_get_cart_url()); } ?>"><?php esc_html_e( 'MY CART','watch-store' );?><i class="fas fa-shopping-cart ms-2"></i><span class="screen-reader-text"><?php esc_html_e( 'MY CART','watch-store' );?></span></a>
			                      	<span class="cart-value"> <?php echo esc_html(wp_kses_data( WC()->cart->get_cart_contents_count() ));?></span>
			                    </span>
			                <?php } ?>
					  	</div>
				 	</div> 
				</div>
		    </div>
			<div class="<?php if( get_theme_mod( 'watch_store_sticky_header', false) != '') { ?>sticky-menubox<?php } else { ?>close-sticky <?php } ?>">
			    <div class="menu-section">
			    	<div class="container">
			    		<?php get_template_part( 'template-parts/navigation/site', 'nav' ); ?>
			    	</div>
			    </div>
			</div>
		</div>
	</header>