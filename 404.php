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
	<div class="col-md-offset-2 col-md-8 col-md-offset-2 text-center error-404">
		<img src="<?php echo get_theme_file_uri( '/assets/images/404.png');?>"/>
	</div>
</div>
<?php

get_footer ();
