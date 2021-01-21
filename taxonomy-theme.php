<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package aeris
 */

get_header(); 

//get_template_part( 'template-parts/header-content', 'archive' );
// recup le slug du term courant
$term = get_queried_object();
/**
 * WP_Query pour lister la page Theme correspondante
*/
$args = array(
	'post_type' => array('any'),
	'post_status'           => array( 'publish' ),
	'posts_per_page'        => -1,            // -1 pour liste sans limite
	// 'post__not_in'          => array($postID),    //exclu le post courant
	'tax_query' => array(
		array(
			'taxonomy' => 'theme_theia',
			'field'    => 'slug',
			'terms'    => $term->slug,
		),
	),
);
?>

<div id="content-area" class="wrapper archives">
	<main id="main" class="site-main" role="main">
		<h1 class="page-title">
			<?php
			single_cat_title('', true);
			?>
		</h1>
		<?php
		if (get_the_archive_description()) {
			the_archive_description( '<div class="archive-description">', '</div>' );
		}
		/**
		 * WP_Query pour lister tous les types de posts
		 */
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		/* sedoo_wpth_labs_get_queried_content_arguments(post_types, taxonomy, slug, display, paged) */
		sedoo_wpth_labs_get_queried_content_arguments(array('post', 'page'), 'theme_theia', $term->slug, 'grid', '1');	
		?>
	</main><!-- #main -->
</div><!-- #content-area -->
<?php
get_footer();
?>