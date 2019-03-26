<?php
/*
Template Name: page Thématiques
*/
/**
 * template pour les pages des thématiques (affiche actus / CES / produits liés)
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
            <h3><?=esc_html__( 'News', 'aeris-wordpress-theme' )?></h3>
            
            <?php
            $posttype="post";
            $limit=7;
            $orderby="date";
            $order="DESC";
            $category="category";
            $template="";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $orderby, $order, $category, $template);
            ?>
         </section>
         <section>
            <h3><?=esc_html__( 'SEC', 'aeris-wordpress-theme' )?></h3>
            <?php
            $posttype="page";
            $limit="-1";
            $orderby="title";
            $order="ASC";
            $category="category";
            $template="template-ces.php";
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $orderby, $order, $category, $template);
            ?>
         </section>
         <section>
            <h3><?=esc_html__( 'Products', 'aeris-wordpress-theme' )?></h3>
            <?php
            $posttype="page";
            $limit=7;
            $orderby="title";
            $order="ASC";
            $category="category";
            $template="template-produits.php";
            $exclude=array('donnees-satellitaires');
            theia_wpthchild_get_associate_content($postID, $posttype, $limit, $orderby, $order, $category, $template, $exclude);
            ?>
         </section>
      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
