<?php
/**
 * template pour les CPT des Produits (affiche thématiques et produits liés)
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
    $cestags = get_the_terms( get_the_id(), 'cestag');  // recup des terms de la taxonomie $parameters['category']
    $cesTerms=array();
    if (is_array($cestags) || is_object($cestags))
    {
      foreach ($cestags as $cesTerm_slug) {        
         array_push($cesTerms, $cesTerm_slug->slug);
      }
    }
?>

<div id="primary" class="content-area <?php echo esc_html( $categories[0]->slug );?>">
        <?php
            if ( has_post_thumbnail() ) {
        ?>
            <header id="cover">
                <?php the_post_thumbnail('cover'); ?>
            </header>
        <?php 
        }
        ?>
        <div class="wrapper-layout">
            <main id="main" class="site-main">
                <article id="post-<?php the_ID();?>">	
                    <header>
                        <h1><?php the_title(); ?></h1>
                        <div>
                            <?php 
                            // $categories = get_the_category();
                            //     if ( ! empty( $categories ) ) {
                            //     echo esc_html( $categories[0]->name );   
                            // }; 
                            ?>
                            <?php 
                            if( function_exists('sedoo_show_categories') ){
                                sedoo_show_categories($themes, $themeSlugRewrite);
                            }
                            ?>
                        </div>
                    </header>
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
                        <!-- SEC --> 
                           <?php
                           $parameters = array(
                              'sectionTitle'    => "Scientific Expertise Centres",
                           );
                           
                           $args = array(
                           'post_type'             => 'ces',
                           'post_status'           => array( 'publish' ),
                           'posts_per_page'        => '-1',                    // -1 pour liste sans limite
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
                                    'taxonomy' => 'theme',
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
                     </div><!-- #content-area -->
                  </article>              
            </main>
                        </div>

<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
