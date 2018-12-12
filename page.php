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
						$path = "//" . $_SERVER ['HTTP_HOST'] . $_SERVER ['REQUEST_URI'];
						echo do_shortcode ( "[edd_login redirect='$path']" );
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
