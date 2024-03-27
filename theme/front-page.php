<?php if ( ! defined( 'ABSPATH' ) ) {
  exit;
} ?>
<?php get_header(); ?>

<main class="min-h-screen">
    <?php do_action('in_home_header_section') ?>
    <?php do_action('in_home_featured_section') ?>
    <?php do_action('in_home_search_section') ?>
    </div>
</main>

<?php get_footer(); ?>