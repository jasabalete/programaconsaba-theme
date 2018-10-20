<?php
/**
 * ProgramaConSabaTheme: funciones y definiciones.
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */

require_once('inc/wp_bootstrap_navwalker.php');

function programaconsaba_setup() {
	// Se registra el menú principal
	register_nav_menu('menuppal', "Menú principal");
	add_shortcode( 'my_cta_compra', 'programaconsaba_texto_compra_shortcode' );
}

add_action( 'after_setup_theme', 'programaconsaba_setup');

function programaconsaba_scripts() {
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), array(), null, true );
	//wp_enqueue_script( 'jquery');
	
	wp_enqueue_script( 'programaconsaba-bootstrap-js', get_theme_file_uri( '/assets/bootstrap/js/bootstrap.min.js' ), array(), '1.0.0', true );

	wp_enqueue_style( 'programaconsaba-normalize', get_theme_file_uri( '/assets/css/normalize.css' ));
	wp_enqueue_style( 'programaconsaba-bootstrap', get_theme_file_uri( '/assets/bootstrap/css/bootstrap.min.css' ));
	wp_enqueue_style( 'programaconsaba-style', get_stylesheet_uri());
	
}

add_action( 'wp_enqueue_scripts', 'programaconsaba_scripts' );

function programaconsaba_pagination(){
	
	global $paged;
	
	if(empty($paged)) $paged = 1;
	
	global $wp_query;
	
	$pagination = '	<div class="text-center">
						<nav aria-label="Page navigation">
							<ul class="pagination">
								<li class="disabled hidden-xs"><span><span aria-hidden="true">Página ' . $paged . ' de ' . $wp_query->max_num_pages . '</span></span></li>';
	if ($paged > 1){
			
		$pagination .= '<li>
							<a href="' . get_pagenum_link($paged - 1) . '" aria-label="Previous">
				        		<span aria-hidden="true">&laquo;</span>
				      		</a>
				    	</li>';
	}
	
	for ($cont = 1; $cont <= $wp_query->max_num_pages; $cont ++ ){
		if($cont == $paged){
			$pagination .= '<li class="active">';
		} else {
			$pagination .= '<li>';
		}
		
		$pagination .= "<a href='" . get_pagenum_link($cont) . "'>$cont</a></li>";
	}
	
	if ($paged < $wp_query->max_num_pages){
		
		$pagination .= '<li>
							<a href="' . get_pagenum_link($paged + 1) . '" aria-label="Next">
								<span aria-hidden="true">&raquo;</span>
							</a>
						</li>';
	}
			
	$pagination .= '</ul></nav></div>';
	
	echo $pagination;
}

function programaconsaba_template_redirect() {
	global $wp;
    if( $wp->request == 'changelog' ) {
	   load_template( dirname ( __FILE__ ) . '/changelog.php' );
	   exit();
    }
}

add_action( 'template_redirect', 'programaconsaba_template_redirect' );

function create_custom_post_type_tutoriales () {
	register_post_type('pcs_tutoriales',
		array (
			'labels' => array (
				'name' => 'Tutoriales',
				'singular' => 'Tutorial'
			),
			'public' => true,
			'has_archive' => true,
			'taxonomies'  => array( 'category' ),
			'rewrite' => array (
				'slug' =>'tutoriales'
			),
			'menu_icon' => 'dashicons-video-alt3',
			'supports' => array (
				'title', 'editor', 'excerpt'
				// 'title', 'editor', 'comments', 'revisions', 'trackbacks', 'author', 'excerpt', 'page-attributes', 'thumbnail', 'custom-fields', and 'post-formats'
			)
		)
	);
}

add_action ( 'init', 'create_custom_post_type_tutoriales');

/**
 * Shortcodes
 **/
function programaconsaba_texto_compra_shortcode() {
	return '<div class="cta-compra">¿Te gusta lo que ves? ¿Quieres el código fuente? Puedes comprar el código fuente para que te quede todo mucho más claro. <span class="cta-notice">Con la compra me ayudas a dejar esta página libre de publicidad y me animas a seguir creando contenidos</span></div>';
}

// Se oculta la barra de administración
if (!isset($_GET['admin_bar'])){
	show_admin_bar(false);
}
