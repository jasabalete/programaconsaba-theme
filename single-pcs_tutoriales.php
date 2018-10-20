<?php

get_header(); 
the_post();

?>
<div class="content-wrapper container-fluid">
	<div class="col-md-offset-2 col-md-8 col-md-offset-2">

        <article id="custom-post-tutoriales-<?php the_ID(); ?>" <?php post_class(); ?>>

            <header class="entry-header">
                <?php
                    the_title( '<h1 class="entry-title">', '</h1>' );
                    
                    echo '<p>';
                        the_category(', ');
                    echo '</p>';
                    
                ?>
            </header><!-- .entry-header -->

<?php
            // get iframe HTML
            $iframe = get_field('pcs_youtube_url');

            if ($iframe) {
?>
                <div class="embed-container">
                    <?php
                        
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

                        echo $iframe;
                    ?>
                </div>
<?php
            }
?>
            <div class="entry-content">
                <?php
                    if ( is_single() ) {
                        the_content( get_the_title() );

                        $urlGit = get_field('pcs_git_url');

                        if ($urlGit) {
                            echo '<h2>Recursos</h2>';
                            echo "<a href='$urlGit' target='_black'>Cógigo fuente</a>";
                        }

                        $download = get_field('pcs_descarga_asociada');

                        if ($download) {                  
                            echo do_shortcode('[my_cta_compra]');
                            echo do_shortcode( '[purchase_link id="' . $download->ID . '" text="Código fuente" style="button" color="blue"]');
                        }
                        
                        if ( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                        
                    } else {
                        the_excerpt( get_the_title() );
                    }
                ?>
            </div><!-- .entry-content -->	
        </article><!-- #post-## -->
	</div>
</div>
<?php 
get_footer();
?>