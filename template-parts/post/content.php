<?php
/**
 * Plantilla para mostrar un post
*
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
*/

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<header class="entry-header">
		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}
			echo '<p>Escrito por ' . get_the_author_link() . ' el ' . get_post_time( 'd/m/Y' );
			
			// Si el post ha sido actualizado (ojo, se mira sólo la fecha y no la hora) se imprime la información
			if( get_post_time( 'd/m/Y' ) != get_post_modified_time( 'd/m/Y' )) {
				echo  ' y actualizado el ' . get_post_modified_time( 'd/m/Y' );
			}
			
			echo ' en ';
			the_category(', ');
			echo '</p>';
			
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_single() ) {
				the_content( get_the_title() );
				
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				
			} else {
				the_excerpt( get_the_title() );
			}
		?>
	</div><!-- .entry-content -->	
</article><!-- #post-## -->
