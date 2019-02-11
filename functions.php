<?php

add_action( 'wp_enqueue_scripts', 'theia_wpthchild_enqueue_styles' );
function theia_wpthchild_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );


}

// if ( function_exists('register_sidebar') ) {
//     register_sidebar(array(
//         'name' => 'Association',
// 		'id' => 'asso',
// 		'description' => 'pour associer les contenus',
//         'before_widget' => '<div id="header">',
//         'after_widget' => '</div>',
//         'before_title' => '<h2>',
//         'after_title' => '</h2>',
//     ));
    
// }

/* Autoriser l'upload de format zip dans les médias */

// GESTION DES FORMATS DE FICHIERS DE LA MÉDIATHÈQUE
 
// Appel de Extend_Upload_Mimes sur le tableau des mimes
// supportés :
add_filter('upload_mimes', 'theia_wpthchild_Extend_Upload_Mimes');
/* 
 * Fonction Extend_Upload_Mimes :
 * Prend en argument le tableau associatif des types mimes
 * supportés le modifie et le retourne modifié.
 */
function theia_wpthchild_Extend_Upload_Mimes ( $CurrentMimes=array() ) {
//	Ajout de nouveaux types :
		$CurrentMimes['zip'] = 'application/zip';
 
//	Suppression de types non souhaités :
	unset( $CurrentMimes['exe'] );
 
	return $CurrentMimes;
}

/**
 * Ajout des categories aux pages
 */

function theia_wpthchild_add_taxonomies_to_pages() {

    register_taxonomy_for_object_type( 'category', 'page' );
} 
add_action( 'init', 'theia_wpthchild_add_taxonomies_to_pages' );

/**
 * Enqueue Javascript files sur template theia
 */
function theia_wpthchild_load_javascript_files() {
	if ( is_page_template('template-ces.php') || is_page_template('template-produits.php') || is_page_template('template-thema.php')) {
		wp_enqueue_script('theme_aeris_jquery_sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '', false );
		wp_enqueue_script('theme_aeris_toc', get_template_directory_uri() . '/js/toc.js', array('jquery'), '', false );
	}
}
add_action( 'wp_enqueue_scripts', 'theia_wpthchild_load_javascript_files' );


/**
 * Affichage des contenus associés
 * 
 */
function theia_wpthchild_get_associate_content($postID, $posttype, $limit, $category, $template) {

    // WP_Query
    $categories = get_the_terms( $postID, $category);  // recup des terms de la taxonomie $category
    $terms=array();
    foreach ($categories as $term_slug) {
        array_push($terms, $term_slug->slug);
    }
    /**
     * Affichage WP_Query
     */
    $args = array(
        'post_type' => $posttype,
        'post_status'           => array( 'publish' ),
        'posts_per_page'        => $limit,            // -1 pour liste sans limite
        'post__not_in'          => array($postID),    //exclu le post courant
        'tax_query' => array(
            array(
                'taxonomy' => $category,
                'field'    => 'slug',
                'terms'    => $terms,
            ),
        ),
    );
    // Si le template est mentionné, on affine la requete sur le template utilisé (produits/ces/thematique/...)
    if ($template !== "") {
        $args['meta_key'] = '_wp_page_template';
        $args['meta_value'] = $template;
    }
    $the_query = new WP_Query( $args );

    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<ul>';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();

            $titleItem=mb_strimwidth(get_the_title(), 0, 40, '...');  
            ?>
            <li>
                <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                    <?php echo $titleItem; ?>
                </a>
            </li>
            <?php
        }
        echo '</ul>';
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        // no posts found
    }
}