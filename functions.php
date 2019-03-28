<?php

add_action( 'wp_enqueue_scripts', 'theia_wpthchild_enqueue_styles' );
function theia_wpthchild_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );


}

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
	if ( is_singular('ces') || is_singular('products') || is_page_template('template-thema.php') || is_page_template('template-produits.php')) {
		wp_enqueue_script('theme_aeris_jquery_sticky', get_template_directory_uri() . '/js/jquery.sticky.js', array('jquery'), '', false );
		wp_enqueue_script('theme_aeris_toc', get_template_directory_uri() . '/js/toc.js', array('jquery'), '', false );
	}
}
add_action( 'wp_enqueue_scripts', 'theia_wpthchild_load_javascript_files' );


/**
 * Affichage des contenus associés
 * 
 */

function theia_wpthchild_get_associate_content($parameters, $args) {
   
    // WP_Query
    // $categories = get_the_terms( $postID, $parameters['category']);  // recup des terms de la taxonomie $parameters['category']
    // $terms=array();
    // foreach ($categories as $term_slug) {        
    //     array_push($terms, $term_slug->slug);
    // }
    /**
     * Affichage WP_Query
     */
    // if ($parameters['taxQueryType'] == "include") {
    //     $taxQuery=array(
    //         'relation' => 'AND',
    //         array(
    //             'taxonomy' => $parameters['category'],
    //             'field'    => 'slug',
    //             'terms'    => $terms,
    //         ),
    //         array(
    //             'taxonomy' => $parameters['taxQueryTaxo'],
    //             'field'    => 'slug',
    //             'terms'    => $parameters['taxQueryCondTerm'],
    //             'operator' => 'IN',
    //         ),
    //     );
    // }
    // if ($parameters['taxQueryType'] == "exclude") {
    //     $taxQuery=array(
    //         'relation' => 'AND',
    //         array(
    //             'taxonomy' => $parameters['category'],
    //             'field'    => 'slug',
    //             'terms'    => $terms,
    //         ),
    //         array(
    //             'taxonomy' => $parameters['taxQueryTaxo'],
    //             'field'    => 'slug',
    //             'terms'    => $parameters['taxQueryCondTerm'],
    //             'operator' => 'NOT IN',
    //         ),
    //     );
    // }
    // if ($parameters['taxQueryType'] == "") {
    //     $taxQuery=array(
    //         array(
    //             'taxonomy' => $parameters['category'],
    //             'field'    => 'slug',
    //             'terms'    => $terms,
    //         ),
    //     );
    // }

    // $args = array(
    //     'post_type' => $parameters['posttype'],
    //     'post_status'           => array( 'publish' ),
    //     'posts_per_page'        => $parameters['limit'],            // -1 pour liste sans limite
    //     'post__not_in'          => array($postID),    //exclu le post courant
    //     'orderby'               => $parameters['orderby'],
    //     'order'                 => $parameters['order'],
    //     'lang'                  => $currentLanguage,    // use language slug in the query
    //     'tax_query'             => $taxQuery,
        // 'tax_query' => array(
        //     'relation' => 'AND',
        //     array(
        //         'taxonomy' => $parameters['category'],
        //         'field'    => 'slug',
        //         'terms'    => $terms,
        //     ),
        //     array(
        //         'taxonomy' => $parameters['category'],
        //         'field'    => 'slug',
        //         'terms'    => $parameters['taxQueryCondTerm'],
        //         'operator' => 'NOT IN',
        //     ),
        // ),
    // );
    // Si le template est mentionné, on affine la requete sur le template utilisé (produits/ces/thematique/...)
    // if ($parameters['template'] !== "") {
    //     $args['meta_key'] = '_wp_page_template';
    //     $args['meta_value'] = $parameters['template'];
    // }
    // var_dump($args);
    $the_query = new WP_Query( $args );
    
    // The Loop
    if ( $the_query->have_posts() ) {
        echo '<section><h3>'.esc_html__( $parameters['sectionTitle'], 'aeris-wordpress-theme' ).'</h3>';
        echo '<ul>';
        while ( $the_query->have_posts() ) {
            $the_query->the_post();
             
            // $titleItem=mb_strimwidth(get_the_title(), 0, 100, '...');  
            ?>
                <li>
                    <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
                        <?php the_title(); ?>
                    </a>
                </li>
            <?php
        }
        echo '</ul></section>';
        /* Restore original Post Data */
        wp_reset_postdata();
    } else {
        // no posts found
    }
}

