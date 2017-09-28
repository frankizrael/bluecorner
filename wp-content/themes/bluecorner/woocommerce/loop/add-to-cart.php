<?php
/**
 * Loop Add to Cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/add-to-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;
?>
<div class="excerpt_top" style="display:none"><?php echo get_the_excerpt($product->get_id());?></div>
<div class="location">
		<?php
			foreach( wc_get_product_terms( $product->get_id(), 'pa_localizacion' ) as $attribute_value ){
				if(!empty($attribute_value)){
					?>
					<span class="textStrong">Localizaci&oacute;n</span>
					<span class="dataStrong">
						<?php echo $attribute_value; ?>
					</span>
					<?
				}    			
			}		
		?>	
</div>
<div class="fabricante location">
		<?php
			foreach( wc_get_product_terms( $product->get_id(), 'pa_fabricante' ) as $attribute_value ){
				if(!empty($attribute_value)){
					?>
					<span class="textStrong">Fabricante</span>
					<span class="dataStrong">
						<?php echo $attribute_value; ?>
					</span>
					<?
				}    			
			}		
		?>	
</div>
<div class="social">
	<a href="javascript: void(0);" onclick="window.open('http://www.facebook.com/sharer.php?u=<?php echo get_the_permalink($product->get_id()); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');" class="social_ty btnAzul">
			<div class="social-item fb">
				<i class="fa fa-facebook"></i>
			</div>
	</a>
	<a id="twitter" href="javascript: void(0);" onclick="window.open('http://twitter.com/home?status=<?php echo get_the_permalink($product->get_id()); ?>','ventanacompartir', 'toolbar=0, status=0, width=650, height=450');" class="social_ty btnAzul">
			<div class="social-item tw">
				<i class="fa fa-twitter"></i>
			</div>
	</a>
	<a id="pinterest" href="javascript: void(0);" onclick="window.open('http://pinterest.com/pin/create/button/?url=<?php echo get_the_permalink($product->get_id()); ?>','facebookShare', 'toolbar=0, status=0, width=650, height=450');" class="social_ty btnAzul">
			<div class="social-item pi">
				<i class="fa fa-pinterest"></i>
			</div>
	</a>
</div>
<div class="comprar_disenho">
	<span class="alquilD">Alquilar</span>
	<span class="comprarD">Comprar</span>	
</div>


<div class="datos_popup" data-h1='<?php echo get_the_title($product->get_id());?>' style="display:none">	
	<div class="excerpt"><?php echo get_the_excerpt($product->get_id());?></div>
	<?php echo get_the_post_thumbnail($product->get_id());?>
</div>


<div class="shop_cart">
<?php
echo apply_filters( 'woocommerce_loop_add_to_cart_link',
	sprintf( '<a rel="nofollow" href="%s" data-quantity="%s" data-product_id="%s" data-product_sku="%s" class="%s"><i class="fa fa-shopping-cart"></i> <span>%s</span> </a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $quantity ) ? $quantity : 1 ),
		esc_attr( $product->get_id() ),
		esc_attr( $product->get_sku() ),
		esc_attr( isset( $class ) ? $class : 'button' ),
		esc_html( "Comprar" )
	),
$product );
echo '<a class="open_popup" href="javascript:void(0)"><i class="fa fa-search"></i><span>Vista r&aacute;pida</span></a>';
echo '</div>';

