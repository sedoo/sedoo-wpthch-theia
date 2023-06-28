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
    

    if( function_exists('sedoo_show_categories') ){
        $taxonomy = 'theme_theia';
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
            sedoo_show_categories($themes, $taxonomy);
        }
    }   
    ?>  
</aside>
