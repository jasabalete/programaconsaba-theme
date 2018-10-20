<?php
/**
 * Template Name: Plantilla genérica HOME
 * Template Post Type: page
 */
get_header ();
?>

<div class="content-wrapper container-fluid">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
			<?php
			while ( have_posts () ) :
				the_post ();
				
                get_template_part ( 'template-parts/page/content', 'page' );
                
                get_template_part ( 'template-parts/page/content', 'most-recent-tutorials' );
				
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
