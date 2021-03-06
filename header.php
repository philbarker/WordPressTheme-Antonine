<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<?PHP
	get_template_part('parts/header/main');
	get_template_part('parts/header/dc');
?>
<body <?php body_class(); ?>>
	<div id="page" class="hfeed site">
		<div id="header-area" class="sidebar sidebar-centre">
			<header id="masthead" class="site-header" role="banner">
				<div class="site-branding">
				<?php
					if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?PHP echo get_bloginfo('name'); ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?PHP echo get_bloginfo('name'); ?></a></p>
					<?php endif;
				?>
				</div><!-- .site-branding -->
			</header><!-- .site-header -->
		</div>
		<div id="content" class="site-content">
