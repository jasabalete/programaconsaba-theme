<?php
$params = array(
    'controls'  => 0,
    'hd'        => 1,
    'autohide'  => 0,
    'showinfo'  => 0,
    'width'     => 300
);


?>

<h2 class="text-center">Vídeos <b>GRATUITOS</> en el canal de YouTube</h2> 

<div id="film_roll">
    <div><?= wp_oembed_get('https://youtu.be/JV0ZvLF8RQY', $params); ?></div>
    <div><?= wp_oembed_get('https://youtu.be/RQNIIsFAoaA', $params); ?></div>
    <div><?= wp_oembed_get('https://youtu.be/UXay7dQcMFQ', $params); ?></div>
    <div><?= wp_oembed_get('https://youtu.be/RQNIIsFAoaA', $params); ?></div>
    <div><?= wp_oembed_get('https://youtu.be/BOBDxjFuNvo', $params); ?></div>
    <div><?= wp_oembed_get('https://youtu.be/kzzGMbAOdJ0', $params); ?></div>
    <div><?= wp_oembed_get('https://youtu.be/C-j1dNj9REg', $params); ?></div>

    
</div>

<script src="<?=get_template_directory_uri()?>/assets/js/jquery.film_roll.min.js"></script>

<script>
    jQuery(function() {
        var film_roll = new FilmRoll({
            container: '#film_roll',
            configure_load: true,
            scroll: false
        });
    });
</script>