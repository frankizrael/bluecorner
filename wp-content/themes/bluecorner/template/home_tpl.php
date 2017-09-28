<?php 
 /**
 * Template Name: home
 */
 get_header();
?>
<section class="video_class">
	<div class="imagen_fondo">
		<img src="<?php the_field("video_fondo");?>" title="<?php the_field("titulo");?>">
		<h1><?php the_field("titulo");?></h1>
	</div>
	<video class="video_sure" id="video" autoplay loop>
		<source src="<?php the_field("src_video");?>" type="video/mp4">
	</video>
	<div class="select_rop">
		<div class="content_select">
			<ul>
			<?php 
				$select = get_field("select");
				if(!empty($select)){
					foreach ($select as $option) {
						?>
						<li>
							<a href="<?php echo $option["link"]; ?>">
								<?php echo $option["text"]; ?>
							</a>
						</li>
						<?php
					}
				}
			?>
			</ul>
		</div>
		<div class="content_inic">
			<?php the_field("texto_select");?>
			<span>seleccionar</span>
		</div>		
	</div>	
</section>
<section class="productos_section">
	<div class="contenedor">
		<div class="titular_h2">
			<h2><?php the_field("titular_market_place"); ?></h2>
		</div>
		<div class="productos_core second_style">
			<?php 
				echo do_shortcode('[featured_product_categories cats="870" per_cat="6" columns="3"]');
				//echo do_shortcode('[product_category category="marketplace-inicio" per_page="8" columns="4"]');
			?>
		</div>
	</div>
</section>
<section class="productos_section">
	<div class="contenedor">
		<div class="titular_h2">
			<h2><?php the_field("titular_tienda"); ?></h2>
		</div>
		<div class="productos_core">
			<?php 
				echo do_shortcode('[product_category category="tienda-online" per_page="8" columns="4"]');
			?>
		</div>
	</div>
</section>
<section class="division_section">
	<div class="contenedor">
		<div class="content_ship">
			<img src="<?php the_field("fondo_division"); ?>">
			<div class="left_ship">
				<a href="<?php the_field("link_left"); ?>">	
					Charters
				</a>
			</div>
			<div class="right_ship">
				<a href="<?php the_field("link_right"); ?>">	
					Team building					
				</a>
			</div>
		</div>
	</div>
</section>
<section class="blog_section">
	<div class="contenedor">
		<div class="owlTitularH2">
			<h2><?php the_field("blog_titular"); ?></h2>
		</div>
		<div class="owlBlog">
			<?php
				$args = array( 'posts_per_page' => 10, 'order'=> 'ASC', 'orderby' => 'title' );
				$postslist = get_posts( $args );
				if (!empty($postslist)) {
					foreach ($postslist as $post) {
						?>
						<div class="blog_item">
							<div class="contentimagen">
								<?php the_post_thumbnail("full"); ?>
							</div>
							<div class="titular">
								<?php the_title();?>
							</div>
							<div class="content_back">
								<?php the_excerpt();?>
							</div>
							<div class="metas_b">
								<?php 
									the_date();
								?>
							</div>
						</div>
							
						<?php
					}
				}
			?>
					

					
		</div>
	</div>
</section>
<?php
get_footer();
?>

<script type="text/javascript">
(function($) {
	$(document).ready(function(){
		//$('#video').get(0).play();
		$('.content_inic').on("click",function(){
			$('.content_select').toggleClass("open");
		});
		
	});        
})( jQuery );
</script>