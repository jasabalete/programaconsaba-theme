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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header>
	<hr/>
	<!-- .entry-header -->
<?php 
}
?>
	<div class="entry-content">
		<?php
		the_content ();
		?>
	</div>
	<!-- .entry-content -->
</article>
<!-- #post-## -->
