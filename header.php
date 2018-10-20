<?php
/**
 * Plantilla que muestra la cabecera de la página
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport"
	content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?php wp_head(); ?>
</head>
<body>

	<header>
		<div class="container-fluid">
			<div class="row text-center">
				<h1>
					<a href="https://programaconsaba.com"><img
						src="<?php echo get_theme_file_uri( '/assets/images/logo-programaconsaba.png' )?>"
						alt="Programa con Saba" /></a>
				</h1>
			</div>
			<div class="row">
				<nav class="navbar navbar-default" role="navigation">
				<?php if ( has_nav_menu( 'menuppal' ) ) { ?>
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
					<?php
					wp_nav_menu ( array (
							'menu' => 'menuppal',
							'theme_location' => 'menuppal',
							'depth' => 2,
							'container' => 'div',
							'container_class' => 'collapse navbar-collapse',
							'container_id' => 'bs-example-navbar-collapse-1',
							'menu_class' => 'nav navbar-nav',
							'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
							'walker' => new wp_bootstrap_navwalker () 
					) );
				}
				?>
				</nav>
			</div>
		</div>
	</header>