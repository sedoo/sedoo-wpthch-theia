<?php
/*
Template Name: page CES
*/
/**
 * template pour les pages des CES (affiche actus / thématiques / produits liés)
*/

get_header(); 

while ( have_posts() ) : the_post();

   get_template_part( 'template-parts/header-content', 'theia-page' );
?>

	<div id="content-area" class="wrapper sidebar toc-left">
      <?php
      get_template_part( 'template-parts/content', 'tpl-page' );
      ?>
				
      <aside>
         <section>
            <?php
            $postID=get_the_id();
            ?>
            <h3><?=esc_html__( 'News', 'theme-aeris' )?></h3>
            
            <?php
            $posttype="post";
            $limit=7;
            $category="category";
            $template="";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $category, $template);
            ?>
         </section>
         <section>
            <h3><?=esc_html__( 'Themes', 'theme-aeris' )?></h3>
            <?php
            $posttype="page";
            $limit=7;
            $category="category";
            $template="template-thema.php";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $category, $template);
            ?>
         </section>
         <section>
            <h3><?=esc_html__( 'Products', 'theme-aeris' )?></h3>
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
