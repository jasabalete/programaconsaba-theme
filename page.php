<?php
/**
 * La plantilla que renderiza las paginas
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */
get_header ();
?>

<div class="content-wrapper container-fluid">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
			<?php
			while ( have_posts () ) :
				the_post ();
				
				get_template_part ( 'template-parts/page/content', 'page' );
				
				// If comments are open or we have at least one comment, load up the comment template.
				if (comments_open () || get_comments_number ()) :
					comments_template ();
				
				
				endif;
			endwhile
			; // End of the loop.
			?>
	</div>
</div>
<?php

get_footer ();
