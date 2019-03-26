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
         <?php
         $postID=get_the_id();
         ?>
         <!-- NEWS --> 
         <?php
         $sectionTitle="News";
         $posttype="post";
         $limit=7;
         $orderby="date";
         $order="DESC";
         $category="category";
         $template="";
         theia_wpthchild_get_associate_content($sectionTitle, $postID, $posttype, $limit, $orderby, $order, $category, $template, $exclude);
         ?>

         <!-- Themes --> 
         <?php
         $sectionTitle="Themes";
         $posttype="page";
         $limit=7;
         $orderby="title";
         $order="ASC";
         $category="category";
         $template="template-thema.php";
         theia_wpthchild_get_associate_content($sectionTitle, $postID, $posttype, $limit, $orderby, $order, $category, $template, $exclude);
         ?>
         <!-- Products --> 
         <?php
         $sectionTitle="Products";
         $posttype ="page";
         $limit =7; // Limite à définir
         $orderby="title";
         $order="ASC";
         $category ="category";
         $template ="template-produits.php";
         $taxQueryType="exclude";
         $exclude=array('donnees-satellitaires');
         
         theia_wpthchild_get_associate_content($sectionTitle, $postID, $posttype, $limit, $orderby, $order, $category, $template, $exclude);
         ?>
      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
