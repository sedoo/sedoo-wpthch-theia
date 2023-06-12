<?php
/**
 * template pour les CPT des ART (affiche News de l'ART et listes des ART)
 * 
 */

get_header(); 

while ( have_posts() ) : the_post();

   $categories = get_the_terms( get_the_id(), 'theme_theia');  // recup des terms de la taxonomie $parameters['category']
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
?>

<div id="primary" class="content-area <?php echo esc_html( $categories[0]->slug );?> wrapper <?php if (get_field( 'table_content' )) {echo " tocActive";}?>">
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
                            
                        </div>
                    </header>
                     <div id="content-area" class="wrapper sidebar toc-left">
                        <?php
                        get_template_part( 'template-parts/content', 'tpl-page' );
                        ?>
                        
                        <aside>
                           <!-- NEWS --> 
                              <?php
                              theia_aside_content('News','post', '7', 'date', 'DESC', 'cestag', $artTerms);
                           
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
                           );
                              
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
