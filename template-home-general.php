<?php
/**
 * Template Name: Plantilla genérica HOME
 * Template Post Type: page
 */
get_header ();
?>

<div class="banner-ppal container-fluid text-center">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
		<h1>Amplia tu conocimientos de programación</h1>
		<p>En Programa con Saba vas a encontrar cursos totalmente prácticos para los que quieran ampliar sus conocimientos de programación con los lenguajes, técnicas y herramientas que más salidas laborales tienen. Para todos los niveles</p>
		<div class="wp-block-button aligncenter is-style-squared">
			<a class="wp-block-button__link has-text-color has-very-light-gray-color has-background" href="/registrate" style="background-color:#e53d46">Apúntate a los cursos gratuitos<br></a>
		</div>
	</div>
</div>
<div class="content-wrapper container-fluid">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">
			<?php
			while ( have_posts () ) :
				the_post ();
				
                get_template_part ( 'template-parts/page/content', 'page' );
                
                get_template_part ( 'template-parts/page/content', 'yt-videos-slider' );
				
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
