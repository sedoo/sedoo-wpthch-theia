<?php
/**
 * template pour les pages des CES (affiche actus / thématiques / produits liés)
*/

get_header(); 

while ( have_posts() ) : the_post();

   $categories = get_the_terms( get_the_id(), 'theme');  // recup des terms de la taxonomie $parameters['category']
   $terms=array();
   if (is_array($categories) || is_object($categories))
   {
      foreach ($categories as $term_slug) {        
         array_push($terms, $term_slug->slug);
      }
   }

   $cestags = get_the_terms( get_the_id(), 'cestag');  // recup des terms de la taxonomie $parameters['category']
   $cesTerms=array();
   if (is_array($cestags) || is_object($cestags))
   {
     foreach ($cestags as $cesTerm_slug) {        
        array_push($cesTerms, $cesTerm_slug->slug);
     }
   }


if(get_field('sedoo_img_defaut_yesno', 'option') == true) { // if default cover is in option
    echo '<header id="cover">';
    if (get_the_post_thumbnail()) {// if default cover but cover special for this page
        the_post_thumbnail('cover'); 
    }
    else {
        echo '<img src="'.get_field('sedoo_labs_default_cover_url', 'option').'" class="attachment-cover size-cover wp-post-image">';
    }
    echo '</header>';
} else { // if no default
    if (get_the_post_thumbnail()) {  // if no default cover but special cover for this one
        echo '<header id="cover">';
            the_post_thumbnail('cover'); 
        echo '</header>';
    }
}
?>
</header>
<?php 
// Show title first on mobile
if (get_field( 'table_content' )) {
sedoo_wpth_labs_display_title_on_top_on_mobile();
}
?>
<div id="primary" class="content-area wrapper <?php if (get_field( 'table_content' )) {echo " tocActive";}?> <?php echo esc_html( $categories[0]->slug );?>">
<?php // table_content ( value ) 
if (get_field( 'table_content' )) {
sedoo_wpth_labs_display_sommaire('Sommaire');
} ?>
<main id="main" class="site-main">

<div class="wrapper-content">
    <?php
    while ( have_posts() ) :
        the_post();

        get_template_part( 'template-parts/content', 'page' );
      ?>
         <aside>
               <!-- NEWS --> 
            <?php
               $parameters = array(
                  'sectionTitle'    => 'News',
               );            
               $args = array(
               'post_type'             => 'post',
               'post_status'           => array( 'publish' ),
               'posts_per_page'        => '7',            // -1 pour liste sans limite
               'post__not_in'          => array(get_the_id()),    //exclu le post courant
               'orderby'               => 'date',
               'order'                 => 'DESC',
               'lang'                  => pll_current_language(),    // use language slug in the query
               'tax_query'             => array(
                                       array(
                                          'taxonomy' => 'cestag',
                                          'field'    => 'slug',
                                          'terms'    => $cesTerms,
                                       ),
                                    ),
               // 'meta_key'              => '_wp_page_template',
               // 'meta_value'            => '', // template-name.php
            );            
            theia_wpthchild_get_associate_content($parameters, $args);
            ?>

            <!-- Products --> 
            <?php
               $parameters = array(
                  'sectionTitle'    => "Products",
               );
               
               $args = array(
                  'post_type'             => 'products',
                  'post_status'           => array( 'publish' ),
                  'posts_per_page'        => '-1',            // -1 pour liste sans limite
                  'post__not_in'          => array(get_the_id()),    //exclu le post courant
                  'orderby'               => 'title',
                  'order'                 => 'ASC',
                  'lang'                  => pll_current_language(),    // use language slug in the query
                  'tax_query'             => array(
                                          array(
                                             'taxonomy' => 'cestag',
                                             'field'    => 'slug',
                                             'terms'    => $cesTerms,
                                          ),
                                       ),
                  // 'meta_key'              => '_wp_page_template',
                  // 'meta_value'            => '', // template-name.php
               );
      
               theia_wpthchild_get_associate_content($parameters, $args);
               ?>
         </aside>
      <?php 
        // If comments are open or we have at least one comment, load up the comment template.
        if ( comments_open() || get_comments_number() ) :
            comments_template();
        endif;

    endwhile; // End of the loop.
    ?>
</div>
</main><!-- #main -->

</div><!-- #primary -->
<?php

get_footer();