/***
 * Ajout de l'excerpt pour les pages
 */

add_post_type_support( 'page', 'excerpt' );

/* ------------------------------------------------------------------------------------------------- */
/**
 * CUSTOM TAXONOMIES
 */


 /**
  * THEMES (Research & expertise)
  */

if ( ! function_exists( 'theia_wpthchild_custom_taxonomy' ) ) {
// Register Custom Taxonomy
function theia_wpthchild_custom_taxonomy() {

    $labelsTheme = array(
        'name'                       => _x( 'Themes', 'Taxonomy General Name', 'aeris-wordpress-theme' ),
        'singular_name'              => _x( 'Theme', 'Taxonomy Singular Name', 'aeris-wordpress-theme' ),
        'menu_name'                  => __( 'Theme', 'aeris-wordpress-theme' ),
        'all_items'                  => __( 'All themes', 'aeris-wordpress-theme' ),
        'parent_item'                => __( 'Parent theme', 'aeris-wordpress-theme' ),
        'parent_item_colon'          => __( 'Parent theme:', 'aeris-wordpress-theme' ),
        'new_item_name'              => __( 'New theme', 'aeris-wordpress-theme' ),
        'add_new_item'               => __( 'Add New theme', 'aeris-wordpress-theme' ),
        'edit_item'                  => __( 'Edit theme', 'aeris-wordpress-theme' ),
        'update_item'                => __( 'Update theme', 'aeris-wordpress-theme' ),
        'view_item'                  => __( 'View theme', 'aeris-wordpress-theme' ),
        'separate_items_with_commas' => __( 'Separate themes with commas', 'aeris-wordpress-theme' ),
        'add_or_remove_items'        => __( 'Add or remove themes', 'aeris-wordpress-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'aeris-wordpress-theme' ),
        'popular_items'              => __( 'Popular themes', 'aeris-wordpress-theme' ),
        'search_items'               => __( 'Search themes', 'aeris-wordpress-theme' ),
        'not_found'                  => __( 'Not Found', 'aeris-wordpress-theme' ),
        'no_terms'                   => __( 'No theme', 'aeris-wordpress-theme' ),
        'items_list'                 => __( 'Themes list', 'aeris-wordpress-theme' ),
        'items_list_navigation'      => __( 'Themes list navigation', 'aeris-wordpress-theme' ),
    );
    $rewriteTheme = array(
        'slug'                       => 'theme',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $argsTheme = array(
        'labels'                     => $labelsTheme,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewriteTheme,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'theme', array( 'page' ), $argsTheme );
    register_taxonomy_for_object_type( 'theme', 'post' );

    $labelsProducts = array(
        'name'                       => _x( 'Types of products', 'Taxonomy General Name', 'aeris-wordpress-theme' ),
        'singular_name'              => _x( 'Type of products', 'Taxonomy Singular Name', 'aeris-wordpress-theme' ),
        'menu_name'                  => __( 'Types of products', 'aeris-wordpress-theme' ),
        'all_items'                  => __( 'All types', 'aeris-wordpress-theme' ),
        'parent_item'                => __( 'Parent type', 'aeris-wordpress-theme' ),
        'parent_item_colon'          => __( 'Parent type:', 'aeris-wordpress-theme' ),
        'new_item_name'              => __( 'New type', 'aeris-wordpress-theme' ),
        'add_new_item'               => __( 'Add New type', 'aeris-wordpress-theme' ),
        'edit_item'                  => __( 'Edit type', 'aeris-wordpress-theme' ),
        'update_item'                => __( 'Update type', 'aeris-wordpress-theme' ),
        'view_item'                  => __( 'View type', 'aeris-wordpress-theme' ),
        'separate_items_with_commas' => __( 'Separate types with commas', 'aeris-wordpress-theme' ),
        'add_or_remove_items'        => __( 'Add or remove types', 'aeris-wordpress-theme' ),
        'choose_from_most_used'      => __( 'Choose from the most used', 'aeris-wordpress-theme' ),
        'popular_items'              => __( 'Popular types', 'aeris-wordpress-theme' ),
        'search_items'               => __( 'Search types', 'aeris-wordpress-theme' ),
        'not_found'                  => __( 'Not Found', 'aeris-wordpress-theme' ),
        'no_terms'                   => __( 'No type', 'aeris-wordpress-theme' ),
        'items_list'                 => __( 'Themes list', 'aeris-wordpress-theme' ),
        'items_list_navigation'      => __( 'Themes list navigation', 'aeris-wordpress-theme' ),
    );
    $rewriteProducts = array(
        'slug'                       => 'typeofproduct',
        'with_front'                 => true,
        'hierarchical'               => false,
    );
    $argsProducts = array(
        'labels'                     => $labelsProducts,
        'hierarchical'               => true,
        'public'                     => true,
        'show_ui'                    => true,
        'show_admin_column'          => true,
        'show_in_nav_menus'          => true,
        'show_tagcloud'              => true,
        'rewrite'                    => $rewriteProducts,
        'show_in_rest'               => true,
    );
    register_taxonomy( 'typeproduct', array( 'products' ), $argsProducts );
    register_taxonomy_for_object_type( 'typeproduct', 'page' );

}
add_action( 'init', 'theia_wpthchild_custom_taxonomy', 0 );

}

/******************************************************************
 * Afficher les archives des custom taxonomies
 * $categories = get_the_terms( $post->ID, 'category');  
 */

function theia_wpthchild_show_categories($categories, $slugRewrite) {
 
    if( $categories ) {
    ?>
    <div class="tag">
    <?php
        foreach( $categories as $categorie ) { 
            if ($categorie->slug !== "non-classe") {
            echo '<a href="'.site_url().'/'.$slugRewrite.'/'.$categorie->slug.'" class="'.$categorie->slug.'">';
  
                  echo $categorie->name; 
                ?>                    
            </a>
    <?php 
            }
        }
    ?>
    </div>
  <?php
      } 
  }


/* ------------------------------------------------------------------------------------------------- */
/**
 * CUSTOM POSTS
 */

if ( ! function_exists('theia_wpthchild_custom_post') ) {

    // Register Custom Post Type
    function theia_wpthchild_custom_post() {

        //
        // CUSTOM POST CES 
        //

        $labelsCES = array(
            'name'                  => _x( 'CES', 'Post Type General Name', 'aeris-wordpress-theme' ),
            'singular_name'         => _x( 'CES', 'Post Type Singular Name', 'aeris-wordpress-theme' ),
            'menu_name'             => __( 'CES', 'aeris-wordpress-theme' ),
            'name_admin_bar'        => __( 'CES', 'aeris-wordpress-theme' ),
            'archives'              => __( 'Item Archives', 'aeris-wordpress-theme' ),
            'attributes'            => __( 'Item Attributes', 'aeris-wordpress-theme' ),
            'parent_item_colon'     => __( 'Parent Item:', 'aeris-wordpress-theme' ),
            'all_items'             => __( 'All Items', 'aeris-wordpress-theme' ),
            'add_new_item'          => __( 'Add New Item', 'aeris-wordpress-theme' ),
            'add_new'               => __( 'Add New', 'aeris-wordpress-theme' ),
            'new_item'              => __( 'New Item', 'aeris-wordpress-theme' ),
            'edit_item'             => __( 'Edit Item', 'aeris-wordpress-theme' ),
            'update_item'           => __( 'Update Item', 'aeris-wordpress-theme' ),
            'view_item'             => __( 'View Item', 'aeris-wordpress-theme' ),
            'view_items'            => __( 'View Items', 'aeris-wordpress-theme' ),
            'search_items'          => __( 'Search Item', 'aeris-wordpress-theme' ),
            'not_found'             => __( 'Not found', 'aeris-wordpress-theme' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'aeris-wordpress-theme' ),
            'featured_image'        => __( 'Featured Image', 'aeris-wordpress-theme' ),
            'set_featured_image'    => __( 'Set featured image', 'aeris-wordpress-theme' ),
            'remove_featured_image' => __( 'Remove featured image', 'aeris-wordpress-theme' ),
            'use_featured_image'    => __( 'Use as featured image', 'aeris-wordpress-theme' ),
            'insert_into_item'      => __( 'Insert into item', 'aeris-wordpress-theme' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'aeris-wordpress-theme' ),
            'items_list'            => __( 'Items list', 'aeris-wordpress-theme' ),
            'items_list_navigation' => __( 'Items list navigation', 'aeris-wordpress-theme' ),
            'filter_items_list'     => __( 'Filter items list', 'aeris-wordpress-theme' ),
        );
        $rewriteCES = array(
            'slug'                  => 'ces',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $argsCES = array(
            'label'                 => __( 'CES', 'aeris-wordpress-theme' ),
            'description'           => __( 'Post Type Description', 'aeris-wordpress-theme' ),
            'labels'                => $labelsCES,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'taxonomies'            => array( 'category', 'theme' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 20,
            'menu_icon'             => 'dashicons-awards',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewriteCES,
            'capability_type'       => 'page',
        );
        register_post_type( 'ces', $argsCES );

        //
        // CUSTOM POST PRODUCTS 
        //

        $labelsProducts = array(
            'name'                  => _x( 'Data & Products', 'Post Type General Name', 'aeris-wordpress-theme' ),
            'singular_name'         => _x( 'Data & Product', 'Post Type Singular Name', 'aeris-wordpress-theme' ),
            'menu_name'             => __( 'Data & Products', 'aeris-wordpress-theme' ),
            'name_admin_bar'        => __( 'Data & Products', 'aeris-wordpress-theme' ),
            'archives'              => __( 'Item Archives', 'aeris-wordpress-theme' ),
            'attributes'            => __( 'Item Attributes', 'aeris-wordpress-theme' ),
            'parent_item_colon'     => __( 'Parent Item:', 'aeris-wordpress-theme' ),
            'all_items'             => __( 'All Items', 'aeris-wordpress-theme' ),
            'add_new_item'          => __( 'Add New Item', 'aeris-wordpress-theme' ),
            'add_new'               => __( 'Add New', 'aeris-wordpress-theme' ),
            'new_item'              => __( 'New Item', 'aeris-wordpress-theme' ),
            'edit_item'             => __( 'Edit Item', 'aeris-wordpress-theme' ),
            'update_item'           => __( 'Update Item', 'aeris-wordpress-theme' ),
            'view_item'             => __( 'View Item', 'aeris-wordpress-theme' ),
            'view_items'            => __( 'View Items', 'aeris-wordpress-theme' ),
            'search_items'          => __( 'Search Item', 'aeris-wordpress-theme' ),
            'not_found'             => __( 'Not found', 'aeris-wordpress-theme' ),
            'not_found_in_trash'    => __( 'Not found in Trash', 'aeris-wordpress-theme' ),
            'featured_image'        => __( 'Featured Image', 'aeris-wordpress-theme' ),
            'set_featured_image'    => __( 'Set featured image', 'aeris-wordpress-theme' ),
            'remove_featured_image' => __( 'Remove featured image', 'aeris-wordpress-theme' ),
            'use_featured_image'    => __( 'Use as featured image', 'aeris-wordpress-theme' ),
            'insert_into_item'      => __( 'Insert into item', 'aeris-wordpress-theme' ),
            'uploaded_to_this_item' => __( 'Uploaded to this item', 'aeris-wordpress-theme' ),
            'items_list'            => __( 'Items list', 'aeris-wordpress-theme' ),
            'items_list_navigation' => __( 'Items list navigation', 'aeris-wordpress-theme' ),
            'filter_items_list'     => __( 'Filter items list', 'aeris-wordpress-theme' ),
        );
        $rewriteProducts = array(
            'slug'                  => 'product',
            'with_front'            => true,
            'pages'                 => true,
            'feeds'                 => true,
        );
        $argsProducts = array(
            'label'                 => __( 'Product', 'aeris-wordpress-theme' ),
            'description'           => __( 'Post Type Description', 'aeris-wordpress-theme' ),
            'labels'                => $labelsProducts,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'revisions' ),
            'taxonomies'            => array( 'category', 'theme', 'typeproduct' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 20,
            'menu_icon'             => 'dashicons-chart-area',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'rewrite'               => $rewriteProducts,
            'capability_type'       => 'page',
        );
        register_post_type( 'products', $argsProducts );

    }
    add_action( 'init', 'theia_wpthchild_custom_post', 0 );
    
    }