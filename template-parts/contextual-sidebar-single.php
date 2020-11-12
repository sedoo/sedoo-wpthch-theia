<?php
/**
 * Template part for the contextual sidebar in single
 *
 */

?>
<aside class="contextual-sidebar">
    
    <?php 
    if ( get_field('ajouteur_auteur')) {
        get_template_part( 'template-parts/single-author', '' );
    }  
    

    $taxonomy = 'theme';
    $themes = get_the_terms( $post->ID, $taxonomy);
    $taxonomy_labels = get_taxonomy_labels( get_taxonomy($taxonomy) );

    if (is_array($themes)) {
        ?>
        <h2>
        <?php 
            echo __($taxonomy_labels->name, 'sedoo-wpth-labs');              
        ?>
        </h2>                    
        <?php
        sedoo_labtools_show_categories($themes, $taxonomy);
    }
    ?>  
</aside>
