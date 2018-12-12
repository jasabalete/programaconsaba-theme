<?php 
/**
 * Plantilla para mostrar el pie de la página
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */
?>

<footer class="container-fluid">
	<div class="row text-center">
		<div class="col-md-12">
			<?= wp_nav_menu( array( 'theme_location' => 'legal-menu', 'container_class' => 'legal-menu-class' ) ); ?>
		<div>
  		<div class="col-md-12 footer-txt">
  			<p>Copyright 2016-<?php echo date("Y"); ?> <a href="<?php echo get_site_url(); ?>" target="_self"><?php echo substr (get_site_url(), strpos(get_site_url(), '://') + 3); ?></a> Todos los derechos reservados | <small><a href="/theme-changelog"><?php echo wp_get_theme()->version?></a></small></p>
  		</div>
  	</div>
  	<div class="row text-center footer-hecho-en">
  		<div class="col-md-12">Hecho con <i class="ico-love"></i> en España </div>
  	</div>
</footer>


<?php wp_footer(); ?>

</body>
</html>