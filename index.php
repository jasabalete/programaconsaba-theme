<?php
/**
 * La plantilla que renderiza el índex
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */

get_header(); 
?>
<div class="content-wrapper container-fluid">
	<header class="page-header">
				<?php
				the_archive_title( '<h1 class="page-title">', '</h1>' );
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
		<?php
			if ( have_posts() ) {

				/* Start the Loop */
				while ( have_posts() ) { 
					the_post();

					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					get_template_part( 'template-parts/post/content', get_post_format() );

				}
				
				if (function_exists("programaconsaba_pagination")) {
					programaconsaba_pagination();
				}
				
			} else {

				get_template_part( 'template-parts/post/content', 'none' );

			}
			?>
	</div>
</div>
<?php 
get_footer();
?>