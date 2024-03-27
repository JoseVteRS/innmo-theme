<?php

/**
 * Template part for displaying the header content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package innmo
 */

?>

<header id="masthead" class="bg-neutral-300 p-5 shadow sticky top-0 z-50">
	<div class="container mx-auto flex items-center justify-between">
		<div>
			<?php
			if (is_front_page()) :
			?>
				<h1 class="font-bold"><?php bloginfo('name'); ?></h1>
			<?php
			else :
			?>
				<p><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
			<?php
			endif;

			$in_description = get_bloginfo('description', 'display');
			if ($in_description || is_customize_preview()) :
			?>
				<p><?php echo $in_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped 
					?></p>
			<?php endif; ?>
		</div>

		<nav id="site-navigation" aria-label="<?php esc_attr_e('Main Navigation', 'innmo'); ?>" class="flex items-center justify-end gap-2">
			<button aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'innmo'); ?></button>

			<?php
			wp_nav_menu(
				array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
					'items_wrap'     => '<ul id="%1$s" class="%2$s" aria-label="submenu">%3$s</ul>',
				)
			);
			?>
		</nav><!-- #site-navigation -->

	</div>

</header><!-- #masthead -->