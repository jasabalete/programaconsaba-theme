<?php
/**
 * Página índice para el listado de blogs
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php if ( have_posts() ) { ?>

			<header class="page-header col-md-offset-1 col-md-10 col-xs-12">
				<h1 class="page-title">Listado de todos los tutoriales</h1>
				<div class="archive-description text-center">Todo lo que necesitas saber sobre <a href="/blog/java">Java</a>, <a href="/blog/javascript">JavaScript</a> y <a href="/blog/wordpress">Wordpress</a> para 🔥 <a href="/registrate">MARCAR LA DIFERENCIA</a> 🔥
				<div class="archive-description text-center">¿Echas en falta algún tutorial? ¡Házmelo saber ▶ <a href="/proponer">AQUÍ</a> ◀ ! ✌</div>
			</header><!-- .page-header -->

			<div class="col-md-offset-1 col-md-10 col-xs-12">
			<?php
			/* Start the Loop */

			$i = 0;

			while ( have_posts() ) {
				the_post();

				if ($i % 3 === 0) {
               ?>
                    <div class="file-list row">
                <?php
				}
				
				$i ++;
				?>
					<article class="article-list col-md-4 col-xs-12">
						<header class="text-center">
						
								<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<?php
								the_post_thumbnail( 'list-medium-thumb', array(
									'alt' => the_title_attribute( array(
										'echo' => false,
									) ),
								) );
								?>
							</a>
							<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<?php
									the_title('<h2>','</h2>');
								?>
							</a>
						</header>
						<div class="tutorial-excerpt">
							<?php the_excerpt( get_the_title() ); ?>
							<!--more-->
						</div>
					</article>
				<?php

				if ($i % 3 === 0) {
					?>
						 </div>
					 <?php
				 }

			}

			// Si el número de post a mostrar es impar, hay que cerrar el div
			if ($i % 3 !== 0) {
				?>
						 </div>
				<?php
			}
			?>
				<div class="text-center">
			<?php

			echo do_shortcode('[programaconsaba_cta_registro]');

			if (function_exists("programaconsaba_pagination")) {
				programaconsaba_pagination();
			}
			?>
			</div></div>
			<?php
		} else {

				get_template_part( 'template-parts/post/content', 'none' );

		}
			?>
			</div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
