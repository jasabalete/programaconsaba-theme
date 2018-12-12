<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package programa_con_saba
 * @subpackage saba_theme
 * @since 1.0
 * @version 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php
if (! is_front_page ()) {
?>
	<div class="row text-right">
		<?php if ( has_nav_menu( 'intranet-menu' ) ) { ?>
			
			<?php
			wp_nav_menu ( array (
					'menu' => 'intranet-menu',
					'theme_location' => 'intranet-menu',
					'depth' => 2,
					'container' => 'div'
			) );
		}
		?>
	</div>
	<hr/>
<?php 
}
?>
	<div class="entry-content">
		<?php
		the_content ();
		?>
	</div>
</article>