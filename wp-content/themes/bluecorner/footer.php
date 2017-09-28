<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.2
 */

?>
<?php
	$id = 10;
?>
<footer>
	<div class="contenedor">
		<div class="content_row">
			<?php 
				$footer = get_field("footer",$id);
				if(!empty($footer)){
					foreach ($footer as $foot) {
						?>
						<div class="col25">
							<div class="content_foot">
								<div class="titleFoot">
									<h3><?php echo $foot["titular"];?></h3>
								</div>
								<div class="menuFoot">
									<?php echo $foot["menu"];?>
								</div>
							</div>
						</div>
						<?php						
					}
				}
			?>
		</div>
		<div class="boletin_row">
			<h2>Boletín</h2>
			<p class="bajadah2">Suscríbete a nuestro boletín para recibir noticias y ofertas.</p>
			<div class="contentForm">
				<?php echo do_shortcode('[contact-form-7 id="4" title="footer"]');?>
			</div>
		</div>
	</div>
</footer>
<div class="extra_footer">
	<div class="contenedor">
		<p>© 2016 Powered by Seek</p>
		<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/css/visa.png">
	</div>
</div>
<div class="modal_popup">
	
</div>
<?php wp_footer(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/owl.carousel.css">
<script type="text/javascript" src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/owl.carousel.js"></script>
<script type="text/javascript">
(function($) {
	$(document).ready(function(){
		$('.head_right li').on("mouseenter",function(){
			var $this = $(this);
            $this.find('.subMenu').addClass("open");
		});
        $('.subMenu').on("mouseenter",function(){
			var $this = $(this);
            $this.addClass("open");
		});
		$('.head_right li').on("mouseleave",function(){
			var $this = $(this);
            $this.find('.subMenu').removeClass("open");
		});
		$(window).scroll(function() {
			var top = $(window).scrollTop();
			var heigh = 20;
			if (top > heigh){
			    $('body').addClass('fueraSec');
			}
			else {
			  	$('body').removeClass('fueraSec');
			}
		});

		/*productos*/
		$('.open_popup').on("mouseenter",function(){
			var $this = $(this);
            $this.closest(".shop_cart").addClass("open_popup_add");
		});
		$('.open_popup').on("mouseleave",function(){
			var $this = $(this);
            $this.closest(".shop_cart").removeClass("open_popup_add");
		});
		$('.ajax_add_to_cart').on("mouseenter",function(){
			var $this = $(this);
            $this.closest(".shop_cart").addClass("ajax_add_to_cart_add");
		});
		$('.ajax_add_to_cart').on("mouseleave",function(){
			var $this = $(this);
            $this.closest(".shop_cart").removeClass("ajax_add_to_cart_add");
		});

		/*menu*/
		$('.menuCustom li.menu-item-has-children').on("mouseenter",function(){
			var $this = $(this);
			$this.find('.sub-menu').eq(0).addClass("open");
		});
		$('.menuCustom li.menu-item-has-children').on("mouseleave",function(){
			var $this = $(this);
			$this.find('.sub-menu').eq(0).removeClass("open");
		});

		/*tienda*/		
		$('.listBtn').on("click",function(){
			$('.thBtn').removeClass("active");
			$('.listBtn').addClass("active");
			$("body").addClass("listForm");
		});
		$('.thBtn').on("click",function(){
			$('.listBtn').removeClass("active");
			$('.thBtn').addClass("active");
			$("body").removeClass("listForm");
		});

		$(".owlCarouselRep").owlCarousel({
			dots:true,
			loop:true,
			nav:false,
			margin: 10,
			autoHeight: true,
			items:4
		});

	});       
})( jQuery );
</script>
</body>
</html>

      
