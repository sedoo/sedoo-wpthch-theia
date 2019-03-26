<?php
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
         $parameters=array(
            'sectionTitle'    => "News",
            'posttype'        => "post",
            'limit'           => 7,
            'orderby'         => "date",
            'order'           => "DESC",
            'category'        => "theme",
            'template'        => "",
            'taxQueryType'    => "",
            'taxQueryCondTerm'  => "",
         );
         theia_wpthchild_get_associate_content($parameters, $postID);
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
         //theia_wpthchild_get_associate_content($sectionTitle, $postID, $posttype, $limit, $orderby, $order, $category, $template, $exclude);
        
         
         ?>
         <!-- Products --> 
         <?php
        // faire double taxo query
        $parameters=array(
        'sectionTitle'    => "Products",
        'posttype'        => "products",
        'limit'           => "-1",
        'orderby'         => "title",
        'order'           => "ASC",
        'category'        => "theme",
        'template'        => "",
        'taxQueryType'    => "exclude",
        'taxQueryCondTerm'  => "donnees-satellitaires",
        );
        theia_wpthchild_get_associate_content($parameters, $postID);
         
         ?>
      </aside>


	</div><!-- #content-area -->


<?php
endwhile; // End of the loop.
// get_sidebar();
get_footer();
