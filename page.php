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

				$parent_id = null;
				$parent_page = get_page_by_path('tu-area-privada');
				if ($parent_page) {
					$parent_id = $parent_page->ID;
				}

				if ($post->post_name === 'tu-area-privada' || $post->post_parent === $parent_id) {
					if (is_user_logged_in()) {
						get_template_part ( 'template-parts/page/content', 'intranet' );
					} else {
						?>
						<div class="custom-registro-placeholder">
						<?php
							$path = "//" . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
							echo '<div class="bg-danger text-center">No puedes acceder al área privada</div>';
							echo '<p>¿No tienes cuenta? <a href="/registrate/">Regístrate</a></p>';
							echo do_shortcode ( "[edd_login redirect='$path']" );
						?>
						</div>
						<?php

					}
				} else {
					get_template_part ( 'template-parts/page/content', 'page' );
				}
				
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
