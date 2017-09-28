<?php 
 /**
 * Template Name: template
 */
 get_header();
?>
<section class="content_refield">
	<div class="contenedor">
		<?php		
		while ( have_posts() ) : the_post();			
		?>
		<div class="contenido_rte">
			<?php
				the_content();
			?>
		</div>
		<?php
		endwhile;
		?>
	</div>
</section>
<?php
get_footer();
?>