<?php
/**
 * Template part for displaying page content in template-ces.php
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

/**
 * Affichage WP_Query
 */
// QUERY
$categories = get_the_terms( $post->ID, 'category');  // recup des terms de la taxonomie categorie
//var_dump($categories);
$terms=array();
foreach ($categories as $term_slug) {
    array_push($terms, $term_slug->slug);
    //echo $term_slug->slug."<br>";
}
//var_dump($terms);
/**
 * Affichage WP_Query
 */
    $args = array(
        'post_type' => 'page',
        'post_status'           => array( 'publish' ),
        'posts_per_page'        => 7,                  // -1 pour liste sans limite
        'post__not_in'          => array($post->ID),    //exclu le post courant
        'tax_query' => array(
            array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $terms,
            ),
        ),
        'meta_key' => '_wp_page_template',
        'meta_value' => 'template-ces.php',
    );
$the_query = new WP_Query( $args );

// The Loop
if ( $the_query->have_posts() ) {
    echo '<ul>';
    while ( $the_query->have_posts() ) {
        $the_query->the_post();
        ?><li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li><?php
    }
    echo '</ul>';
    /* Restore original Post Data */
    wp_reset_postdata();
} else {
    // no posts found
}

?>
