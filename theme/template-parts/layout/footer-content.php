<?php

/**
 * Template part for displaying the footer content
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package innmo
 */

?>

<footer id="colophon" class="bg-neutral-300 p-5 ">
	<div class="container mx-auto">
		<?php if (is_active_sidebar('sidebar-1')) : ?>
			<aside role="complementary" aria-label="<?php esc_attr_e('Footer', 'innmo'); ?>">
				<?php dynamic_sidebar('sidebar-1'); ?>
			</aside>
		<?php endif; ?>

		<?php if (has_nav_menu('menu-2')) : ?>
			<nav aria-label="<?php esc_attr_e('Footer Menu', 'innmo'); ?>">
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_class'     => 'footer-menu',
						'depth'          => 1,
					)
				);
				?>
			</nav>
		<?php endif; ?>

		<div>
			<?php
			$in_blog_info = get_bloginfo('name');
			if (!empty($in_blog_info)) :
			?>
				<a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>,
			<?php
			endif;

			/* translators: 1: WordPress link, 2: WordPress. */
			printf(
				'<a href="%1$s">proudly powered by %2$s</a>.',
				esc_url(__('https://wordpress.org/', 'innmo')),
				'WordPress'
			);

			$contacto_nombre = pods('datos')->field('datos-nombre');
			$contacto_telefono = pods('datos')->field('datos-telefono');
			$contacto_email = pods('datos')->field('datos-email');
			?>
			<h3>Contacto</h3>
			<p>Nombre: <?php echo $contacto_nombre ?></p>
			<p>Teléfono: <?php echo $contacto_telefono ?></p>
			<p>Email: <?php echo $contacto_email ?></p>

		</div>
	</div>


</footer><!-- #colophon -->