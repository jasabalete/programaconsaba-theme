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
			/*
			echo '<p>Escrito por ' . get_the_author_link() . ' el ' . get_post_time( 'd/m/Y' );
			
			// Si el post ha sido actualizado (ojo, se mira sólo la fecha y no la hora) se imprime la información
			if( get_post_time( 'd/m/Y' ) != get_post_modified_time( 'd/m/Y' )) {
				echo  ' y actualizado el ' . get_post_modified_time( 'd/m/Y' );
			}
			
			echo ' en ';
			the_category(', ');
			echo '</p>';
			*/
			
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			if ( is_single() ) {

				$iframe = get_field('pcs_youtube_url');

				if ($iframe) {
					echo do_shortcode('[programaconsaba_yt_video yt_url="' . $iframe . '"]');
				}

				the_content( get_the_title() );

				$urlGit = get_field('pcs_git_url');

				if ($urlGit) {
					echo '<h2>Recursos</h2>';
					echo "<a href='$urlGit' target='_black'>Cógigo fuente</a>";
				}

				$download = get_field('pcs_descarga_asociada');

				if ($download) {                  
					echo do_shortcode('[programaconsaba_texto_compra]');
					echo do_shortcode( '[purchase_link id="' . $download->ID . '" text="Código fuente" style="button" color="blue"]');
				}

				$codigoFuente = get_field('pcs_codigo_fuente');

				if ($codigoFuente){ 
				?>
					<div class="row text-center codigo-Fuente">
						<p>¿No te ha quedado del todo clara la explicación?</p>
						<p>¡Aquí tienes el codigo fuente para que no tengas dudas!</p>
						<p>👇👇👇</p>
						<div class="wp-block-button aligncenter is-style-squared">
							<?php
							if(is_user_logged_in()){
							?>
								<a class="wp-block-button__link has-text-color has-very-light-gray-color has-background" href="<?=$codigoFuente['url']?>" target="_black" style="background-color:#e53d46">Descargar cógigo fuente<br></a>
							<?php
							} else {
							?>
								<a class="wp-block-button__link has-text-color has-very-light-gray-color has-background" href="/registrate" target="_black" style="background-color:#e53d46">Descargar cógigo fuente<br></a>
							<?php
							}
							?>
						</div>
					</div>
				<?php 
				}				
			} else {
				the_excerpt( get_the_title() );
			}
		?>
	</div><!-- .entry-content -->	
</article><!-- #post-## -->
