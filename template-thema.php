<?php
/*
Template Name: page Thématiques
*/
?>


<?php
/**
 * template pour les pages des CES (affiche thématiques et produits liés)
 *
 *
 * @package aeris
 */

get_header(); 

while ( have_posts() ) : the_post();

	get_template_part( 'template-parts/header-content', 'page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
		<main id="main" class="site-main" role="main">
         <article id="post-<?php the_ID(); ?>">

            <div class="wrapper-content">
            
            <?php
               the_content();

               wp_link_pages( array(
                  'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'theme-aeris' ),
                  'after'  => '</div>',
               ) );
            ?>

            </div><!-- wrapper-content -->
         </article>


		</main>

      <aside> <!--sidebar droite-->
         <nav role="sommaire">
                     <ul id="tocList">
                     </ul>
                  </nav>
            
      </aside>
      <aside>
         <section>
            <?php
            $postID=get_the_id();
            ?>
            <h3>Actualités</h3>
            
            <?php
            $posttype="post";
            $limit=7;
            $category="category";
            $template="";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $category, $template);
            ?>
         </section>
         <section>
            <h3>CES</h3>
            <?php
            $posttype="page";
            $limit=7;
            $category="category";
            $template="template-ces.php";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $category, $template);
            ?>
         </section>
         <section>
            <h3>Produits</h3>
            <?php
            $posttype="page";
            $limit=7;
            $category="category";
            $template="template-produits.php";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $category, $template);
            ?>
         </section>
      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
