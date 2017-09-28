<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/font-awesome.css">
<link rel="stylesheet" type="text/css" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/css.css">
</head>
<?php
	$id = 10;
?>
<body <?php body_class(); ?>>
<nav class="topnav">
	<div class="contenedor">
		<ul class="translate">
			<li><a href="<?php echo site_url ();?>">Español</a></li>
		</ul>
		<ul class="menuTop">
			<li class="login_user">
				<?php
				if ( is_user_logged_in() ) {
				    $current_user = wp_get_current_user();
				    ?>
				    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
				    	Bienvenido <?php echo $current_user->user_login; ?>
				    </a>
				    <?php			    
				} else {
				     ?>
				    <a href="<?php echo get_permalink( get_option('woocommerce_myaccount_page_id') ); ?>">
				    	Mi cuenta
				    </a>
				    <?php
				}
				?>
			</li>
			<?php
				$menu = get_field("menu",$id);
				if(!empty($menu)){
					foreach ($menu as $item) {
						?>
						<li>
							<a href="<?php echo $item["link"]; ?>">
								<?php echo $item["text"]; ?>
							</a>
						</li>
						<?php					
					}
				}
			?>
		</ul>
	</div>
</nav>
<header>
	<div class="contenedor">
		<div class="head_top">
			<div class="fueraActive">
				<div class="head_left">
					<a href="<?php echo site_url ();?>">
						<img src="<?php the_field("logo_blanco",$id);?>" class="logo_blanco">
						<img src="<?php the_field("logo",$id);?>" class="logo">
					</a>
				</div>
				<div class="head_right">
					<div class="floatContent">
					<ul>
						<?php
							$lista = get_field("menu_principal",$id);
							if(!empty($lista)){
								foreach ($lista as $list) {
									?>
									<li <?php 
										if (empty($list["imagenes_class_menu"])){
													?>
											class="subMenuCamp"
											<?php
										}
									?>>
										<a href="<?php echo $list["link"]; ?>">
											<?php echo $list["text"]; ?>
											<?php 
												if (empty($list["no_camp"])){
													?>
													<span class="arrow_angle"></span>
													<?php
												}
											?>
										</a>
										<?php 
											if (empty($list["no_camp"])){
												?>
										<?php 
											if(!empty($list["imagenes_class_menu"])){
												?>
												<ul class="subMenu especial_<?php echo $list["imagenes_class_menu"]; ?>">
													<?php 
														$submenu = $list["submenu"];
														if(!empty($submenu)){
															foreach ($submenu as $submenuitem) {
																?>
																<li class="class_<?php echo $submenuitem["class"]; ?>">
																	<div class="imagen_menu_top">
																		<a href="<?php echo $submenuitem["link"]; ?>">
																		<img src="<?php echo $submenuitem["imagen"]; ?>">
																		</a>
																	</div>
																	<a href="<?php echo $submenuitem["link"]; ?>">	
																		<?php echo $submenuitem["text"]; ?>
																	</a>
																</li>
															<?php
															}													
														}
													?>											
												</ul>
												<?php
											}
											else {
												?>
												<div class="menuCustom subMenu">
													<?php echo $list["menu"]; ?>
												</div>
												<?php
											}
										?>	
										<?php
											}
										?>							
									</li>
									<?php					
								}
							}
						?>
					</ul>
					</div>
					<div class="canasta">
						<?php the_field("menu_canasta",$id); ?>
					</div>
				</div>
			</div>
		</div>
		<div class="head_bot">
			<div class="search">
				<div class="search_content">
					<?php echo do_shortcode("[wcas-search-form]"); ?>
				</div>
				<a href="javascript:void(0)" id="search_half">
					<i class="fa fa-search"></i>
				</a>				
			</div>
		</div>
	</div>
</header>