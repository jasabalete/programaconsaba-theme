<?php
$args = array(
	'numberposts' => 9,
	'offset' => 0,
	'category' => 0,
	'orderby' => 'post_date',
	'order' => 'DESC',
	'include' => '',
	'exclude' => '',
	'meta_key' => '',
	'meta_value' =>'',
	'post_type' => 'pcs_tutoriales',
	'post_status' => 'publish',
	'suppress_filters' => true
);

$recent_pcs_tutoriales = wp_get_recent_posts( $args, OBJECT );
?>

<div class="home-list-tutoriales">
    <div class="row tutoriales-title"><h2>Tutoriales más recientes</h2></div>
    <?php

        $i = 0;
        foreach ($recent_pcs_tutoriales as $tutorial){
            if ($i % 3 === 0) {
               ?>
                    <div class="row">
                <?php
            }

            $i ++;
            // Averiguar si tiene ACF venta de código fuente
            $tiene_descarga = get_field('pcs_descarga_asociada', strval($tutorial->ID));

            // Averiguar si tiene ACF de youtube
            $youtube = get_field('pcs_youtube_url', strval($tutorial->ID));
            
            if($youtube) {
                preg_match('/^.+\/embed\/(.+)\?.+$/', $youtube, $matches);

                $youtube = "https://img.youtube.com/vi/$matches[1]/maxresdefault.jpg";
            } 
        ?>
            <article class="col-md-4">
                <header>
                    <img src="<?php echo $youtube ?>" rel="bookmark">
                    <?php 
                        if ($youtube) {
                            ?>
                            <span class='custom-post-yt dashicons dashicons-video-alt3' title="Tutorial con vídeo"></span>
                            <?php
                        }
                        
                        if($tiene_descarga) {
                            ?>
                            <span class='custom-post-source-code dashicons dashicons-paperclip' title="Tutorial con código fuente"></span>
                            <?php
                        }
                        echo get_the_category_list (',', '', $tutorial->ID);
                    ?>
                    <h2>
                        <a href="<?php echo get_permalink($tutorial->ID) ?>" rel="bookmark"><?php echo $tutorial->post_title ?></a>
                    </h2>
                </header>
                <div class="tutorial-excerpt">
                    <p><?php echo $tutorial->post_excerpt ?></p>
                </div>
            </article>
        <?php
            if ($i % 3 === 0) {
                ?>
                     </div>
                 <?php
             }
        }
    ?>
</div>