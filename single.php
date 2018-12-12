<?php
/**
 * La plantilla que renderiza el índex
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */

get_header();

?>

	<div id="primary" class="content-wrapper container-fluid">
		<main id="main" class="site-main col-md-offset-2 col-md-8 col-md-offset-2">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/post/content', get_post_format() );

			echo do_shortcode('[my_post_navigator]');

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
