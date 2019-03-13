<?php
/**
 * ProgramaConSabaTheme: funciones y definiciones.
 *
 * @package programaconsaba
 * @since ProgramaConSabaTheme 1.0
 */

require_once('inc/wp_bootstrap_navwalker.php');

add_theme_support( 'post-thumbnails' );

add_image_size('list-small-thumb', 160, 90, true);
add_image_size('list-medium-thumb', 528, 297, true);

function programaconsaba_setup() {
	// Se registra el menú principal
	register_nav_menu('menuppal', "Menú principal");
	// Se registra el menú de la intranet
	register_nav_menu('intranet-menu', 'Menú Intranet');
	// Menú legal para el pie de página
	register_nav_menu('legal-menu', 'Menú Legal' );

	add_shortcode( 'programaconsaba_texto_compra', 'programaconsaba_texto_compra_shortcode' );
	add_shortcode( 'programaconsaba_yt_video', 'programaconsaba_yt_video_shortcode' );
	add_shortcode( 'programaconsaba_post_navigator', 'programaconsaba_post_navigator_shortcode' );

	add_shortcode( 'programaconsaba_cta_registro', 'programaconsaba_cta_registro_shortcode' );
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
	
	$pagination = '	<div class="text-center list-pagination">
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

/**
 * Shortcodes
 **/
function programaconsaba_cta_registro_shortcode() {
	$txt = '';
	if(!is_user_logged_in()){
		$txt = '<div class="cta-registro">' .
					'Esto es sólo una pequeña muestra de lo que puedo ofrecerte.' .
					'<div>¡Apúntate a los cursos gratuitos!</div>' .
					'<div class="cta-notice">▶<a href="/registrate">¡Regístrate GRATIS aquí y aprende cómo lo hago!</a>◀</div>' .
				'</div>';
	}

	return $txt;
}

function programaconsaba_texto_compra_shortcode() {
	return '<div class="cta-compra">¿Te gusta lo que ves? ¿Quieres el código fuente? Puedes comprar el código fuente para que te quede todo mucho más claro. <span class="cta-notice">Con la compra me ayudas a dejar esta página libre de publicidad y me animas a seguir creando contenidos</span></div>';
}

function programaconsaba_yt_video_shortcode ($atts, $content = null) {
	$iframe = get_field('pcs_youtube_url');

	 // use preg_match to find iframe src
	 preg_match('/src="(.+?)"/', $iframe, $matches);
	 $src = $matches[1];


	 // add extra params to iframe src
	 $params = array(
		 'controls'  => 1,
		 'hd'        => 1,
		 'autohide'  => 1,
		 'showinfo'  => 0
	 );

	 $new_src = add_query_arg($params, $src);

	 $iframe = str_replace($src, $new_src, $iframe);


	 // add extra attributes to iframe html
	 $attributes = 'frameborder="0"';

	 $iframe = str_replace('></iframe>', ' ' . $attributes . '></iframe>', $iframe);

	return '<div class="embed-container pcs-yt-video">' . $iframe . '</div>';
}

function programaconsaba_post_navigator_shortcode () {
	$next_post = get_next_post();
	$previous_post = get_previous_post();
	
	$html  = '<div class="post-navigator">';
	$html .= '	<div class="previous_next_post_title text-center">';
	$html .= '		Quizás también te interese';
	$html .= '	</div>';
	if ($previous_post) {
		$html .= '	<div class="row">';
		$html .= '		<div class="previous_next_post col-md-offset-3 col-md-3 text-center">';
		$html .= ' 			<a href="' . get_permalink($previous_post->ID) . '" rel="prev">';
		$html .= 				get_the_post_thumbnail($previous_post->ID, 'list-small-thumb');
		$html .= '				<span>' . get_the_title($previous_post->ID) . '</span>';
		$html .= '			</a>';
		$html .= '		</div>';
	}

	if ($next_post) {
		$html .= '		<div class="previous_next_post col-md-3 text-center">';	
		$html .= ' 			<a href="' . get_permalink($next_post->ID) . '" rel="prev">';
		$html .= 				get_the_post_thumbnail($next_post->ID, 'list-small-thumb');
		$html .= '				<span>' . get_the_title($next_post->ID) . '</span>';
		$html .= '			</a>';
		$html .= '		</div>';	
		$html .= '	</div>';
	}

	$html .= '</div>';

	return $html;
}

add_filter( 'get_the_archive_title', function ($title) {
    if ( is_category() ) {
            $title = single_cat_title( '', false );
        } elseif ( is_tag() ) {
            $title = single_tag_title( '', false );
        } elseif ( is_author() ) {
            $title = '<span class="vcard">' . get_the_author() . '</span>' ;
        } elseif ( is_archive() ) {
            $title = post_type_archive_title( '', false );
        }
    return $title;
});

// Se añade la opción de menú de logout si el usuario está logado
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

function add_login_logout_link($items, $args) {
	// Sólo se muestra el botón de desconectar en el menú activado para el theme_location 'secondary'
	if(is_user_logged_in() && $args->theme_location === 'intranet-menu'){
		ob_start();
			wp_loginout('/');
			$loginoutlink = ob_get_contents();
		ob_end_clean();
			$items .= '<li class="menu-desconectar">'. $loginoutlink .'</li>';
	}
	
	return $items;
}

function the_excerpt_more_link( $excerpt ){
    $post = get_post();
    $excerpt .= '<a href="'. get_permalink($post->ID) . '">SEGUIR LEYENDO ➤</a>';
    return $excerpt;
}
add_filter( 'the_excerpt', 'the_excerpt_more_link', 21 );

// Se oculta la barra de administración en producción, excepto cuando viene el parámetro admin_bar
if (get_site_url() === 'https://programaconsaba.com' && !isset($_GET['admin_bar'])){
	show_admin_bar(false);
}

// Correo electrónico de Olvidó su clave. Se añade texto legal.
add_filter( 'retrieve_password_message', 'replace_retrieve_password_message', 10, 4 );

function replace_retrieve_password_message( $message, $key, $user_login, $user_data ) {
	$message .= '---' . "\r\n\r\n";
	$message .= 'De conformidad con el reglamento (UE) 2016/679 del Parlamento Europeo y del Consejo, de 27 de abril de 2016, relativo a la protección de las personas físicas en lo que respecta al tratamiento de datos personales y a la libre circulación de estos datos y por el que se deroga la Directiva 95/46/CE (Reglamento general de protección de datos o RGPD), le recordamos que sus datos son objeto de tratamiento por parte de José Antonio Sabalete Mármol. Estos datos son gestionados con la finalidad de informar y comunicar todo aquello relativo a la prestación de mis servicios profesionales y actividades relacionadas con la web https://programaconsaba.com. Recibes este correo porque me has facilitado y/o cedido voluntariamente tu dirección electrónica. No obstante, puedes ejercer tus derechos de acceso, rectificación, limitación, supresión, portabilidad y oposición al tratamiento de sus datos enviando un email a jasabalete@programaconsaba.com (poniendo en el asunto “Ejercicio de derechos" y adjuntando una copia de su DNI). Dispone también del derecho a presentar una reclamación ante una autoridad de control. Recuerda que todos tus datos serán tratados con la máxima confidencialidad y conforme al RGPD, y la Ley 34/2002 de Servicios de la sociedad de la información y de comercio electrónico (LSSI-CE).' . "\r\n\r\n";
 
    return $message;
}