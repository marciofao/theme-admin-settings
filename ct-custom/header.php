<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package CT_Custom
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content">
			<?php esc_html_e('Skip to content', 'ct-custom'); ?>
		</a>

		<header id="masthead" class="site-header">
			<div class="site-callout">
				<p>
					<span class="callus">
						Call us now!
					</span>
					<span class="number">
						<?php echo get_option('phone_number') ?>
					</span>
					<span class="access">

						<a href="login" class="item">
							Login
						</a>

						<a href="#" class="item">
							Sign Up
						</a>
					</span>
				</p>

			</div>
			<div class="flex-header">
				<div class="header-contents">
					<div class="site-branding">
						<div class="coalition-logo">
							<img src="<?php echo get_option('coalition_logo_img') ?>" alt="Site Logo">

						</div>
						<?php
						/* the_custom_logo(); */

						if (is_front_page() && is_home()):
							?>
							<h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									<? php /*  bloginfo('name'); */?>
								</a></h1>
							<?php
						else:
							?>
							<p class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
									<?php /* bloginfo('name'); */?>
								</a></p>
							<?php
						endif;
						$ct_custom_description = get_bloginfo('description', 'display');
						if ($ct_custom_description || is_customize_preview()):
							?>
							<p class="site-description">
								<?php echo $ct_custom_description; /* WPCS: xss ok. */?>
							</p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<nav id="site-navigation" class="main-navigation">
						<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
							<?php esc_html_e('Primary Menu', 'ct-custom'); ?>
						</button>
						<?php
						wp_nav_menu(
							array(
								'theme_location' => 'menu-1',
								'menu_id' => 'primary-menu',
							)
						);
						?>
					</nav><!-- #site-navigation -->
				</div>
			</div>

		</header><!-- #masthead -->

		<div id="content" class="site-content">