<?php
/**
 * template pour les CPT des ART (affiche News de l'ART et listes des ART)
 * 
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
    $arttags = get_the_terms( get_the_id(), 'arttag');  // recup des terms de la taxonomie $parameters['category']
    $artTerms=array();
    if (is_array($arttags) || is_object($arttags))
    {
      foreach ($arttags as $artTerm_slug) {        
         array_push($artTerms, $artTerm_slug->slug);
      }
    }
   get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
      <?php
      get_template_part( 'template-parts/content', 'tpl-page' );
      ?>
		
      <aside>
         <!-- NEWS --> 
            <?php
            $parameters = array(
               'sectionTitle'    => "News",
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
                                         'taxonomy' => 'arttag',
                                         'field'    => 'slug',
                                         'terms'    => $artTerms,
                                      ),
                                   ),
           );            
           theia_wpthchild_get_associate_content($parameters, $args);
         
         ?>
         <!-- ART --> 
            <?php
            $parameters = array(
               'sectionTitle'    => "Regional Animation Networks",
            );
            
            $args = array(
              'post_type'             => 'art',
              'post_status'           => array( 'publish' ),
              'posts_per_page'        => '-1',            // -1 pour liste sans limite
              'post__not_in'          => array(get_the_id()),    //exclu le post courant
              'orderby'               => 'title',
              'order'                 => 'ASC',
              'lang'                  => pll_current_language(),    // use language slug in the query
            //   'tax_query'             => array(
            //                           array(
            //                              'taxonomy' => 'cestag',
            //                              'field'    => 'slug',
            //                              'terms'    => $cesTerms,
            //                           ),
            //                        ),
              // 'meta_key'              => '_wp_page_template',
              // 'meta_value'            => '', // template-name.php
           );
            
           theia_wpthchild_get_associate_content($parameters, $args);

            ?>

      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
