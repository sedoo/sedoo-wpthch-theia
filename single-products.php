<?php
/**
 * template pour les CPT des Produits (affiche thématiques et produits liés)
 * 
 */

get_header(); 
$query_object = get_queried_object();
// if ($query_object->post_type) {
    $page_id = get_queried_object_id();
// }
$title = get_the_title($page_id);

while ( have_posts() ) : the_post();

   $categories = get_the_terms( get_the_id(), 'theme_theia');  // recup des terms de la taxonomie $parameters['category']
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
?>

<?php 
   if(get_field('sedoo_img_defaut_yesno', 'option') == true) { // if default cover is in option
         ?><header id="cover">
            <figure class="fast-zoom-in">
            <?php
            if (get_the_post_thumbnail()) {// if default cover but cover special for this page
               the_post_thumbnail('cover'); 
            }
            else {
               echo '<img src="'.get_field('sedoo_labs_default_cover_url', 'option').'" class="attachment-cover size-cover wp-post-image">';
            }
            ?>
               <figcaption><?php the_post_thumbnail_caption();?></figcaption>
            </figure>
         </header>
         <?php
   } else { // if no default
         if (get_the_post_thumbnail()) {  // if no default cover but special cover for this one
            ?><header id="cover">
               <figure class="fast-zoom-in">
                     <?php
                     the_post_thumbnail('cover'); 
                     ?>
                     <figcaption><?php the_post_thumbnail_caption();?></figcaption>
               </figure>
            </header>
            <?php
         }
   }
?>
    <?php 
    // Show title first on mobile
    if (( function_exists( 'get_field' ) ) && (get_field( 'table_content' ))) {
        sedoo_wpth_labs_display_title_on_top_on_mobile();
    }
    ?>
	<div id="primary" class="content-area wrapper <?php echo esc_html( $categories[0]->slug );?> <?php if (( function_exists( 'get_field' ) ) && (get_field( 'table_content' ))) {echo " tocActive";}?>">
      <?php // table_content ( value ) 
      if (( function_exists( 'get_field' ) ) && (get_field( 'table_content' ))) {
         sedoo_wpth_labs_display_sommaire('Sommaire');
      } ?>
      <main id="main" class="site-main">
         <?php
         get_template_part( 'template-parts/content', 'tpl-page' );
         ?>
         
         <aside>
            <!-- NEWS --> 
            <?php
            theia_aside_content('News','post', '7', 'date', 'DESC', 'cestag', $cesTerms);
         
            ?>
            <!-- SEC --> 
            <?php
            theia_aside_content('Scientific Expertise Centres','ces','-1','title', 'ASC', 'cestag', $cesTerms);
         
            ?>
            <!-- Products --> 
            <?php
            $parameters = array(
               'sectionTitle'    => "Products",
            );
            
            $typeproducttags = get_the_terms( get_the_id(), 'typeproduct');  // recup des terms de la taxonomie $parameters['category']
            $typeproductTerms=array();
            if (is_array($typeproducttags) || is_object($typeproducttags))
            {
               foreach ($typeproducttags as $typeproductTerm_slug) {        
                  array_push($typeproductTerms, $typeproductTerm_slug->slug);
               }
            }
            // theia_aside_content('products', 'Products', 'cestag', $cesTerms);

            $args = array(
               'post_type'             => 'products',
               'post_status'           => array( 'publish' ),
               'posts_per_page'        => '-1',            // -1 pour liste sans limite
               'post__not_in'          => array(get_the_id()),    //exclu le post courant
               'orderby'               => 'title',
               'order'                 => 'ASC',
               'lang'                  => pll_current_language(),    // use language slug in the query
               'tax_query'             => array(
                                       // 'relation' => 'AND',
                                       array(
                                          'taxonomy' => 'cestag',
                                          'field'    => 'slug',
                                          'terms'    => $cesTerms,
                                       ),
                                       // array(
                                       //    'taxonomy' => 'typeproduct',
                                       //    'field'    => 'slug',
                                       //    'terms'    => $typeproductTerms,
                                       // ),
                                    ),
            );
            
            // Test if there are some results on query filtered by cestag
            $the_query = new WP_Query( $args );    
            // The Loop
            if ( !$the_query->have_posts() ) {
               $args['tax_query']=array(
                  'relation' => 'AND',
                  array(
                     'taxonomy' => 'theme_theia',
                     'field'    => 'slug',
                     'terms'    => $terms,
                  ),
                  array(
                     'taxonomy' => 'typeproduct',
                     'field'    => 'slug',
                     'terms'    => $typeproductTerms,
                  ),
               );
            }

            theia_wpthchild_get_associate_content($parameters, $args);
            ?>

         </aside>
      </main>
   </div>

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
